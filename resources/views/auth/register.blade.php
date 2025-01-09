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
                    <input type="password" name="password" class="rounded-md text-sm">
                </div>
            </div>

        </div>



        <div class="flex items-center justify-between mt-4">
            <button class="group px-6 py-1 rounded-lg bg-neutral-50 border text-green-500 hover:bg-green-500">
                <a href="{{ route('login')}}">
                    <span class="group-hover:text-white text-sm transition-all duration-300 uppercase font-semibold">Login</span>
                </a>
            </button>

            <button class="group px-6 py-1 rounded-lg bg-green-500 border text-white hover:bg-neutral-50 hover:text-green-500">
                <a href="{{ route('register') }}">
                    <span class="group-hover:text-green-500 text-sm transition-all duration-300 uppercase font-semibold">Register</span>
                </a>
            </button>
        </div>
    </form>
</x-guest-layout>
