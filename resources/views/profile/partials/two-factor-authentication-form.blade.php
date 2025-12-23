<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Two Factor Authentication') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Add additional security to your account using two factor authentication.') }}
        </p>
    </header>

    @if (Auth::user()->google2fa_enabled)
        <div class="flex items-center gap-4">
            <div class="text-green-600 font-medium">
                {{ __('You have enabled two factor authentication.') }}
            </div>
            
            <!-- Disable Button (Requires Password Confirmation logic if you want to be fancy, but simple form works too) -->
            <form method="POST" action="{{ route('2fa.disable') }}" class="mt-6 space-y-6">
                @csrf
                
                <div>
                    <x-input-label for="password" value="{{ __('Current Password to Disable') }}" />
                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <x-danger-button>
                    {{ __('Disable 2FA') }}
                </x-danger-button>
            </form>
        </div>
    @else
        <div class="flex items-center gap-4">
            <div class="text-gray-600">
                {{ __('You have not enabled two factor authentication.') }}
            </div>

            <a href="{{ route('2fa.form') }}">
                <x-primary-button>
                    {{ __('Enable') }}
                </x-primary-button>
            </a>
        </div>
    @endif
</section>