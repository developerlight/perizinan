<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form> -->

    <div class="bg-white dark:bg-gray-900 flex items-center justify-center h-screen">
        <div class="w-full max-w-screen-xl max-h-max gap-5 sm:flex sm:justify-between bg-gray-100 rounded-lg shadow">
            <div class="py-8 px-8 hidden sm:block">
                <img src="{{ asset('assets/login.png')}}" class="max-w-xl rounded-lg shadow-lg" alt="">
            </div>
            <div class="w-full max-w-lg px-6 py-8 bg-white rounded-lg sm:rounded-e-lg shadow dark:border dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-6">
                    <h1 class="text-4xl font-bold text-gray-900 md:text-2xl dark:text-white">Sistem Perizinan Guru dan Siswa.</h1>
                    <form method="POST" action="{{ route('login') }}" class="space-y-4">
                        @csrf
                        <div>
                            <x-input-label for="email" :value="__('Email')" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" />
                            <x-text-input id="email" class="w-full p-2.5 rounded-lg bg-gray-50 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="password" :value="__('Password')" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" />
                            <x-text-input id="password" class="w-full p-2.5 rounded-lg bg-gray-50 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:text-white" type="password" name="password" required autocomplete="current-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="block mt-4">
                            <label for="remember_me" class="inline-flex items-center">
                                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                        <x-primary-button class="w-full items-center flex justify-center text-white bg-blue-600 hover:bg-blue-700 p-2.5 rounded-lg text-sm">
                            {{ __('Masuk') }}
                        </x-primary-button>
                        <div class="text-center">
                            <h5 class="font-semibold text-2xl mt-5 mb-3">
                                SMA NEGRI 1 BANYUWANGI
                            </h5>
                            <p class="font-normal">
                                Jl. Ikan Tongkol, Kertosari, Kec. Banyuwangi, Kabupaten Banyuwangi, Jawa Timur 68418
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>