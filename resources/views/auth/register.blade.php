<x-guest-layout>
    <h3 class="mt-4 text-center text-xl font-semibold leading-9 tracking-tight text-gray-900">New User Information</h3> 
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- First Name -->
        <div>
            <x-input-label for="first_name" :value="__('First Name')" />
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" :value="old('first_name')" required autofocus autocomplete="first_name" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
        </div>

        <!-- Last Name -->
        <div>
            <x-input-label for="last_name" :value="__('Last Name')" />
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus autocomplete="last_name" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Role -->
        <div>
            <x-input-label for="role" :value="__('Role')" />
            <x-text-input id="role" class="block mt-1 w-full" type="text" name="role" :value="old('role')" required autofocus autocomplete="role" />
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div>
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" class="block mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autofocus autocomplete="phone_number" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>

        <!-- Department -->
        <div>
            <x-input-label for="department" :value="__('Department')" />
            <x-text-input id="department" class="block mt-1 w-full" type="text" name="department" :value="old('department')" required autofocus autocomplete="department" />
            <x-input-error :messages="$errors->get('department')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            {{-- <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a> --}}

            <x-primary-button class="">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
