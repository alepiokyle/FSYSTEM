<x-auth-component>
  <div class="auth-form">
    <div class="auth-header">
      <a href="#"><img src="{{asset('all/assets/images/logo-dark.svg')}}" alt="img"></a>
    </div>

    <form method="POST" action=" {{ route('register.store') }}">
      @csrf
      <div class="card my-5">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-end mb-4">
            <h3 class="mb-0"><b>Sign up</b></h3>
            <a href="{{ url('/') }}" class="link-primary">Already have an account?</a>
          </div>

          <!-- Student Information -->
          <h5 class="mb-3"><b>Student Information</b></h5>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="form-label">Student ID*</label>
                <input type="text" class="form-control" name="student_id" placeholder="Student ID">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="form-label">First Name*</label>
                <input type="text" class="form-control" name="first_name" placeholder="First Name">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="form-label">Middle Name*</label>
                <input type="text" class="form-control" name="middle_name" placeholder="Middle Name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="form-label">Last Name*</label>
                <input type="text" class="form-control" name="last_name" placeholder="Last Name">
              </div>
            </div>
          </div>

          <div class="row">
            <!-- Gender Radio -->
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="form-label d-block">Gender*</label>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                  <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                  <label class="form-check-label" for="female">Female</label>
                </div>
              </div>
            </div>
          </div>

          <!-- Parent / Guardian Information -->
          <h5 class="mt-4 mb-3"><b>Parent/Guardian Information</b></h5>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="form-label">First Name*</label>
                <input type="text" class="form-control" name="parent_first_name" placeholder="First Name">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="form-label">Last Name*</label>
                <input type="text" class="form-control" name="parent_last_name" placeholder="Last Name">
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="form-label">Contact Number*</label>
                <input type="text" class="form-control" name="parent_contact" placeholder="Contact Number">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group mb-3">
                <label class="form-label">Email (Optional)</label>
                <input type="email" class="form-control" name="parent_email" placeholder="Email Address">
              </div>
            </div>
          </div>

          <!-- Relationship Radio -->
          <div class="col-md-12">
            <div class="form-group mb-3">
              <label class="form-label d-block">Relationship*</label>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="relationship" id="guardian" value="guardian">
                    <label class="form-check-label" for="guardian">Guardian</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="relationship" id="mother" value="mother">
                    <label class="form-check-label" for="mother">Mother</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="relationship" id="father" value="father">
                    <label class="form-check-label" for="father">Father</label>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group mb-3">
            <label class="form-label">Address*</label>
            <input type="text" class="form-control" name="address" placeholder="Complete Address">
          </div>

          <p class="mt-4 text-sm text-muted">
            By Signing up, you agree to our
            <a href="#" class="text-primary"> Terms of Service </a> and
            <a href="#" class="text-primary"> Privacy Policy</a>
          </p>

          <div class="d-grid mt-3">
            <button type="submit" class="btn btn-primary">Create Account</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</x-auth-component>
