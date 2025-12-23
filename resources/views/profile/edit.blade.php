<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-900 leading-tight">
            {{ __('Profile Settings') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-slate-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Profile Information -->
            <div class="p-8 bg-white shadow-sm sm:rounded-2xl border border-slate-200 relative overflow-hidden">
                <!-- Gradient Top Border -->
                <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500"></div>
                
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Security Section Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Update Password -->
                <div class="p-8 bg-white shadow-sm sm:rounded-2xl border border-slate-200 h-full">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- 2FA Section -->
                <div class="p-8 bg-white shadow-sm sm:rounded-2xl border border-slate-200 relative overflow-hidden h-full">
                    <!-- Subtle Indigo Accent for Security -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-indigo-500"></div>
                    
                    <div class="max-w-xl">
                        @include('profile.partials.two-factor-authentication-form')
                    </div>
                </div>
            </div>

            <!-- Delete Account -->
            <div class="p-8 bg-white shadow-sm sm:rounded-2xl border border-slate-200">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>