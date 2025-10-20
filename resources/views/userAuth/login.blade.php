<x-auth-component>
    <div class="auth-form d-flex flex-column align-items-center justify-content-center min-vh-100"
         style="background: url('{{ asset('all/assets/images/school.png') }}') no-repeat center center;
                background-size: cover;
                font-family: 'Poppins', sans-serif;
                position: relative;">

        {{-- Login Card --}}
        <div class="card shadow-lg border-0" style="width: 100%; max-width: 400px; border-radius: 15px; z-index: 2; background-color: rgba(255,255,255,0.95);">
            <div class="card-body p-4">

                {{-- Logo & Heading --}}
                <div class="text-center mb-4">
                    <a href="#"><img src="{{ asset('all/assets/images/logo1.png')}}" alt="Logo" class="d-block mx-auto" style="width: 60px;"></a>
                    <h3 class="mt-3"><b>Login</b></h3>
                    <small class="text-muted">Welcome back! Please login to your account.</small>
                </div>

                {{-- Error Messages --}}
                @if ($errors->any())
                    <div class="alert alert-danger py-2">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                {{-- Success Message --}}
                @if (session('success'))
                    <div class="alert alert-success py-2">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('signin') }}">
                    @csrf

                    {{-- Username --}}
                    <div class="form-group mb-3 position-relative">
                        <label class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fas fa-user text-muted"></i></span>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                                   placeholder="Enter your username" value="{{ old('username') }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="form-group mb-3 position-relative">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white"><i class="fas fa-lock text-muted"></i></span>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Enter your password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Remember Me + Register Link --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label" for="remember">Keep me signed in</label>
                        </div>
                        <a href="{{ route('register') }}" class="text-primary small">Don't have an account?</a>
                    </div>

                    {{-- Submit --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg" style="border-radius: 10px;">Login</button>
                    </div>



                </form>
            </div>
        </div>
    </div>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</x-auth-component>






 