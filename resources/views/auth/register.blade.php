<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <x-jet-label for="name" value="{{ __('Ad Soyad') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="tc" value="{{ __('T.C Kimlik Numarası') }}" />
                <x-jet-input id="tc" class="block mt-1 w-full" type="number" name="tc" :value="old('tc')"/>
            </div>

            <div class="mt-4">
                <x-jet-label for="phone" value="{{ __('Telefon Numarası') }}" />
                <x-jet-input id="phone" class="block mt-1 w-full" type="number" name="phone" :value="old('phone')"/>
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Şifre') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Şifreyi Doğrula') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 mb-2 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div>
                <x-jet-label for="role" value="{{ __('Kullanıcı Tipi') }}" />
                <select id="role" type="" class="form-select rounded-md shadow-sm mt-1 mb-1 block w-full" name="role" :value="old('role')" required autocomplete="role">
                    @foreach ($roles as $role )
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
