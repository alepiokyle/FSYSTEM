<x-student-component>
    <div class="container mt-4">
        <h3 class="page-header mb-4">👤 Student Profile</h3>

        <div class="row g-4">
            <!-- Profile Summary -->
            <div class="col-md-4">
                <div class="card shadow-sm text-center">
                    <div class="card-body">
                        <img src="{{ asset('all/assets/images/student.png') }}" 
                             class="rounded-circle mb-3" width="120" height="120" alt="Student Avatar">
                        <h5 class="card-title">Juan Dela Cruz</h5>
                        <p class="text-muted mb-1">Student ID: 2025-12345</p>
                        <p class="text-muted">BS Information Technology – 2nd Year</p>
                        <button class="btn btn-sm btn-outline-primary mt-2">Change Profile Picture</button>
                    </div>
                </div>
            </div>

            <!-- Profile Details -->
            <div class="col-md-8">
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-primary text-white">
                        Personal Information
                    </div>
                    <div class="card-body">
                        <p><strong>Full Name:</strong> Juan Dela Cruz</p>
                        <p><strong>Birthdate:</strong> January 15, 2005</p>
                        <p><strong>Gender:</strong> Male</p>
                        <p><strong>Address:</strong> Sindangan, Zamboanga del Norte</p>
                        <p><strong>Contact No.:</strong> 0912-345-6789</p>
                        <p><strong>Email:</strong> juandelacruz@example.com</p>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        Academic Information
                    </div>
                    <div class="card-body">
                        <p><strong>Course:</strong> BS Information Technology</p>
                        <p><strong>Year Level:</strong> 2nd Year</p>
                        <p><strong>Section:</strong> A2</p>
                        <p><strong>Adviser:</strong> Mr. Dela Cruz</p>
                        <p><strong>Dean:</strong> Dr. Santos</p>
                    </div>
                </div>

                <!-- Account Settings -->
                <div class="card shadow-sm mt-3">
                    <div class="card-header bg-dark text-white">
                        Account Settings
                    </div>
                    <div class="card-body">
                        <!-- Trigger Modals -->
                        <button class="btn btn-outline-warning me-2" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                            Change Password
                        </button>
                        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editContactModal">
                            Edit Contact Details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label>Current Password</label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>New Password</label>
                            <input type="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Confirm New Password</label>
                            <input type="password" class="form-control">
                        </div>
                        <button type="button" class="btn btn-warning w-100">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Contact Details Modal -->
    <div class="modal fade" id="editContactModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title">Edit Contact Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label>Contact No.</label>
                            <input type="text" class="form-control" value="0912-345-6789">
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" class="form-control" value="juandelacruz@example.com">
                        </div>
                        <div class="mb-3">
                            <label>Address</label>
                            <input type="text" class="form-control" value="Sindangan, Zamboanga del Norte">
                        </div>
                        <button type="button" class="btn btn-secondary w-100">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-student-component>
