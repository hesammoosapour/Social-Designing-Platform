<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <div class="row justify-content-center rtl ">
            <div class="col-lg-5 bg-white shadow-md py-5">
                <h4 class="text-center">{{__('فرم ورود')}}</h4>
                <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                    <div>
                        <x-label for="email" :value="__('ایمیل')" />

                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('رمز عبور')" />

                        <x-input id="password" class="block mt-1 w-full"
                                 type="password"
                                 name="password"
                                 required autocomplete="current-password" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('مرا به خاطر داشته باش') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-start mt-4">

                        <x-button class="ml-3">
                            {{ __('ورود') }}
                        </x-button>

                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('رمز عبور خود را فراموش کرده اید؟') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
            <div class="col-1 border-5 border-gray-100 bg-gray-100"></div>
            <div class="col-lg-5 bg-white shadow-md py-5">
                <h4 class="text-center">{{__('فرم ثبت نام')}}</h4>
                <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('نام')" />

                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('ایمیل')" />

                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    </div>

                    {{-- Username                   --}}
                    <div class="mt-4">
                        <x-label for="username" :value="__('نام کاربری')" />

                        <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required />
                    </div>

                    {{-- Phone Number                   --}}
                    <div class="mt-4">
                        <x-label for="phone" :value="__('شماره همراه')" />

                        <x-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')"
                              max="11" min="10"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('رمز عبور')" />

                        <x-input id="password" class="block mt-1 w-full"
                                 type="password"
                                 name="password"
                                 required autocomplete="new-password" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-label for="password_confirmation" :value="__('تایید رمز عبور')" />

                        <x-input id="password_confirmation" class="block mt-1 w-full"
                                 type="password"
                                 name="password_confirmation" required />
                    </div>

                    <div class="flex items-center justify-start mt-4">
{{--                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">--}}
{{--                            {{ __('Already registered?') }}--}}
{{--                        </a>--}}

                        <x-button class="ml-4">
                            {{ __('ثبت نام') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            var phone = document.getElementById('phone');
            phone.oninput = function () {
                if (this.value.length > 11) {
                    this.value = this.value.slice(0,11);
                }
            }
        </script>

    </x-auth-card>
</x-guest-layout>
