<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * List all chat conversations.
     */
    public function index()
    {
        $chats = Chat::with(['user', 'latestMessage'])
            ->withCount([
                'messages as unread_count' => function ($q) {
                    $q->where('sender_type', 'user')->where('is_read', false);
                }
            ])
            ->orderByDesc('updated_at')
            ->paginate(20);

        return view('admin.chats.index', compact('chats'));
    }

    /**
     * Show a chat conversation.
     */
    public function show(Chat $chat)
    {
        $chat->load('user');

        // Mark user messages as read
        $chat->messages()
            ->where('sender_type', 'user')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = $chat->messages()->orderBy('created_at', 'asc')->get();

        return view('admin.chats.show', compact('chat', 'messages'));
    }

    /**
     * Send admin reply.
     */
    public function reply(Request $request, Chat $chat)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        ChatMessage::create([
            'chat_id' => $chat->id,
            'sender_type' => 'admin',
            'sender_id' => auth()->id(),
            'message' => $request->message,
        ]);

        $chat->touch(); // Update updated_at

        return redirect()->route('admin.chats.show', $chat)->with('success', 'Pesan terkirim.');
    }

    /**
     * Close a chat.
     */
    public function close(Chat $chat)
    {
        $chat->update(['status' => 'closed']);

        return redirect()->route('admin.chats.index')->with('success', 'Chat ditutup.');
    }

    /**
     * Fetch messages as JSON for polling (admin side).
     */
    public function fetchMessages(Chat $chat)
    {
        $chat->messages()
            ->where('sender_type', 'user')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        $messages = $chat->messages()
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(fn($m) => [
                'id' => $m->id,
                'sender_type' => $m->sender_type,
                'message' => $m->message,
                'time' => $m->created_at->format('H:i'),
                'sender_name' => $m->sender_type === 'admin' ? 'Admin' : $chat->user->name,
            ]);

        return response()->json([
            'messages' => $messages,
            'status' => $chat->status,
        ]);
    }
}
