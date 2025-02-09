<x-client.app>
    <x-slot name="title">Login</x-slot>
    <x-slot name="style">
        <style>
            .auth-container {
                max-width: 400px;
                background: rgba(255, 255, 255, 0.9);
                padding: 20px;
                margin: 0 auto;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            }

            .video-background {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: -1;
                /* Place it behind other content */
                object-fit: cover;
                /* Cover the entire area */
            }
        </style>
    </x-slot>
    <x-slot name="content">
        <div class="container-fluid" style="position:relative;height:90vh;">
            <video autoplay muted loop class="video-background">
                <source src="{{asset('videos/background-video.mp4')}}" type="video/mp4" />
                Your browser does not support the video tag.
            </video>
            <div class="row h-100 align-items-center text-center">
                <div class="auth-container">
                    <h2 class="text-coffee">Login</h2>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="email" name="email" class="form-control mb-2" placeholder="Email" />
                        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                        <input type="password" name="password" class="form-control mb-2" placeholder="Password" />
                        @error('password')<small class="text-danger">{{ $message }}</small>@enderror
                        <button type="submit" class="btn btn-dark w-100">Login</button>

                    </form>
                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>
                    <p class="mt-3">Don't have an account? <a href="#" data-bs-toggle="tab" data-bs-target="#register">Register</a></p>
                </div>
            </div>
        </div>
    </x-slot>
</x-client.app>