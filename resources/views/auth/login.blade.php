<x-guest-layout>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-5">
                <x-auth-card>
                    <x-slot name="logo">
                        <a href="/">
                            {{-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> --}}
                        </a>
                    </x-slot>

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4 text-center">
                            <img src="https://www.ledconcept.cl/new/wp-content/uploads/2018/02/Logo-led-concept.png" alt="">
                        </div>
                        <!-- Email Address -->
                        <div>
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="form-control block mt-1 w-full" type="email" name="email"
                                :value="old('email')" required autofocus />
                        </div>

                        <!-- Password -->
                        <div class="mt-4">
                            <x-label class="form-label" for="password" :value="__('Password')" />

                            <x-input id="password" class="form-control block mt-1 w-full" type="password"
                                name="password" required autocomplete="current-password" />
                        </div>



                        <div class="flex items-center justify-end mt-4 d-grid gap-2">


                            <x-button class="ml-3 btn btn-primary btn-inline">
                                {{ __('Ingresar') }}
                            </x-button>
                        </div>
                    </form>
                </x-auth-card>
            </div>
        </div>

    </div>

</x-guest-layout>
