<x-auth-component>
     <div class="auth-form">
        <div class="auth-header">
          <a href="#"><img src="{{asset('all/assets/images/logo-dark.svg ')}}" alt="img"></a>
        </div>
        <div class="card my-5">
            <div class="card-body">

                {{-- Student Name Card --}}
                <div class="card mb-3 border-left-success shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold mb-0">
                            <H3><b>Student Name</b></H3>
                        </h5>
                    </div>
                </div>

                {{-- Instruction Notice Card --}}
                <div class="card mb-3 border-left-warning shadow-sm">
                    <div class="card-body">
                        <h6 class="mb-0">Please log in to the student voting portal to begin the election process.
                        </h6>
                    </div>
                </div>

                {{-- Credentials Card --}}
                <div class="card mb-4 border-left-primary shadow-sm">
                    <div class="card-body">
                        <h5 class="fw-bold text-info mb-3">Student Credentials</h5>
                        <div class="row mb-2">
                            <div class="col-md-4 fw-bold">Username:</div>
                            <div class="col-md-8"><B>{{ $studentUsername }}</B></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 fw-bold">Password:</div>
                            <div class="col-md-8"><b>{{ $studentPassword }}</b></div>
                        </div>
                    </div>
                </div>

                {{-- parent/guardian credentials --}}

                 <div class="card mb-4 border-left-primary shadow-sm">
                    <div class="card-body">
                         <h5 class="fw-bold text-info mb-3">Parent Credentials</h5>
                        <div class="row mb-2">
                            <div class="col-md-4 fw-bold">Username:</div>
                            <div class="col-md-8"><B>{{ $parentUsername }}</B></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 fw-bold">Password:</div>
                            <div class="col-md-8"><b>{{ $parentPassword }}</b></div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="text-center mb-3 mb-md-0">
                    <a href="{{ url('/') }}" class="btn btn-primary btn-md mx-2 mb-2 mb-sm-0">
                        <i class="fas fa-sign-in-alt mr-1"></i> Login Portal
                    </a>
                    <a href="{{ url('/register') }}" class="btn btn-success btn-md mx-2 text-white mb-2 mb-sm-0">
                        <i class="fas fa-user-plus mr-1"></i> Register New Student
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-auth-component>
