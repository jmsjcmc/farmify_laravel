<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="grid md:grid-cols-2 sm:grid-cols-1 md:gap-2 sm:gap-1">
            <div class="flex flex-col">
                <span class="mb-1 text-sm">First Name</span>
                <div class="flex flex-col flex-grow">
                    <input type="text" name="first_name" class="rounded-md text-sm">
                </div>
            </div>

            <div class="flex flex-col">
                <span class="mb-1 text-sm">Last Name</span>
                <div class="flex flex-col flex-grow">
                    <input type="text" name="last_name" class="rounded-md text-sm">
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-2 mt-2">
            <div class="flex flex-col">
                <span class="mb-1 text-sm">Email</span>
                <div class="flex flex-col flex-grow">
                    <input type="email" name="email" class="rounded-md text-sm">
                </div>
            </div>

            <div class="flex flex-col">
                <span class="mb-1 text-sm">Username</span>
                <div class="flex flex-col flex-grow">
                    <input type="text" name="username" class="rounded-md text-sm">
                </div>
            </div>

            <div class="flex flex-col">
                <span class="mb-1 text-sm">Password</span>
                <div class="flex flex-col flex-grow">
                    <input id="password" type="password" name="password" class="rounded-md text-sm" onkeyup="passwordMatch()">
                </div>
            </div>

            <div class="flex flex-col">
                <span class="mb-1 text-sm">Confirm Password</span>
                <div class="flex flex-col flex-grow">
                    <input id="password_confirmation" type="password" name="password_confirmation" class="rounded-md text-sm" onkeyup="passwordMatch()">
                    <span id="password-message" class="text-sm"></span>
                </div>
            </div>

        </div>

        <div class="mt-10">
            <button type="submit" class="group px-6 py-1 w-full rounded-lg bg-neutral-50 border text-green-500 hover:bg-green-500">
                    <span class="group-hover:text-white text-sm transition-all duration-300 uppercase font-semibold">Create Account</span>
            </button>

            <p class="text-sm flex justify-center mt-5">Already have an account? <a href="{{ route('login') }}" class="ml-1 text-green-500 hover:underline">Login here</a></p>

        </div>
    </form>

   @vite(['resources/js/registration.js'])
</x-guest-layout>
