<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900">Create an account</h2>
        <p class="text-sm text-gray-500">Join us to start shopping securely.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" class="text-gray-700 font-medium" />
            <x-text-input id="name" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 py-2.5 px-4" 
                          type="text" name="name" :value="old('name')" required autofocus autocomplete="name" 
                          placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
            <x-text-input id="email" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 py-2.5 px-4" 
                          type="email" name="email" :value="old('email')" required autocomplete="username" 
                          placeholder="name@company.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
            <!-- 🔥 NEW: Password Requirements Text -->
            <p class="text-xs text-gray-500 mb-2">
                Must be at least 8 characters, include uppercase & lowercase letters, a number, and a symbol.
            </p>
            <x-text-input id="password" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 py-2.5 px-4" 
                          type="password" name="password" required autocomplete="new-password" 
                          placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-medium" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 py-2.5 px-4" 
                          type="password" name="password_confirmation" required autocomplete="new-password" 
                          placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full justify-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-4 rounded-lg shadow-sm transition duration-150 ease-in-out">
            {{ __('Create Account') }}
        </button>

        <!-- Login Link -->
        <p class="text-center text-sm text-gray-600 mt-4">
            Already have an account? 
            <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:text-indigo-500 hover:underline">
                Log in
            </a>
        </p>
    </form>
</x-guest-layout>