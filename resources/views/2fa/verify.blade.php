<x-guest-layout>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <!-- Header -->
        <div class="sm:mx-auto sm:w-full sm:max-w-sm text-center">
            <a href="/" class="inline-flex items-center justify-center h-12 w-12 rounded-xl bg-indigo-50 text-indigo-600 mb-4">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            </a>
            <h2 class="text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Two-Factor Authentication
            </h2>
            <p class="mt-2 text-center text-sm text-gray-500">
                Please enter the code from your authenticator app to continue.
            </p>
        </div>

        <!-- Form Card -->
        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            
            @if(session('error'))
                <div class="mb-6 bg-rose-50 border border-rose-100 text-rose-600 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('2fa.verify.post') }}" class="space-y-6">
                @csrf
                
                <div>
                    <label for="one_time_password" class="block text-sm font-medium leading-6 text-gray-900">Authentication Code</label>
                    <div class="mt-2 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        </div>
                        <input type="text" 
                               name="one_time_password" 
                               id="one_time_password" 
                               required 
                               autofocus
                               placeholder="123 456"
                               class="block w-full rounded-xl border-0 py-3 pl-10 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 transition-all text-center tracking-widest font-mono text-lg"
                        >
                    </div>
                </div>

                <div>
                    <button type="submit" class="flex w-full justify-center rounded-xl bg-indigo-600 px-3 py-3 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition-all duration-200 transform hover:-translate-y-0.5">
                        Verify & Login
                    </button>
                </div>
            </form>

            <p class="mt-10 text-center text-sm text-gray-500">
                Lost your device?
                <a href="#" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500 transition">Contact Support</a>
            </p>
        </div>
    </div>
</x-guest-layout>