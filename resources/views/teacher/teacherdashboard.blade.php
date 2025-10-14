<x-teacher-component>
    <style>
        /* ====== Background & Page ====== */
        x-teacher-component {
            background: linear-gradient(to right, #f7f9fc, #ffffff);
            min-height: 100vh;
            padding: 20px 30px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* ====== Page Header ====== */
        .page-header { margin-bottom: 25px; }
        .page-header-title h5 { font-weight: 700; font-size: 1.8rem; color: #222; }
        .breadcrumb { padding: 0; margin-top: 5px; background: transparent; font-size: 0.9rem; }
        .breadcrumb-item a { text-decoration: none; color: #555; }
        .breadcrumb-item a:hover { text-decoration: underline; }

        /* ====== Dashboard Cards ====== */
        .row { display: flex; flex-wrap: wrap; gap: 20px; margin-bottom: 25px; }
        .card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            flex: 1;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover { transform: translateY(-4px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .card h6 { font-weight: 600; color: #555; margin-bottom: 5px; font-size: 0.95rem; }
        .card h4 { font-weight: 700; color: #333; display: flex; align-items: center; justify-content: space-between; font-size: 1.4rem; }
        .card p { font-size: 0.85rem; color: #777; margin-top: 5px; }

        /* Badge Colors */
        .badge { font-size: 0.8rem; padding: 0.35em 0.6em; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-weight: 600; }
        .bg-light-primary { background-color: #e1f0ff; color: #0d6efd; }
        .bg-light-success { background-color: #e6f4ea; color: #198754; }
        .bg-light-warning { background-color: #fff4e5; color: #fd7e14; }
        .bg-light-danger { background-color: #fde2e2; color: #dc3545; }

        /* ====== Table ====== */
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            margin-top: 15px;
            font-size: 0.875rem;
        }
        thead { background-color: #f8f9fa; }
        th, td { padding: 10px 12px; text-align: left; color: #333; }
        tbody tr { transition: background 0.2s; }
        tbody tr:hover { background-color: #f1f3f6; }

        /* ====== Quick Action Buttons ====== */
        .quick-actions { display: flex; flex-wrap: wrap; gap: 15px; margin-top: 20px; }
        .quick-actions .btn {
            flex: 1;
            padding: 12px;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            font-weight: 600;
            text-decoration: none;
            color: #fff;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-primary { background-color: #0d6efd; }
        .btn-primary:hover { background-color: #0b5ed7; transform: translateY(-2px); }
        .btn-success { background-color: #198754; }
        .btn-success:hover { background-color: #157347; transform: translateY(-2px); }
        .btn-warning { background-color: #fd7e14; }
        .btn-warning:hover { background-color: #e36d0f; transform: translateY(-2px); }
        .btn-danger { background-color: #dc3545; }
        .btn-danger:hover { background-color: #b02a37; transform: translateY(-2px); }

        @media (max-width: 768px) {
            .row, .quick-actions { flex-direction: column; }
        }
    </style>

    <!-- ====== Page Header ====== -->
    <div class="page-header">
        <div class="page-header-title"><h5>Teacher Dashboard</h5></div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Dashboard</li>
        </ul>
    </div>

    <!-- ====== Overview Cards ====== -->
    <div class="row">
        <div class="card">
            <h6>Subjects Assigned</h6>
            <h4>{{ $subjectsCount }} <span class="badge bg-light-primary">📚</span></h4>
            <p>Total subjects assigned this semester</p>
        </div>
        <div class="card">
            <h6>Students</h6>
            <h4>{{ $studentsCount }} <span class="badge bg-light-success">👨‍🎓</span></h4>
            <p>Total students under your subjects</p>
        </div>
        <div class="card">
            <h6>Pending Attendance</h6>
            <h4>5 <span class="badge bg-light-warning">⏰</span></h4>
            <p>Classes/sessions where attendance hasn't been taken</p>
        </div>
        <div class="card">
            <h6>Pending Assessments</h6>
            <h4>8 <span class="badge bg-light-danger">📝</span></h4>
            <p>Quizzes or exams that haven’t been graded yet</p>
        </div>
    </div>

    <!-- ====== Recent Activity Table ====== -->
    <div class="card">
        <h6>Recent Activities</h6>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Activity</th>
                    <th>Subject</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2025-08-28</td>
                    <td>Graded Quiz 1</td>
                    <td>Database Management</td>
                    <td><span class="badge bg-light-success">Submitted</span></td>
                </tr>
                <tr>
                    <td>2025-08-27</td>
                    <td>Took Attendance</td>
                    <td>College Algebra</td>
                    <td><span class="badge bg-light-primary">Done</span></td>
                </tr>
                <tr>
                    <td>2025-08-26</td>
                    <td>Created Exam</td>
                    <td>English Communication</td>
                    <td><span class="badge bg-light-warning">Pending</span></td>
                </tr>
            </tbody>
        </table>
    </div>

   
</x-teacher-component>
