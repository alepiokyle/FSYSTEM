<x-admin-component>
<style>
    /* Custom styles for the Grade page */
    .glass-card {
        background: rgba(255,255,255,0.9);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 20px;
        border: 1px solid rgba(255,255,255,0.3);
        box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    }

    .glass-table {
        width: 100%;
        border-collapse: collapse;
        background: rgba(255,255,255,0.8);
        border-radius: 10px;
        overflow: hidden;
    }

    .glass-table thead {
        background: rgba(0,123,255,0.1);
    }

    .glass-table th, .glass-table td {
        padding: 12px;
        border-bottom: 1px solid rgba(0,0,0,0.1);
        text-align: left;
    }

    .glass-table tbody tr:hover {
        background: rgba(0,123,255,0.05);
    }

    .status-approved { color: #28a745; font-weight: bold; }
    .status-pending { color: #ffc107; font-weight: bold; }
</style>

<x-slot:page_title>
    Admin - View Grades
</x-slot>

<!-- Page Header -->
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">📖 Student Grades</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Grades</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Content -->
<div class="row">
    <div class="col-md-12">
        <div class="glass-card">
            <h6>Approved Grades by Dean</h6>
            <p class="text-muted">Below are the student grades that have been approved.</p>

            <div class="table-responsive">
                <table class="glass-table">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Subject</th>
                            <th>Prelim</th>
                            <th>Midterm</th>
                            <th>Semi-Final</th>
                            <th>Final</th>
                            <th>Final Grade</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Sample data; replace with dynamic data -->
                        <tr>
                            <td>Juan Dela Cruz</td>
                            <td>Introduction to Programming</td>
                            <td>85</td>
                            <td>88</td>
                            <td>90</td>
                            <td>92</td>
                            <td><strong>89</strong></td>
                            <td><span class="status-approved">Approved</span></td>
                        </tr>
                        <tr>
                            <td>Maria Santos</td>
                            <td>Business Management</td>
                            <td>80</td>
                            <td>82</td>
                            <td>85</td>
                            <td>87</td>
                            <td><strong>84</strong></td>
                            <td><span class="status-approved">Approved</span></td>
                        </tr>
                        <tr>
                            <td>Carlos Reyes</td>
                            <td>Mathematics</td>
                            <td>70</td>
                            <td>75</td>
                            <td>78</td>
                            <td>80</td>
                            <td><strong>76</strong></td>
                            <td><span class="status-pending">Pending</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</x-admin-component>
