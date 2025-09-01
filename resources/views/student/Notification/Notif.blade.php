<x-student-component>
    <div class="container mt-4">
        <h3 class="page-header mb-4">🔔 Notifications</h3>

        <!-- Filter & Actions -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <select class="form-select">
                    <option>All Notifications</option>
                    <option>Unread</option>
                    <option>Read</option>
                </select>
            </div>
            <button class="btn btn-sm btn-outline-primary">Mark All as Read</button>
        </div>

        <!-- Notifications List -->
        <div class="list-group shadow-sm">
            <!-- Unread Notification -->
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start bg-light">
                <div>
                    <h6 class="mb-1"><i class="ti ti-clipboard-check text-success"></i> New Grade Posted</h6>
                    <p class="mb-1 small text-muted">Your grade in IT101 has been approved and posted.</p>
                    <small class="text-primary">2 hours ago</small>
                </div>
                <span class="badge bg-primary rounded-pill">New</span>
            </a>

            <!-- Another Notification -->
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="mb-1"><i class="ti ti-bell-ringing text-warning"></i> Exam Reminder</h6>
                    <p class="mb-1 small text-muted">Math 101 Midterm Exam is scheduled for Sept 15, 2025.</p>
                    <small class="text-muted">Yesterday</small>
                </div>
            </a>

            <!-- Read Notification -->
            <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between align-items-start">
                <div>
                    <h6 class="mb-1"><i class="ti ti-users text-info"></i> Section Update</h6>
                    <p class="mb-1 small text-muted">You have been moved to Section A2 for English 02.</p>
                    <small class="text-muted">Aug 28, 2025</small>
                </div>
            </a>
        </div>
    </div>
</x-student-component>
