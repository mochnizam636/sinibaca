<!DOCTYPE html>
<meta charset="utf-8">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SiniBaca') }} - @yield('title', 'Baca Novel Online')</title>
    <meta name="description"
        content="@yield('description', 'Platform baca novel online modern dan premium. Jelajahi ribuan cerita menarik hanya di NovelKu.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #09090b;
            /* Zinc 950 */
            color: #fafafa;
            /* Zinc 50 */
            -webkit-font-smoothing: antialiased;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #09090b;
        }

        ::-webkit-scrollbar-thumb {
            background: #27272a;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #3f3f46;
        }

        /* Utilities */
        .text-gradient {
            background: linear-gradient(to right, #6366f1, #a855f7, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Shadcn Button Styles */
        .btn-shadcn-primary {
            @apply bg-white text-zinc-950 hover:bg-zinc-200;
        }

        .btn-shadcn-outline {
            @apply border border-zinc-800 bg-transparent hover:bg-zinc-800 text-white;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col selection:bg-indigo-500/30 selection:text-indigo-400">
    <!-- Navigation -->
    <nav class="fixed top-0 inset-x-0 z-50 border-b border-zinc-800 bg-zinc-950/80 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-4 h-16 flex items-center justify-between">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div
                    class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white shadow-lg shadow-indigo-500/20 group-hover:shadow-indigo-500/40 transition-all">
                    <i data-lucide="book" class="w-4 h-4 text-white"></i>
                </div>
                <span class="font-bold text-lg tracking-tight">Baca<span class="text-indigo-500">Novel</span></span>
            </a>

            <!-- Desktop Links -->
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}"
                    class="text-sm font-medium {{ request()->routeIs('home') ? 'text-white' : 'text-zinc-400 hover:text-white' }} transition-colors">Home</a>
                <a href="{{ route('explore') }}"
                    class="text-sm font-medium {{ request()->routeIs('explore') ? 'text-white' : 'text-zinc-400 hover:text-white' }} transition-colors">Jelajahi</a>
                <a href="{{ route('subscription.index') }}"
                    class="text-sm font-medium {{ request()->routeIs('subscription.*') ? 'text-white' : 'text-amber-400 hover:text-amber-300' }} transition-colors flex items-center gap-1">
                    <i data-lucide="crown" class="w-4 h-4"></i> Premium
                </a>
                @auth
                    <a href="{{ route('library.index') }}"
                        class="text-sm font-medium {{ request()->routeIs('library.*') ? 'text-white' : 'text-zinc-400 hover:text-white' }} transition-colors">Perpustakaan</a>
                @endauth
            </div>

            <!-- Auth Buttons -->
            <div class="flex items-center gap-4">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-2 text-sm font-medium text-zinc-300 hover:text-white transition-colors">
                            <div
                                class="w-8 h-8 rounded-full bg-zinc-800 border border-zinc-700 flex items-center justify-center overflow-hidden">
                                <span class="text-xs font-bold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <span class="hidden sm:inline">{{ auth()->user()->name }}</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 text-zinc-500"></i>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" @click.away="open = false" x-transition.origin.top.right
                            class="absolute right-0 mt-2 w-56 rounded-xl border border-zinc-800 bg-zinc-950 p-2 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none hidden"
                            :class="{ 'hidden': !open }">
                            <div class="px-2 py-1.5 mb-2 border-b border-zinc-800">
                                <p class="text-zinc-400 text-xs font-medium">Signed in as</p>
                                <p class="text-white text-sm font-bold truncate">{{ auth()->user()->email }}</p>
                            </div>

                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}"
                                    class="flex items-center gap-2 w-full rounded-md px-2 py-1.5 text-sm text-zinc-300 hover:bg-zinc-800 hover:text-white transition-colors">
                                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                                    Admin Dashboard
                                </a>
                            @endif

                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-2 w-full rounded-md px-2 py-1.5 text-sm text-zinc-300 hover:bg-zinc-800 hover:text-white transition-colors">
                                <i data-lucide="user" class="w-4 h-4"></i>
                                Profil Saya
                            </a>

                            <form method="POST" action="{{ route('logout') }}" class="mt-1 pt-1 border-t border-zinc-800">
                                @csrf
                                <button type="submit"
                                    class="flex items-center gap-2 w-full rounded-md px-2 py-1.5 text-sm text-red-400 hover:bg-red-500/10 hover:text-red-300 transition-colors">
                                    <i data-lucide="log-out" class="w-4 h-4"></i>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="text-sm font-medium text-zinc-400 hover:text-white transition-colors">Masuk</a>
                    <a href="{{ route('register') }}"
                        class="bg-white text-black hover:bg-zinc-200 px-4 py-2 rounded-full text-sm font-bold transition-all shadow-lg shadow-white/5">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow pt-16">
        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 mt-6">
                <div
                    class="bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 px-4 py-3 rounded-xl flex items-center gap-3">
                    <i data-lucide="check-circle" class="w-5 h-5 shrink-0"></i>
                    <p class="text-sm font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 mt-6">
                <div
                    class="bg-red-500/10 border border-red-500/20 text-red-400 px-4 py-3 rounded-xl flex items-center gap-3">
                    <i data-lucide="alert-circle" class="w-5 h-5 shrink-0"></i>
                    <p class="text-sm font-medium">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-zinc-800 bg-zinc-950 mt-auto">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div class="col-span-1 md:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 mb-4">
                        <div class="w-6 h-6 rounded bg-indigo-500 flex items-center justify-center text-white">
                            <i data-lucide="book" class="w-3 h-3"></i>
                        </div>
                        <span class="font-bold text-lg">Baca<span class="text-indigo-500">Novel</span></span>
                    </a>
                    <p class="text-zinc-500 text-sm leading-relaxed">
                        Platform baca novel digital masa depan. Nikmati ribuan cerita menarik dengan pengalaman membaca
                        terbaik.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold text-white mb-4">Navigasi</h4>
                    <ul class="space-y-2 text-sm text-zinc-500">
                        <li><a href="{{ route('home') }}" class="hover:text-indigo-400 transition-colors">Beranda</a>
                        </li>
                        <li><a href="{{ route('explore') }}" class="hover:text-indigo-400 transition-colors">Jelajahi
                                Novel</a></li>
                        <li><a href="{{ route('library.index') }}"
                                class="hover:text-indigo-400 transition-colors">Perpustakaan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-white mb-4">Dukungan</h4>
                    <ul class="space-y-2 text-sm text-zinc-500">
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Syarat & Ketentuan</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-white mb-4">Sosial Media</h4>
                    <div class="flex items-center gap-4">
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-400 hover:bg-indigo-500 hover:text-white hover:border-indigo-500 transition-all">
                            <i data-lucide="twitter" class="w-4 h-4"></i>
                        </a>
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-400 hover:bg-pink-500 hover:text-white hover:border-pink-500 transition-all">
                            <i data-lucide="instagram" class="w-4 h-4"></i>
                        </a>
                        <a href="#"
                            class="w-8 h-8 rounded-full bg-zinc-900 border border-zinc-800 flex items-center justify-center text-zinc-400 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-all">
                            <i data-lucide="github" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="border-t border-zinc-900 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-zinc-600 text-sm">
                    &copy; {{ date('Y') }} SiniBaca. All rights reserved.
                </p>
                <div class="flex items-center gap-1 text-zinc-600 text-sm">
                    <span>Made with</span>
                    <i data-lucide="heart" class="w-3 h-3 text-red-500 fill-red-500"></i>
                    <span>for Storytellers</span>
                </div>
            </div>
        </div>
    </footer>

    @auth
        <!-- Live Chat Widget -->
        <div x-data="chatWidget()" x-init="init()" class="fixed bottom-6 right-6 z-[999]">
            <!-- Chat Window -->
            <div x-show="isOpen" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                class="mb-4 w-[360px] max-h-[480px] bg-zinc-900 border border-zinc-700/50 rounded-2xl shadow-2xl shadow-black/40 flex flex-col overflow-hidden"
                style="display: none;">

                <!-- Chat Header -->
                <div
                    class="bg-gradient-to-r from-indigo-600 to-purple-600 px-5 py-4 flex items-center justify-between shrink-0">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center">
                            <i data-lucide="headphones" class="w-5 h-5 text-white"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-sm">Live Chat</h3>
                            <div class="flex items-center gap-1.5">
                                <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                                <span class="text-white/70 text-xs">Customer Service</span>
                            </div>
                        </div>
                    </div>
                    <button @click="isOpen = false"
                        class="text-white/70 hover:text-white transition-colors p-1 rounded-lg hover:bg-white/10">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <!-- Messages Area -->
                <div x-ref="chatBody"
                    class="flex-1 overflow-y-auto p-4 space-y-3 min-h-[280px] max-h-[320px] custom-chat-scroll">
                    <template x-for="msg in messages" :key="msg.id">
                        <div :class="msg.sender_type === 'user' ? 'flex justify-end' : 'flex justify-start'">
                            <div
                                :class="msg.sender_type === 'user'
                                ? 'bg-indigo-600 text-white rounded-2xl rounded-br-md px-4 py-2.5 max-w-[80%]'
                                : 'bg-zinc-800 text-zinc-100 rounded-2xl rounded-bl-md px-4 py-2.5 max-w-[80%] border border-zinc-700/50'">
                                <p class="text-sm leading-relaxed" x-text="msg.message"></p>
                                <p class="text-[10px] mt-1 opacity-60" x-text="msg.time"></p>
                            </div>
                        </div>
                    </template>

                    <div x-show="messages.length === 0 && !loading" class="text-center py-8">
                        <i data-lucide="message-circle" class="w-10 h-10 text-zinc-700 mx-auto mb-2"></i>
                        <p class="text-zinc-500 text-sm">Mulai percakapan...</p>
                    </div>
                </div>

                <!-- Input Area -->
                <div class="p-3 border-t border-zinc-800 bg-zinc-950/50 shrink-0">
                    <form @submit.prevent="sendMessage()" class="flex items-center gap-2">
                        <input x-model="newMessage" type="text" placeholder="Ketik pesan..." maxlength="1000"
                            class="flex-1 bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-2.5 text-sm text-white placeholder-zinc-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition-all"
                            :disabled="sending">
                        <button type="submit" :disabled="!newMessage.trim() || sending"
                            class="p-2.5 bg-indigo-600 hover:bg-indigo-500 disabled:opacity-40 disabled:cursor-not-allowed text-white rounded-xl transition-all shrink-0">
                            <i data-lucide="send" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Floating Button -->
            <button @click="toggleChat()"
                class="w-14 h-14 rounded-full bg-gradient-to-br from-indigo-600 to-purple-600 text-white shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/50 flex items-center justify-center transition-all duration-300 hover:scale-110 group"
                :class="{ 'animate-chat-bounce': !hasOpened }">
                <i data-lucide="message-circle" class="w-6 h-6 group-hover:scale-110 transition-transform"
                    x-show="!isOpen"></i>
                <i data-lucide="x" class="w-6 h-6" x-show="isOpen" style="display: none;"></i>

                <!-- Unread Badge -->
                <span x-show="unreadCount > 0 && !isOpen"
                    class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center animate-pulse"
                    x-text="unreadCount" style="display: none;">
                </span>
            </button>
        </div>

        <style>
            @keyframes chatBounce {

                0%,
                100% {
                    transform: translateY(0);
                }

                20% {
                    transform: translateY(-12px);
                }

                40% {
                    transform: translateY(-6px);
                }

                60% {
                    transform: translateY(-3px);
                }
            }

            .animate-chat-bounce {
                animation: chatBounce 2s ease-in-out infinite;
            }

            .custom-chat-scroll::-webkit-scrollbar {
                width: 4px;
            }

            .custom-chat-scroll::-webkit-scrollbar-track {
                background: transparent;
            }

            .custom-chat-scroll::-webkit-scrollbar-thumb {
                background: #3f3f46;
                border-radius: 2px;
            }
        </style>

        <script>
            function chatWidget() {
                return {
                    isOpen: false,
                    hasOpened: false,
                    loading: false,
                    sending: false,
                    chatId: null,
                    messages: [],
                    newMessage: '',
                    unreadCount: 0,
                    pollInterval: null,

                    init() {
                        // Start polling after 2s
                        setTimeout(() => this.startPolling(), 2000);
                    },

                    async toggleChat() {
                        this.isOpen = !this.isOpen;
                        if (this.isOpen) {
                            this.hasOpened = true;
                            this.unreadCount = 0;
                            if (!this.chatId) {
                                await this.initChat();
                            }
                            await this.loadMessages();
                            this.$nextTick(() => this.scrollToBottom());
                            lucide.createIcons();
                        }
                    },

                    async initChat() {
                        try {
                            const res = await fetch('{{ route("chat.init") }}', {
                                headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                            });
                            const data = await res.json();
                            this.chatId = data.chat_id;
                        } catch (e) {
                            console.error('Init chat error:', e);
                        }
                    },

                    async loadMessages() {
                        try {
                            const res = await fetch('{{ route("chat.messages") }}', {
                                headers: { 'Accept': 'application/json' }
                            });
                            const data = await res.json();
                            const hadMessages = this.messages.length;
                            this.messages = data.messages || [];
                            if (this.messages.length > hadMessages) {
                                this.$nextTick(() => this.scrollToBottom());
                            }
                        } catch (e) {
                            console.error('Load messages error:', e);
                        }
                    },

                    async sendMessage() {
                        if (!this.newMessage.trim() || this.sending) return;
                        this.sending = true;

                        if (!this.chatId) await this.initChat();

                        try {
                            const res = await fetch('{{ route("chat.send") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ message: this.newMessage })
                            });
                            const data = await res.json();
                            if (data.success) {
                                this.messages.push(data.message);
                                this.newMessage = '';
                                this.$nextTick(() => this.scrollToBottom());
                            }
                        } catch (e) {
                            console.error('Send error:', e);
                        } finally {
                            this.sending = false;
                        }
                    },

                    scrollToBottom() {
                        if (this.$refs.chatBody) {
                            this.$refs.chatBody.scrollTop = this.$refs.chatBody.scrollHeight;
                        }
                    },

                    startPolling() {
                        this.pollInterval = setInterval(async () => {
                            if (this.chatId || this.isOpen) {
                                const prevCount = this.messages.length;
                                await this.loadMessages();
                                if (!this.isOpen && this.messages.length > prevCount) {
                                    const newAdminMsgs = this.messages.filter(m => m.sender_type === 'admin').length;
                                    if (newAdminMsgs > 0) this.unreadCount++;
                                }
                            }
                        }, 4000);
                    }
                }
            }
        </script>
    @endauth

    <script>
        lucide.createIcons();
    </script>
</body>

</html>