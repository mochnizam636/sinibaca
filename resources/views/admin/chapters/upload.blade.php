@extends('admin.layouts.app')

@section('title', 'Upload Chapters')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <nav class="flex mb-1" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.novels.index') }}"
                                class="text-sm font-medium text-zinc-500 hover:text-zinc-300 transition-colors">
                                Novel
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i data-lucide="chevron-right" class="w-4 h-4 text-zinc-600 mx-1"></i>
                                <a href="{{ route('admin.novels.show', $novel) }}"
                                    class="text-sm font-medium text-zinc-500 hover:text-zinc-300 transition-colors">
                                    {{ Str::limit($novel->title, 20) }}
                                </a>
                            </div>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <i data-lucide="chevron-right" class="w-4 h-4 text-zinc-600 mx-1"></i>
                                <span class="text-sm font-medium text-zinc-100">Upload</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-2xl font-bold tracking-tight text-white">Upload Chapters</h1>
                <p class="text-zinc-400">Upload chapters "{{ $novel->title }}" via TXT file.</p>
            </div>

            <a href="{{ route('admin.novels.show', $novel) }}"
                class="inline-flex items-center justify-center rounded-lg text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 disabled:pointer-events-none disabled:opacity-50 border border-zinc-700 bg-zinc-800 hover:bg-zinc-700 text-white h-10 px-4 py-2">
                <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
                Back to Novel
            </a>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            <!-- Format Guide (Sidebar) -->
            <div class="md:col-span-1 space-y-6">
                <div class="rounded-xl border border-zinc-800 bg-zinc-900/50 text-zinc-50 shadow-sm backdrop-blur-sm">
                    <div class="flex flex-col space-y-1.5 p-6">
                        <h3 class="font-semibold leading-none tracking-tight flex items-center gap-2">
                            <i data-lucide="file-text" class="w-4 h-4 text-indigo-400"></i>
                            File Format Guide
                        </h3>
                        <p class="text-sm text-zinc-400">Follow this specific format to ensure chapters are parsed
                            correctly.</p>
                    </div>
                    <div class="p-6 pt-0">
                        <div class="rounded-md bg-black/50 border border-zinc-800 p-4 overflow-x-auto">
                            <pre class="text-xs text-zinc-300 font-mono"># Chapter 1
    This is the content of the first chapter.
    It can have multiple paragraphs.

    # Chapter 2
    This is the second chapter content.
    Lines starting with # Chapter will be treated as headers.</pre>
                        </div>
                        <ul class="mt-4 space-y-2 text-sm text-zinc-400 list-disc list-inside">
                            <li>File must be <span class="font-medium text-zinc-200">.txt</span> format.</li>
                            <li>Start each chapter with <span
                                    class="font-mono text-xs bg-zinc-800 border border-zinc-700 px-1 py-0.5 rounded text-zinc-200">#
                                    Chapter</span>.</li>
                            <li>Ensure UTF-8 encoding.</li>
                        </ul>
                    </div>
                </div>

                @if($novel->chapters->count() > 0)
                    <div class="rounded-xl border border-amber-500/20 bg-amber-500/10 text-amber-500 shadow-sm p-4">
                        <div class="flex items-start gap-3">
                            <i data-lucide="alert-circle" class="w-5 h-5 shrink-0 mt-0.5"></i>
                            <div class="space-y-1">
                                <h4 class="text-sm font-semibold text-amber-400">Existing Chapters</h4>
                                <p class="text-sm text-amber-500/90 leading-relaxed">
                                    This novel already has <span
                                        class="font-bold text-amber-400">{{ $novel->chapters->count() }}</span> chapters. New
                                    chapters will be appended.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Upload Form (Main) -->
            <div class="md:col-span-2">
                <div class="rounded-xl border border-zinc-800 bg-zinc-900/50 text-zinc-50 shadow-sm backdrop-blur-sm">
                    <div class="flex flex-col space-y-1.5 p-6 border-b border-zinc-800">
                        <h3 class="font-semibold leading-none tracking-tight">Upload File</h3>
                        <p class="text-sm text-zinc-400">Select and upload your chapter file to process.</p>
                    </div>
                    <div class="p-6">
                        <form action="{{ route('admin.chapters.store', $novel) }}" method="POST"
                            enctype="multipart/form-data" class="space-y-6">
                            @csrf

                            <div class="space-y-2">
                                <label for="chapters_file" class="text-sm font-medium leading-none text-zinc-300">Txt
                                    File</label>
                                <div class="flex items-center justify-center w-full">
                                    <label for="chapters_file"
                                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-zinc-700 border-dashed rounded-lg cursor-pointer bg-black/20 hover:bg-zinc-800/50 hover:border-indigo-500/50 transition-all group">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <i data-lucide="upload-cloud"
                                                class="w-10 h-10 mb-4 text-zinc-500 group-hover:text-indigo-400 transition-colors"></i>
                                            <p class="mb-2 text-sm text-zinc-400"><span
                                                    class="font-semibold text-zinc-200">Click to upload</span> or drag and
                                                drop</p>
                                            <p class="text-xs text-zinc-500">TXT files only (MAX. 10MB)</p>
                                        </div>
                                        <input id="chapters_file" name="chapters_file" type="file" class="hidden"
                                            accept=".txt" required />
                                    </label>
                                </div>
                                <div id="file-name"
                                    class="text-sm text-zinc-400 hidden flex items-center gap-2 p-2 rounded bg-emerald-500/10 border border-emerald-500/20 text-emerald-400">
                                    <i data-lucide="check-circle" class="w-4 h-4"></i>
                                    <span class="font-medium" id="file-name-text"></span>
                                </div>
                            </div>

                            <div class="flex items-center justify-end gap-3 pt-4">
                                <button type="submit"
                                    class="inline-flex items-center justify-center rounded-lg text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-indigo-500 disabled:opacity-50 disabled:pointer-events-none bg-indigo-600 hover:bg-indigo-700 text-white h-10 px-6 py-2 w-full sm:w-auto shadow-lg shadow-indigo-500/20">
                                    <i data-lucide="upload" class="w-4 h-4 mr-2"></i>
                                    Upload & Process
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('chapters_file').addEventListener('change', function (e) {
                const fileName = e.target.files[0]?.name;
                const fileDisplay = document.getElementById('file-name');
                const fileText = document.getElementById('file-name-text');

                if (fileName) {
                    fileText.textContent = fileName;
                    fileDisplay.classList.remove('hidden');
                    lucide.createIcons();
                } else {
                    fileDisplay.classList.add('hidden');
                }
            });
        </script>
    @endpush
@endsection