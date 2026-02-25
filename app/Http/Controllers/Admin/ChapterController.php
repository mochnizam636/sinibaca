<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Novel;
use App\Models\NovelChapter;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    /**
     * Show the form for uploading chapters via TXT file.
     */
    public function create(Novel $novel)
    {
        return view('admin.chapters.upload', compact('novel'));
    }

    /**
     * Process the uploaded TXT file and create chapters.
     * 
     * Format file TXT yang didukung:
     * # Chapter 1
     * Isi chapter 1
     * 
     * # Chapter 2
     * Isi chapter 2
     */
    public function store(Request $request, Novel $novel)
    {
        $request->validate([
            'chapters_file' => 'required|file|mimes:txt|max:10240', // max 10MB
        ]);

        $file = $request->file('chapters_file');
        $content = file_get_contents($file->getRealPath());

        // Parse chapters using regex - split by "# Chapter" pattern
        $pattern = '/^#\s*Chapter\s*(\d+)\s*$/mi';

        // Split content by chapter headers
        $parts = preg_split($pattern, $content, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

        if (count($parts) < 2) {
            return back()->with('error', 'Format file tidak valid. Pastikan menggunakan format "# Chapter N" untuk setiap chapter.');
        }

        $chaptersCreated = 0;
        $startingNumber = $novel->chapters()->max('chapter_number') ?? 0;

        // Process pairs: chapter number, content
        for ($i = 0; $i < count($parts) - 1; $i += 2) {
            $chapterNumber = (int) trim($parts[$i]);
            $chapterContent = trim($parts[$i + 1]);

            if (empty($chapterContent)) {
                continue;
            }

            // If chapter number is 0 or invalid, use sequential
            if ($chapterNumber <= 0) {
                $chapterNumber = $startingNumber + $chaptersCreated + 1;
            }

            NovelChapter::create([
                'novel_id' => $novel->id,
                'title' => 'Chapter ' . $chapterNumber,
                'content' => $chapterContent,
                'chapter_number' => $chapterNumber,
                'is_premium' => false,
                'views' => 0,
            ]);

            $chaptersCreated++;
        }

        if ($chaptersCreated === 0) {
            return back()->with('error', 'Tidak ada chapter yang berhasil dibuat. Periksa format file Anda.');
        }

        return redirect()->route('admin.novels.show', $novel)
            ->with('success', "$chaptersCreated chapter berhasil diupload.");
    }

    /**
     * Show form to edit a chapter.
     */
    public function edit(Novel $novel, NovelChapter $chapter)
    {
        return view('admin.chapters.edit', compact('novel', 'chapter'));
    }

    /**
     * Update a chapter.
     */
    public function update(Request $request, Novel $novel, NovelChapter $chapter)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'chapter_number' => 'required|integer|min:1',
            'is_premium' => 'boolean',
        ]);

        $chapter->update($validated);

        return redirect()->route('admin.novels.show', $novel)
            ->with('success', 'Chapter berhasil diperbarui.');
    }

    /**
     * Delete a chapter.
     */
    public function destroy(Novel $novel, NovelChapter $chapter)
    {
        $chapter->delete();

        return redirect()->route('admin.novels.show', $novel)
            ->with('success', 'Chapter berhasil dihapus.');
    }
}
