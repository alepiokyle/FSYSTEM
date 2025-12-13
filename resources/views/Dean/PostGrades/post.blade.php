<x-dean-component>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        /* ====== Background & Page ====== */
        x-dean-component {
            background: linear-gradient(to right, #f0f4f8, #ffffff);
            min-height: 100vh;
            padding: 20px 30px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: block;
        }

        /* ====== Page Header ====== */
        .page-header { margin-bottom: 30px; }
        .page-header-title h5 { font-weight: 700; font-size: 1.8rem; color: #222; }
        .breadcrumb { padding: 0; margin-top: 5px; background: transparent; }
        .breadcrumb-item a { text-decoration: none; color: #555; }
        .breadcrumb-item a:hover { text-decoration: underline; }

        /* ====== Cards ====== */
        .card {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 25px;
        }
        .card:hover { transform: translateY(-5px); box-shadow: 0 12px 24px rgba(0,0,0,0.12); }
        .card h4, .card h6 { font-weight: 600; margin-bottom: 15px; }

        /* Table */
        .table th {
            background: #f8f9fa;
        }

        /* Badge styles */
        .badge {
            font-size: 0.75em;
            padding: 0.35em 0.65em;
        }

        .text-muted {
            color: #6c757d !important;
        }

        .py-4 {
            padding-top: 1.5rem !important;
            padding-bottom: 1.5rem !important;
        }

        /* Action buttons */
        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            border-radius: 0.375rem;
            margin: 0 0.125rem;
        }

        .btn-post {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }

        .btn-post:hover {
            background-color: #218838;
            border-color: #1e7e34;
            color: white;
        }

        .btn-filter {
            background-color: #007bff;
            border-color: #007bff;
            color: white;
        }

        .btn-filter:hover {
            background-color: #0056b3;
            border-color: #004085;
            color: white;
        }

        /* Mobile Responsiveness */
        @media (max-width: 767px) {
            x-dean-component {
                padding: 16px;
            }

            .page-header {
                margin-bottom: 20px;
            }

            .page-header-title h5 {
                font-size: 1.5rem;
            }

            .breadcrumb {
                font-size: 14px;
            }

            .card {
                padding: 16px;
                margin-bottom: 16px;
                border-radius: 8px;
            }

            .card h4 {
                font-size: 1.1rem;
                margin-bottom: 12px;
            }

            .row .col-md-3,
            .row .col-md-4 {
                margin-bottom: 16px;
            }

            .row .col-md-3:last-child,
            .row .col-md-4:last-child {
                margin-bottom: 0;
            }

            label {
                font-size: 14px;
                margin-bottom: 8px;
            }

            select,
            .form-select {
                font-size: 16px; /* Prevent zoom on iOS */
                padding: 12px 10px;
            }

            .btn-filter {
                width: 100%;
                padding: 12px;
                font-size: 16px;
            }

            .table {
                font-size: 14px;
            }

            .table th,
            .table td {
                padding: 8px 4px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }

            .btn-action {
                padding: 6px 8px;
                font-size: 12px;
                margin: 2px;
            }

            /* Horizontal scroll on mobile */
            @media (max-width: 767px) {
                .table-responsive {
                    overflow-x: auto;
                }
            }
        }
    </style>

    <!-- ====== Page Header ====== -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title"><h5>Post Approved Grades</h5></div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Post Grades</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

  <!-- ====== Filters ====== -->
<div class="card">
    <h4>🔍 View Term Grades</h4>
    <button class="btn btn-primary" onclick="showGradesModal()">View Grades</button>
</div>

<!-- Modal for Student Term Grades -->
<div class="modal fade" id="gradesModal" tabindex="-1" aria-labelledby="gradesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gradesModalLabel">Student Term Grades</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="modalTermSelect" class="form-label">Select Term</label>
                    <select id="modalTermSelect" class="form-select">
                        <option value="">-- Select Term --</option>
                        <option value="prelim">Prelim</option>
                        <option value="midterm">Midterm</option>
                        <option value="semi-final">Semi-Final</option>
                        <option value="final">Final</option>
                        <option value="term-grade">Term Grade</option>
                    </select>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Term Grade</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody id="modalGradesTableBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- ====== Approved Grades Table ====== -->
    <div class="card">
        <h4>Approved Grades Ready to Post</h4>
        <div class="table-responsive">
            <table id="approvedTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Name</th>
                        <th>Prelim</th>
                        <th>Midterm</th>
                        <th>Semi-Final</th>
                        <th>Final</th>
                        <th>Term Grade</th>
                        <th>Remarks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <script>
        // Load approved grades
        function loadApprovedGrades() {
            let url = `/dean/PostGrades/fetch-grades`;

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    const approvedBody = document.querySelector('#approvedTable tbody');
                    approvedBody.innerHTML = '';

                    data.forEach(grade => {
                        approvedBody.innerHTML += `
                            <tr>
                                <td data-label="Student ID">${grade.student_id}</td>
                                <td data-label="Name"><strong>${grade.student_name}</strong></td>
                                <td data-label="Prelim">${grade.prelim}</td>
                                <td data-label="Midterm">${grade.midterm}</td>
                                <td data-label="Semi-Final">${grade.semi_final}</td>
                                <td data-label="Final">${grade.final}</td>
                                <td data-label="Term Grade">${grade.term_grade}</td>
                                <td data-label="Remarks">${grade.remarks}</td>
                                <td data-label="Action">
                                    <button class="btn btn-post btn-action" onclick="postGrade(${grade.id})">Post</button>
                                </td>
                            </tr>`;
                    });
                });
        }

        // Show grades modal
        function showGradesModal() {
            // Show the modal first
            const modal = new bootstrap.Modal(document.getElementById('gradesModal'));
            modal.show();

            // Load grades when term is selected
            document.getElementById('modalTermSelect').addEventListener('change', loadModalGrades);
            // Load initial grades if a term is selected
            loadModalGrades();
        }

        // Load grades for the modal based on selected term
        function loadModalGrades() {
            const term = document.getElementById('modalTermSelect').value;
            if (!term) {
                document.querySelector('#modalGradesTableBody').innerHTML = '<tr><td colspan="4">Please select a term to view grades.</td></tr>';
                return;
            }

            let url = `/dean/PostGrades/fetch-grades?term=${term}`;

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    const modalBody = document.querySelector('#modalGradesTableBody');
                    modalBody.innerHTML = '';

                    data.forEach(grade => {
                        modalBody.innerHTML += `
                            <tr>
                                <td>${grade.student_id}</td>
                                <td><strong>${grade.student_name}</strong></td>
                                <td>${grade.term_grade}</td>
                                <td>${grade.remarks}</td>
                            </tr>`;
                    });
                });
        }

        // Post grade
        function postGrade(gradeId) {
            fetch(`/dean/PostGrades/post`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ grade_id: gradeId })
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
                loadApprovedGrades();
            });
        }

        // Load grades on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadApprovedGrades();
        });
    </script>
</x-dean-component>
