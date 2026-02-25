<x-guest-layout>
    <div
        class="w-full max-w-[400px] bg-zinc-900 border border-zinc-800 rounded-xl shadow-2xl p-8 relative overflow-hidden group">

        <!-- Header -->
        <div class="mb-8 text-center">
            <div
                class="inline-flex items-center justify-center w-12 h-12 rounded-lg bg-zinc-800 border border-zinc-700 mb-6 shadow-inner ring-1 ring-zinc-800/50">
                <i data-lucide="book" class="w-6 h-6 text-white"></i>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight mb-2">Welcome back</h1>
            <p class="text-zinc-400 text-sm">Enter your credentials to access your account</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-6" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div class="space-y-1.5">
                <label for="email" class="text-xs font-semibold text-zinc-300">Email</label>
                <div class="relative">
                    <input id="email"
                        class="block w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-md text-sm text-white placeholder-zinc-600 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none"
                        type="email" name="email" value="{{ old('email') }}" required autofocus
                        placeholder="name@example.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div class="space-y-1.5">
                <div class="flex items-center justify-between">
                    <label for="password" class="text-xs font-semibold text-zinc-300">Password</label>
                </div>
                <div class="relative">
                    <input id="password"
                        class="block w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-md text-sm text-white placeholder-zinc-600 focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all outline-none"
                        type="password" name="password" required placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between pt-1">
                <label for="remember_me" class="inline-flex items-center cursor-pointer select-none">
                    <input id="remember_me" type="checkbox"
                        class="w-4 h-4 rounded border-zinc-700 bg-zinc-900 text-indigo-600 focus:ring-indigo-500/50 focus:ring-offset-0 transition-all"
                        name="remember">
                    <span class="ms-2 text-xs text-zinc-400">Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-xs text-zinc-400 hover:text-white transition-colors"
                        href="{{ route('password.request') }}">
                        Forgot password?
                    </a>
                @endif
            </div>

            <button type="submit"
                class="w-full bg-white text-zinc-950 font-semibold py-2 rounded-md transition-all hover:bg-zinc-200 focus:ring-2 focus:ring-white/20 active:scale-[0.98] mt-2 shadow-lg shadow-white/5">
                Sign In
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-zinc-800 text-center">
            <p class="text-zinc-500 text-xs">
                Don't have an account?
                <a href="{{ route('register') }}"
                    class="text-white hover:underline underline-offset-4 transition-colors font-medium">Sign up</a>
            </p>
        </div>
    </div>
</x-guest-layout>