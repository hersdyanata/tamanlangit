<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    
    <form class="login-form" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="card mb-0">
            <div class="card-body">
                <div class="text-center mb-3">
                    <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
                        <img src="{{ asset('assets/images/logo_icon.svg') }}" class="h-48px" alt="">
                    </div>
                    <h5 class="mb-0">Login ke Backend Panel</h5>
                    <span class="d-block text-muted">Silahkan masukkan email dan password</span>
                </div>

                <div class="mb-3">
                    <x-input-label class="form-label" for="email" :value="__('Email')" />
                    <div class="form-control-feedback form-control-feedback-start">
                        <x-text-input
                            id="email" 
                            class="form-control" 
                            type="email" 
                            name="email" 
                            :value="old('email')" required autofocus autocomplete="username"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            <div class="form-control-feedback-icon">
                            <i class="ph-user-circle text-muted"></i>
                        </div>    
                    </div>
                </div>

                <div class="mb-3">
                    <x-input-label class="form-label" for="email" :value="__('Password')" />
                    <div class="form-control-feedback form-control-feedback-start">
                        <x-text-input
                            id="password" 
                            class="form-control" 
                            type="password" 
                            name="password" 
                            required autofocus autocomplete="current-password"/>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            <div class="form-control-feedback-icon">
                            <i class="ph-lock text-muted"></i>
                        </div>    
                    </div>
                </div>

                <div class="d-flex align-items-center mb-3">
                    <label class="form-check">
                        <input type="checkbox" name="remember" id="remember_me" class="form-check-input">
                        <span class="form-check-label">Ingat saya</span>
                    </label>
                </div>

                <div class="mb-3">
                    <x-primary-button class="btn btn-primary w-100">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>

                <span class="form-text text-center text-muted">Sebaiknya halaman ini tidak disebarluaskan. Meninjau <code>Access Control List</code> secara berkala, dan mengganti password secara berkala.</span>
            </div>
        </div>
    </form>
</x-guest-layout>