<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <h2 class="textsignup">Sign Up</h2>

        <!-- Name -->
        <div>
            <x-text-input id="name" class="block mt-1 w-full form-field" placeholder="Name" type="text"
                name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-text-input id="email" class="block mt-1 w-full form-field" placeholder="Email" type="email"
                name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>

            <x-text-input id="password" class="block mt-1 w-full form-field" placeholder="Password" type="password"
                name="password" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>

            <x-text-input id="password_confirmation" class="block mt-1 w-full form-field" placeholder="Confirm Password"
                type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-my-button Value="Sign Up">
            {{ __('Sign Up') }}
        </x-my-button>
        <p></p>
        <span class="ket">Already have an account?
            <a class="underline text-sm hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
            style="color: #91A085; font-size: 13px;"
                href="{{ route('login') }}">
                {{ __('Log In') }}
            </a>
        </span>

    </form>
</x-guest-layout>
