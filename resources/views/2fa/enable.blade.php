<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            {{ __('Two-Factor Authentication') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-slate-200 relative">
                <!-- Gradient Top Border -->
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>

                <div class="p-8">
                    <!-- Intro -->
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center h-12 w-12 rounded-xl bg-indigo-50 text-indigo-600 mb-4">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 17h.01M9 20h.01M12 20h.01M15 20h.01M15 17h.01M15 12h.01M9 12h.01M9 17h.01M5 12V7m5 5v3m-9-8a3 3 0 013-3h2l3 3 4 4 4-4 3-3h2a3 3 0 013 3v5a3 3 0 01-3 3h-2l-3-3-4-4-4 4-3 3H5a3 3 0 01-3-3V7z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900">Setup Authenticator App</h3>
                        <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                            Use an app like Google Authenticator or Authy to scan the QR code below.
                        </p>
                    </div>

                    <!-- QR Code -->
                    <div class="flex justify-center mb-8">
                        <div class="p-4 bg-white border border-slate-200 rounded-2xl shadow-sm">
                            {!! $QR_Image !!}
                        </div>
                    </div>

                    <!-- Manual Secret -->
                    <div class="mb-8 bg-slate-50 rounded-xl p-4 border border-slate-100 text-center">
                        <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-2">Or enter code manually</p>
                        <p class="font-mono text-lg font-bold text-slate-800 tracking-wider break-all selection:bg-indigo-100">{{ $secret }}</p>
                    </div>

                    <!-- Error Handling -->
                    @if(session('error'))
                        <div class="mb-6 bg-rose-50 border border-rose-100 text-rose-600 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Verification Form -->
                    <form method="POST" action="{{ route('2fa.enable') }}" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label for="one_time_password" class="block text-sm font-medium text-slate-700 mb-1">Enter Verification Code</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <input type="text" 
                                       name="one_time_password" 
                                       id="one_time_password" 
                                       required 
                                       placeholder="e.g. 123 456"
                                       class="pl-10 block w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm py-3 transition-all bg-slate-50 focus:bg-white tracking-widest font-mono text-center text-lg"
                                >
                            </div>
                        </div>

                        <button type="submit" class="w-full flex justify-center items-center gap-2 py-3 px-4 border border-transparent rounded-xl shadow-lg shadow-indigo-200 text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform hover:-translate-y-0.5">
                            Enable 2FA
                        </button>
                    </form>
                    
                    <div class="mt-6 text-center border-t border-slate-100 pt-6">
                        <a href="{{ route('profile.edit') }}" class="text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                            Cancel Setup
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>