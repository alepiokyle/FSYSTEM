<x-student-component>
    <div class="container mt-4">
        <h3 class="page-header mb-4">📚 Enrolled Subjects</h3>

        <!-- Enrolled Subjects Table -->
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Subject Code</th>
                            <th scope="col">Subject Name</th>
                            <th scope="col">Units</th>
                            <th scope="col">Schedule</th>
                            <th scope="col">Teacher</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Row -->
                        <tr>
                            <td>IT101</td>
                            <td>Introduction to Computing</td>
                            <td>3</td>
                            <td>Mon/Wed 10:00–11:00 AM</td>
                            <td>Mr. Dela Cruz</td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>
                                <!-- View Info Button -->
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#subjectInfoModal">
                                    View Info
                                </button>
                                <!-- Teacher Button -->
                                <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#teacherInfoModal">
                                    Teacher
                                </button>
                            </td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ===================== Subject Info Modal ===================== -->
    <div class="modal fade" id="subjectInfoModal" tabindex="-1" aria-labelledby="subjectInfoLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="subjectInfoLabel">Subject Information</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Subject Code:</strong> IT101</p>
                    <p><strong>Subject Name:</strong> Introduction to Computing</p>
                    <p><strong>Units:</strong> 3</p>
                    <p><strong>Schedule:</strong> Mon/Wed 10:00–11:00 AM</p>
                    <p><strong>Description:</strong> This subject introduces students to the fundamental concepts of computing, hardware, software, and applications.</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ===================== Teacher Info Modal ===================== -->
    <div class="modal fade" id="teacherInfoModal" tabindex="-1" aria-labelledby="teacherInfoLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="teacherInfoLabel">Teacher Information</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Name:</strong> Mr. Dela Cruz</p>
                    <p><strong>Department:</strong> Computer Studies</p>
                    <p><strong>Email:</strong> delacruz@example.com</p>
                    <p><strong>Office Hours:</strong> Tue/Thu 2:00–4:00 PM</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</x-student-component>
