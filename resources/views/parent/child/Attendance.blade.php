<x-parent-component>
    <div class="container mt-4">

        <!-- Page Header -->
        <h3 class="page-header">📅 Child's Attendance</h3>
        <p class="text-muted">Track your child's daily and monthly attendance records.</p>

        <!-- Filters -->
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Linked Student</label> <!-- 🔹 Changed here -->
                        <select class="form-select">
                            <option>Juan Dela Cruz</option>
                            <option>Maria Dela Cruz</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Month</label>
                        <select class="form-select">
                            <option>August 2025</option>
                            <option>September 2025</option>
                            <option>October 2025</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="button" class="btn btn-primary w-100">
                            <i class="ti ti-download"></i> Download Report
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Attendance Summary -->
        <div class="row text-center mb-4">
            <div class="col-md-3">
                <div class="card shadow-sm p-3">
                    <h5 class="text-success">✅ Present</h5>
                    <p class="fs-4 fw-bold">18</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm p-3">
                    <h5 class="text-danger">❌ Absent</h5>
                    <p class="fs-4 fw-bold">2</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm p-3">
                    <h5 class="text-warning">🕒 Late</h5>
                    <p class="fs-4 fw-bold">1</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow-sm p-3">
                    <h5 class="text-primary">📊 Attendance Rate</h5>
                    <p class="fs-4 fw-bold">90%</p>
                </div>
            </div>
        </div>

        <!-- Attendance Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="mb-3">📖 Detailed Attendance</h5>
                <table class="table table-bordered table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>August 1, 2025</td>
                            <td><span class="badge bg-success">Present</span></td>
                            <td>-</td>
                        </tr>
                        <tr>
                            <td>August 2, 2025</td>
                            <td><span class="badge bg-danger">Absent</span></td>
                            <td>Sick Leave</td>
                        </tr>
                        <tr>
                            <td>August 3, 2025</td>
                            <td><span class="badge bg-warning">Late</span></td>
                            <td>Arrived 15 mins late</td>
                        </tr>
                        <tr>
                            <td>August 4, 2025</td>
                            <td><span class="badge bg-success">Present</span></td>
                            <td>-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Note Section -->
        <div class="alert alert-info mt-4">
            <i class="ti ti-info-circle"></i> Attendance records are updated daily by the teacher. 
            Please contact the class adviser for clarifications.
        </div>

    </div>
</x-parent-component>
