<x-parent-component>
  <div class="page-header">
    <div class="page-block">
      <div class="row align-items-center">
        <div class="col-md-12">
          <div class="page-header-title">
            <h5 class="m-b-10">Parent Dashboard</h5>
          </div>
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item" aria-current="page">Overview</li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- [ Main Content ] start -->
  <div class="row g-4">
    <!-- Attendance -->
    <div class="col-md-6 col-xl-3">
      <div class="card shadow-lg border-0 h-100 custom-card">
        <div class="card-body text-center">
          <h6 class="mb-2 text-muted">Child Attendance</h6>
          <h4 class="mb-3 fw-bold">95% 
            <span class="badge bg-light-success border border-success">
              <i class="ti ti-check"></i>
            </span>
          </h4>
          <p class="mb-0 text-muted">Present <span class="text-success">19 days</span> / Absent <span class="text-danger">1 day</span></p>
        </div>
      </div>
    </div>

    <!-- Quiz Results -->
    <div class="col-md-6 col-xl-3">
      <div class="card shadow-lg border-0 h-100 custom-card">
        <div class="card-body text-center">
          <h6 class="mb-2 text-muted">Quiz Results</h6>
          <h4 class="mb-3 fw-bold">85% 
            <span class="badge bg-light-primary border border-primary">
              <i class="ti ti-pencil"></i>
            </span>
          </h4>
          <p class="mb-0 text-muted">Latest quiz: <span class="text-primary">Passed</span></p>
        </div>
      </div>
    </div>

    <!-- Exam Results -->
    <div class="col-md-6 col-xl-3">
      <div class="card shadow-lg border-0 h-100 custom-card">
        <div class="card-body text-center">
          <h6 class="mb-2 text-muted">Exam Results</h6>
          <h4 class="mb-3 fw-bold">88% 
            <span class="badge bg-light-warning border border-warning">
              <i class="ti ti-book"></i>
            </span>
          </h4>
          <p class="mb-0 text-muted">Latest exam: <span class="text-success">Good performance</span></p>
        </div>
      </div>
    </div>

    <!-- Notes / Announcements -->
    <div class="col-md-6 col-xl-3">
      <div class="card shadow-lg border-0 h-100 custom-card">
        <div class="card-body text-center">
          <h6 class="mb-2 text-muted">Teacher Notes</h6>
          <h4 class="mb-3 fw-bold">3 
            <span class="badge bg-light-danger border border-danger">
              <i class="ti ti-message"></i>
            </span>
          </h4>
          <p class="mb-0 text-muted">New updates from teachers</p>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->

  <style>
    .custom-card {
      transition: all 0.3s ease-in-out;
      min-height: 180px; /* makes all cards equal height */
      border-radius: 15px;
    }
    .custom-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
  </style>
</x-parent-component>
