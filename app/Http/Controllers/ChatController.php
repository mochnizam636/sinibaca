<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Get or create the user's active chat session.
     */
    public function getOrCreateChat()
    {
        $chat = Chat::where('user_id', auth()->id())
            ->where('status', 'open')
            ->first();

        if (!$chat) {
            $chat = Chat::create([
                'user_id' => auth()->id(),
                'subject' => 'Bantuan',
                'status' => 'open',
            ]);

            // Welcome message from admin
            ChatMessage::create([
                'chat_id' => $chat->id,
                'sender_type' => 'admin',
                'sender_id' => 0,
                'message' => 'Halo! 👋 Selamat datang di BacaNovel. Ada yang bisa kami bantu? Silakan tanyakan tentang novel, langganan premium, atau apapun!',
                'is_read' => false,
            ]);
        }

        return response()->json([
            'chat_id' => $chat->id,
            'status' => $chat->status,
        ]);
    }

    /**
     * Send a message from the user.
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $chat = Chat::where('user_id', auth()->id())
            ->where('status', 'open')
            ->firstOrFail();

        $message = ChatMessage::create([
            'chat_id' => $chat->id,
            'sender_type' => 'user',
            'sender_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $message->id,
                'sender_type' => $message->sender_type,
                'message' => $message->message,
                'time' => $message->created_at->format('H:i'),
            ],
        ]);
    }

    /**
     * Fetch messages for polling.
     */
    public function fetchMessages(Request $request)
    {
        $chat = Chat::where('user_id', auth()->id())
            ->where('status', 'open')
            ->first();

        if (!$chat) {
            return response()->json(['messages' => [], 'status' => 'none']);
        }

        // Mark admin messages as read
        $chat->messages()
            ->where('sender_type', 'admin')
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
            ]);

        return response()->json([
            'messages' => $messages,
            'status' => $chat->status,
        ]);
    }
}
