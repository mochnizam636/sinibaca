@extends('admin.layouts.app')

@section('title', 'Chat - ' . $chat->user->name)

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.chats.index') }}"
                    class="p-2 rounded-lg bg-zinc-800 hover:bg-zinc-700 text-zinc-400 hover:text-white transition-all">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                </a>
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-full bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400 text-sm font-bold">
                        {{ strtoupper(substr($chat->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-white">{{ $chat->user->name }}</h2>
                        <p class="text-xs text-zinc-500">{{ $chat->user->email }}</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                @if($chat->status === 'open')
                    <span
                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Open
                    </span>
                    <form method="POST" action="{{ route('admin.chats.close', $chat) }}">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-zinc-800 hover:bg-red-500/10 text-zinc-400 hover:text-red-400 text-xs font-medium rounded-lg border border-zinc-700 hover:border-red-500/30 transition-all">
                            <i data-lucide="x-circle" class="w-3.5 h-3.5"></i>
                            Tutup Chat
                        </button>
                    </form>
                @else
                    <span
                        class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-zinc-800 text-zinc-400 border border-zinc-700">
                        Closed
                    </span>
                @endif
            </div>
        </div>

        <!-- Chat Messages -->
        <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl overflow-hidden">
            <div id="adminChatBody" class="p-6 space-y-4 max-h-[500px] overflow-y-auto" style="scroll-behavior: smooth;">
                @foreach($messages as $msg)
                        <div class="flex {{ $msg->sender_type === 'admin' ? 'justify-end' : 'justify-start' }}">
                            <div
                                class="{{ $msg->sender_type === 'admin'
                    ? 'bg-indigo-600 text-white rounded-2xl rounded-br-md'
                    : 'bg-zinc-800 text-zinc-100 rounded-2xl rounded-bl-md border border-zinc-700/50' }} px-4 py-3 max-w-[70%]">
                                <div class="flex items-center gap-2 mb-1">
                                    <span
                                        class="text-[11px] font-bold {{ $msg->sender_type === 'admin' ? 'text-indigo-200' : 'text-indigo-400' }}">
                                        {{ $msg->sender_type === 'admin' ? 'Admin' : $chat->user->name }}
                                    </span>
                                </div>
                                <p class="text-sm leading-relaxed">{{ $msg->message }}</p>
                                <p
                                    class="text-[10px] mt-1.5 {{ $msg->sender_type === 'admin' ? 'text-indigo-200/60' : 'text-zinc-500' }}">
                                    {{ $msg->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>
                @endforeach

                @if($messages->isEmpty())
                    <div class="text-center py-12">
                        <i data-lucide="message-circle" class="w-10 h-10 text-zinc-700 mx-auto mb-2"></i>
                        <p class="text-zinc-500 text-sm">Belum ada pesan.</p>
                    </div>
                @endif
            </div>

            <!-- Reply Form -->
            @if($chat->status === 'open')
                <div class="p-4 border-t border-zinc-800 bg-zinc-950/50">
                    <form method="POST" action="{{ route('admin.chats.reply', $chat) }}" class="flex items-end gap-3">
                        @csrf
                        <div class="flex-1">
                            <textarea name="message" rows="2" required maxlength="2000" placeholder="Ketik balasan..."
                                class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-sm text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 resize-none transition-all"></textarea>
                        </div>
                        <button type="submit"
                            class="px-5 py-3 bg-indigo-600 hover:bg-indigo-500 text-white text-sm font-medium rounded-xl transition-all flex items-center gap-2 shrink-0">
                            <i data-lucide="send" class="w-4 h-4"></i>
                            Kirim
                        </button>
                    </form>
                </div>
            @else
                <div class="p-4 border-t border-zinc-800 bg-zinc-950/50 text-center">
                    <p class="text-zinc-500 text-sm">Chat ini sudah ditutup.</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        // Auto-scroll to bottom
        document.addEventListener('DOMContentLoaded', function () {
            const chatBody = document.getElementById('adminChatBody');
            if (chatBody) chatBody.scrollTop = chatBody.scrollHeight;
        });
    </script>
@endsection