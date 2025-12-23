<x-guest-layout>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <!-- Header -->
        <div class="sm:mx-auto sm:w-full sm:max-w-sm text-center">
            <a href="/" class="inline-flex items-center gap-2 group">
                <!-- 🔥 Purple Icon -->
                <x-application-logo class="h-10 w-auto text-purple-600 fill-current group-hover:text-purple-500 transition" />
                <span class="text-xl font-bold tracking-tight text-gray-900">SecureShop</span>
            </a>
            <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Reset your password
            </h2>
            <p class="mt-2 text-center text-sm text-gray-500">
                Enter your new password below.
            </p>
        </div>

        <!-- Form -->
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                    <div class="mt-2">
                        <input id="email" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium leading-6 text-gray-900">New Password</label>
                    <!-- 🔥 NEW: Password Requirements Text -->
                    <p class="text-xs text-gray-500 mb-2 mt-1">
                        Must be at least 8 characters, include uppercase & lowercase letters, a number, and a symbol.
                    </p>
                    <div class="mt-2">
                        <input id="password" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">Confirm New Password</label>
                    <div class="mt-2">
                        <input id="password_confirmation" class="block w-full rounded-md border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                <div class="pt-2">
                    <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition duration-150 ease-in-out">
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>