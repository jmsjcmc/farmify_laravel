<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf


        <div>
            <x-input-label for="login" :value="__('Username')" />
            <x-text-input id="login" class="block mt-1 w-full text-sm" placeholder="Username or Email"
                type="text"
                name="login"
                :value="old('login')"
                required autofocus />
            <x-input-error :messages="$errors->get('login')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />


    <div class="relative">
        <x-text-input id="password"
            class="block mt-1 w-full text-sm pr-10"
            type="password"
            name="password"
            required
            autocomplete="current-password" />

        <button type="button" id="togglePassword" class="absolute icon-size-5 right-2 top-2 text-gray-900 ">
            <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
            <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" /><path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" /><path d="M3 3l18 18" /></svg>
        </button>
    </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex mt-4 items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="mt-10">
            <button type="submit" class="group px-6 py-1 w-full rounded-lg bg-neutral-50 border text-green-500 hover:bg-green-500">
                    <span class="group-hover:text-white text-sm transition-all duration-300 uppercase font-semibold">Login</span>
            </button>

            <p class="text-sm flex justify-center mt-5">Don't have an account? <a href="{{ route('register') }}" class="ml-1 text-green-500 hover:underline">Register here</a></p>
            {{-- <button class="group px-6 py-1 rounded-lg bg-green-500 border text-white hover:bg-neutral-50 hover:text-green-500">
                <a href="{{ route('register') }}">
                    <span class="group-hover:text-green-500 text-sm transition-all duration-300 uppercase font-semibold">Register</span>
                </a>
            </button> --}}
        </div>
    </form>

    @vite(['resources/js/login.js'])
</x-guest-layout>
