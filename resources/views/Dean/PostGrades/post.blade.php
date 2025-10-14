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
    <h4>🔍 Filter Grades</h4>
    <div class="row">
        <!-- Teacher -->
        <div class="col-md-3 mb-3">
            <label for="teacherFilter" class="form-label">Teacher Name</label>
            <select id="teacherFilter" class="form-select" onchange="loadSubjectsByTeacher(this.value)">
                <option value="">Select Teacher</option>
                @foreach($teachers as $teacher)
                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Subject -->
        <div class="col-md-4 mb-3">
            <label for="subjectFilter" class="form-label">Subject Code</label>
            <select id="subjectFilter" class="form-select">
                <option value="">Select Subject</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->subject_code }} - {{ $subject->subject_name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <!-- School Year -->
        <div class="col-md-3 mb-3">
            <label for="schoolYearFilter" class="form-label">School Year</label>
            <select id="schoolYearFilter" class="form-select">
                <option value="">Select School Year</option>
                @foreach($schoolYears as $schoolYear)
                    <option value="{{ $schoolYear->schoolyear }}">{{ $schoolYear->schoolyear }}</option>
                @endforeach
            </select>
        </div>

        <!-- Semester -->
        <div class="col-md-3 mb-3">
            <label for="semesterFilter" class="form-label">Semester</label>
            <select id="semesterFilter" class="form-select">
                <option value="">Select Semester</option>
                <option value="1st Semester">1st Semester</option>
                <option value="2nd Semester">2nd Semester</option>
            </select>
        </div>

        <!-- Filter Button -->
        <div class="col-md-3 mb-3 d-flex align-items-end">
            <button class="btn btn-filter w-100" onclick="loadApprovedGrades()">Filter</button>
        </div>
    </div>
</div>

    <!-- ====== Approved Grades Table ====== -->
    <div class="card">
        <h4>Approved Grades Ready to Post</h4>
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

    <script>
        // Load approved grades
        function loadApprovedGrades() {
            const teacherId = document.getElementById('teacherFilter').value;
            const subjectId = document.getElementById('subjectFilter').value;
            const schoolYear = document.getElementById('schoolYearFilter').value;
            const semester = document.getElementById('semesterFilter').value;

            let url = `/dean/PostGrades/fetch-grades?subject_id=${subjectId}&school_year=${schoolYear}&semester=${semester}&teacher_id=${teacherId}`;

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    const approvedBody = document.querySelector('#approvedTable tbody');
                    approvedBody.innerHTML = '';

                    data.forEach(grade => {
                        approvedBody.innerHTML += `
                            <tr>
                                <td>${grade.student_id}</td>
                                <td><strong>${grade.student_name}</strong></td>
                                <td>${grade.prelim}</td>
                                <td>${grade.midterm}</td>
                                <td>${grade.semi_final}</td>
                                <td>${grade.final}</td>
                                <td>${grade.term_grade}</td>
                                <td>${grade.remarks}</td>
                                <td>
                                    <button class="btn btn-post btn-action" onclick="postGrade(${grade.id})">Post</button>
                                </td>
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

        // Load subjects by teacher
        function loadSubjectsByTeacher(teacherId) {
            const subjectSelect = document.getElementById('subjectFilter');
            subjectSelect.innerHTML = '<option value="">Select Subject</option>';

            if (!teacherId) {
                return;
            }

            fetch(`/dean/ApproveGrades/subjects-by-teacher/${teacherId}`)
                .then(res => res.json())
                .then(data => {
                    data.forEach(subject => {
                        subjectSelect.innerHTML += `<option value="${subject.id}">${subject.subject_code} - ${subject.subject_name}</option>`;
                    });
                })
                .catch(error => {
                    console.error('Error loading subjects:', error);
                });
        }

        // Load grades on page load
        document.addEventListener('DOMContentLoaded', function() {
            loadApprovedGrades();
        });
    </script>
</x-dean-component>
