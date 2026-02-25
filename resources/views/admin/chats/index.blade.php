@extends('admin.layouts.app')

@section('title', 'Live Chat')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-white">Live Chat</h2>
            <p class="text-sm text-zinc-400 mt-1">Percakapan dengan pengguna.</p>
        </div>

        <!-- Chat List -->
        <div class="bg-zinc-900/50 border border-zinc-800 rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-zinc-800 bg-zinc-950/50">
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Pesan Terakhir</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Belum Dibaca</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Waktu</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-zinc-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-800/50">
                        @forelse($chats as $chat)
                            <tr class="hover:bg-zinc-800/30 transition-colors {{ $chat->unread_count > 0 ? 'bg-indigo-500/5' : '' }}">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400 text-xs font-bold">
                                            {{ strtoupper(substr($chat->user->name ?? '?', 0, 1)) }}
                                        </div>
                                        <div>
                                            <p class="text-sm font-medium text-white">{{ $chat->user->name ?? 'Deleted' }}</p>
                                            <p class="text-xs text-zinc-500">{{ $chat->user->email ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-zinc-400 max-w-[200px] truncate">
                                    {{ $chat->latestMessage->message ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($chat->status === 'open')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold uppercase tracking-wider border bg-emerald-500/10 text-emerald-400 border-emerald-500/20">
                                            Open
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[11px] font-bold uppercase tracking-wider border bg-zinc-800 text-zinc-400 border-zinc-700">
                                            Closed
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($chat->unread_count > 0)
                                        <span class="inline-flex items-center justify-center w-6 h-6 bg-red-500 text-white text-xs font-bold rounded-full">
                                            {{ $chat->unread_count }}
                                        </span>
                                    @else
                                        <span class="text-zinc-600 text-sm">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-zinc-500">
                                    {{ $chat->updated_at->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('admin.chats.show', $chat) }}"
                                       class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-medium rounded-lg transition-colors">
                                        <i data-lucide="message-square" class="w-3.5 h-3.5"></i>
                                        Buka
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-2">
                                        <i data-lucide="message-circle" class="w-8 h-8 text-zinc-700"></i>
                                        <p class="text-zinc-500 text-sm">Belum ada percakapan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($chats->hasPages())
                <div class="px-6 py-4 border-t border-zinc-800">
                    {{ $chats->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
