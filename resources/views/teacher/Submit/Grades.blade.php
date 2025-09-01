<x-teacher-component>
    <div class="container mt-4">
        <!-- Page Header -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">📑 Submit Grades</h4>
            </div>
            <div class="card-body">
                <!-- Filters -->
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Select Subject</label>
                        <select class="form-select">
                            <option value="">-- Choose Subject --</option>
                            <option>Math 101</option>
                            <option>English 102</option>
                            <option>Science 103</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Select Section</label>
                        <select class="form-select">
                            <option value="">-- Choose Section --</option>
                            <option>BSIT - 1A</option>
                            <option>BSIT - 1B</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Select Term</label>
                        <select class="form-select">
                            <option value="">-- Choose Term --</option>
                            <option>Prelim</option>
                            <option>Midterm</option>
                            <option>Semi-Final</option>
                            <option>Final</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grades Preview -->
        <div class="card shadow-sm">
            <div class="card-header bg-light">
                <h5 class="mb-0">📊 Grades Preview</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>Student Name</th>
                                <th>Term Grade</th>
                                <th>Remarks</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td class="text-start">Juan Dela Cruz</td>
                                <td>88</td>
                                <td>-</td>
                                <td><span class="badge bg-secondary">Pending</span></td>
                            </tr>
                            <tr>
                                <td class="text-start">Maria Santos</td>
                                <td>90</td>
                                <td>-</td>
                                <td><span class="badge bg-secondary">Pending</span></td>
                            </tr>
                            <tr>
                                <td class="text-start">Carlos Reyes</td>
                                <td>75</td>
                                <td>Incomplete</td>
                                <td><span class="badge bg-secondary">Pending</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Actions -->
                <div class="d-flex justify-content-between mt-3">
                    <button class="btn btn-outline-success">
                        ⬇ Export to Excel
                    </button>
                    <button class="btn btn-primary">
                        📤 Submit to Dean
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</x-teacher-component>
