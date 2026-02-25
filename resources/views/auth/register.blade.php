<x-guest-layout>
    <div
        class="w-full max-w-[400px] bg-zinc-900 border border-zinc-800 rounded-xl shadow-2xl p-8 relative overflow-hidden group">

        <!-- Header -->
        <div class="mb-8 text-center">
            <div
                class="inline-flex items-center justify-center w-12 h-12 rounded-lg bg-zinc-800 border border-zinc-700 mb-6 shadow-inner ring-1 ring-zinc-800/50">
                <i data-lucide="book-open" class="w-6 h-6 text-white"></i>
            </div>
            <h1 class="text-2xl font-bold text-white tracking-tight mb-2">Create Account</h1>
            <p class="text-zinc-400 text-sm">Join the community today</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div class="space-y-1.5">
                <label for="name" class="text-xs font-semibold text-zinc-300">Full Name</label>
                <input id="name"
                    class="block w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-md text-sm text-white placeholder-zinc-600 focus:ring-2 focus:ring-white/10 focus:border-white/20 transition-all outline-none"
                    type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="John Doe" />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <!-- Email -->
            <div class="space-y-1.5">
                <label for="email" class="text-xs font-semibold text-zinc-300">Email</label>
                <input id="email"
                    class="block w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-md text-sm text-white placeholder-zinc-600 focus:ring-2 focus:ring-white/10 focus:border-white/20 transition-all outline-none"
                    type="email" name="email" value="{{ old('email') }}" required placeholder="name@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div class="space-y-1.5">
                <label for="password" class="text-xs font-semibold text-zinc-300">Password</label>
                <input id="password"
                    class="block w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-md text-sm text-white placeholder-zinc-600 focus:ring-2 focus:ring-white/10 focus:border-white/20 transition-all outline-none"
                    type="password" name="password" required placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm Password -->
            <div class="space-y-1.5">
                <label for="password_confirmation" class="text-xs font-semibold text-zinc-300">Confirm Password</label>
                <input id="password_confirmation"
                    class="block w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-md text-sm text-white placeholder-zinc-600 focus:ring-2 focus:ring-white/10 focus:border-white/20 transition-all outline-none"
                    type="password" name="password_confirmation" required placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

            <button type="submit"
                class="w-full bg-white text-zinc-950 font-semibold py-2 rounded-md transition-all hover:bg-zinc-200 focus:ring-2 focus:ring-white/20 active:scale-[0.98] mt-2 shadow-lg shadow-white/5">
                Sign Up
            </button>
        </form>

        <div class="mt-8 pt-6 border-t border-zinc-800 text-center">
            <p class="text-zinc-500 text-xs">
                Already have an account?
                <a href="{{ route('login') }}"
                    class="text-white hover:underline underline-offset-4 transition-colors font-medium">Sign in</a>
            </p>
        </div>
    </div>
</x-guest-layout>