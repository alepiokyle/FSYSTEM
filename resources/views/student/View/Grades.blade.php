<x-student-component>
    <div class="container mt-4">
        <h3 class="page-header mb-4">📊 View Grades</h3>

        <!-- Filters -->
        <div class="card shadow-sm mb-3">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">School Year</label>
                        <select class="form-select">
                            <option>2024-2025</option>
                            <option>2023-2024</option>
                            <option>2022-2023</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Semester</label>
                        <select class="form-select">
                            <option>1st Semester</option>
                            <option>2nd Semester</option>
                            <option>Summer</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grades Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Subject Code</th>
                            <th>Subject Name</th>
                            <th>Units</th>
                            <th>Teacher</th>
                            <th>Grade</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>IT101</td>
                            <td>Introduction to Computing</td>
                            <td>3</td>
                            <td>Mr. Dela Cruz</td>
                            <td>89</td>
                            <td><span class="badge bg-success">Passed</span></td>
                        </tr>
                        <tr>
                            <td>ENG02</td>
                            <td>Purposive Communication</td>
                            <td>3</td>
                            <td>Ms. Santos</td>
                            <td>75</td>
                            <td><span class="badge bg-success">Passed</span></td>
                        </tr>
                        <tr>
                            <td>MATH01</td>
                            <td>College Algebra</td>
                            <td>3</td>
                            <td>Mr. Reyes</td>
                            <td>69</td>
                            <td><span class="badge bg-danger">Failed</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- GPA / GWA Summary -->
        <div class="alert alert-info mt-3">
            <strong>General Weighted Average (GWA):</strong> 2.25
        </div>
    </div>
</x-student-component>
