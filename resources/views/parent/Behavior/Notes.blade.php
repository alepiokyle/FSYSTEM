<x-parent-component>
    <div class="container mt-4">
        <h3 class="page-header">📝 Behavior Notes</h3>

        <!-- Card for Behavior Summary -->
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Child's Behavior Overview</h5>
                <p class="text-muted">Here’s a simple summary of your child’s recent classroom behavior:</p>

                <!-- Behavior Status -->
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Overall Behavior
                        <span class="badge bg-success rounded-pill">Positive</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Class Participation
                        <span class="badge bg-primary rounded-pill">Active</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Needs Attention
                        <span class="badge bg-warning rounded-pill">Sometimes Distracted</span>
                    </li>
                </ul>

                <!-- Optional Teacher Remark -->
                <div class="alert alert-info">
                    <strong>Teacher's Remark:</strong> Improving in group activities, but needs more focus in Math class.
                </div>
            </div>
        </div>
    </div>
</x-parent-component>
