
    <x-auth-component>
        <div class="auth-form">
            <div class="auth-header">
                <a href="#"><img src="{{ asset('all/assets/images/logo-dark.svg')}}" alt="img"></a>
            </div>
            <div class="card my-5">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-end mb-4">
                        <h3 class="mb-0"><b>Login</b></h3>
                        <a href="{{ url('register')}}" class="link-primary">Don't have an account?</a>
                    </div>

                    {{-- Display Error Messages --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Display Success Messages --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('signin') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                                   placeholder="Username" value="{{ old('username') }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex mt-1 justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input input-primary" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label text-muted" for="remember">Keep me signed in</label>
                            </div>
                            <h5 class="text-secondary f-w-400">Forgot Password?</h5>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>

                        <div class="saprator mt-3">
                            <span>Login with</span>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-4">
                            <div class="d-grid">
                                <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                                    <img src="../assets/images/authentication/google.svg" alt="img">
                                    <span class="d-none d-sm-inline-block"> Google</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-grid">
                                <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                                    <img src="../assets/images/authentication/twitter.svg" alt="img">
                                    <span class="d-none d-sm-inline-block"> Twitter</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="d-grid">
                                <button type="button" class="btn mt-2 btn-light-primary bg-light text-muted">
                                    <img src="../assets/images/authentication/facebook.svg" alt="img">
                                    <span class="d-none d-sm-inline-block"> Facebook</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="auth-footer row">
                <div class="col my-1">
                    <p class="m-0">Copyright © <a href="#">Codedthemes</a></p>
                </div>
                <div class="col-auto my-1">
                    <ul class="list-inline footer-link mb-0">
                        <li class="list-inline-item"><a href="#">Home</a></li>
                        <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                        <li class="list-inline-item"><a href="#">Contact us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </x-auth-component>

