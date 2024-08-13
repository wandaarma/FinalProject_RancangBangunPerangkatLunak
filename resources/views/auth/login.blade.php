<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h2 class="textlogin">Log In</h2>

        <!-- Email Address -->
        <div>
            <x-text-input id="email" class="block mt-1 w-full form-field" placeholder="Email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>

            <x-text-input id="password" class="block mt-1 w-full form-field"
            placeholder="Password"
            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                style="color: #91A085; font-size: 13px;"
                href="#">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>
        <p></p>
            <x-my-button Value="Log In">
                {{ __('Log In') }}
            </x-my-button>
        <p></p>
            <span class="ket">Don't have an account yet?
                <a class="underline text-sm hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                style="color: #91A085; font-size: 13px;"
                    href="{{ route('register') }}">
                    {{ __('Sign Up') }}
                </a>
            </span>
    </form>
</x-guest-layout>
