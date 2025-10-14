<x-dean-component>
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

        .btn-delete {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
            border-color: #bd2130;
            color: white;
        }

        .btn-edit {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }

        .btn-edit:hover {
            background-color: #218838;
            border-color: #1e7e34;
            color: white;
        }
    </style>

    <!-- ====== Page Header ====== -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title"><h5>Dean Dashboard</h5></div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Subject Loading</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

 <!-- ====== Uploaded Subjects from Admin ====== -->
<div class="card mt-4">
    <h4>📘 Subjects Uploaded by Admin</h4>
    <table class="table table-hover table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Subject Code</th>
                <th>Subject Name</th>
                <th>Units</th>
                <th>Department</th>
                <th>Semester</th>
                <th>Date Uploaded</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subjects as $subject)
                <tr>
                    <td><strong>{{ $subject->subject_code }}</strong></td>
                    <td>{{ $subject->subject_name }}</td>
                    <td>
                        <span class="badge bg-primary">{{ $subject->units }} unit{{ $subject->units > 1 ? 's' : '' }}</span>
                    </td>
                    <td>{{ $subject->department->name }}</td>
                    <td>{{ $subject->semester }}</td>
                    <td>{{ $subject->created_at->format('M d, Y') }}</td>
                    <td>
                        @if($subject->status == 'Active')
                            <span class="badge bg-success">Active</span>
                        @elseif($subject->status == 'Inactive')
                            <span class="badge bg-secondary">Inactive</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-edit btn-action" title="Edit Subject">
                            <i class="ti ti-edit"></i> Edit
                        </button>
                        <button class="btn btn-delete btn-action" title="Delete Subject" onclick="deleteSubject({{ $subject->id }}, '{{ $subject->subject_code }} - {{ $subject->subject_name }}')">
                            <i class="ti ti-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        <em>No subjects uploaded yet. Subjects will appear here once uploaded by admin.</em>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    </div>
    <!-- ====== Subject Loading Form ====== -->
    <div class="card">
        <h4>➕ Load Students to a Subject</h4>
        <form id="loadStudentsForm">
            <div class="mb-3">
                <label for="subject" class="form-label">Select Subject:</label>
                <select id="subject" class="form-select" name="subject_id" required>
                    <option value="">-- Choose Subject --</option>
                    @foreach($subjects as $subject)
                        <option value="{{ $subject->id }}" data-subject-code="{{ $subject->subject_code }}" data-units="{{ $subject->units }}">{{ $subject->subject_code }} - {{ $subject->subject_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="yearLevel" class="form-label">Year Level:</label>
                <input type="text" id="yearLevel" class="form-control" name="year_level" placeholder="e.g., 1st Year" required>
            </div>

            <div class="mb-3">
                <label for="students" class="form-label">Select Students:</label>
                <select id="students" class="form-select" name="student_ids[]" multiple required>
                    @foreach($students as $student)
                        @if($student->profile)
                            <option value="{{ $student->id }}">{{ $student->profile->student_id }} - {{ $student->profile->first_name }} {{ $student->profile->last_name }} ({{ $student->profile->course }}, {{ $student->profile->year_level }})</option>
                        @endif
                    @endforeach
                </select>
                <div class="form-text">Hold CTRL (Windows) or CMD (Mac) to select multiple students.</div>
            </div>

            <button type="submit" class="btn btn-primary">Load Students</button>
        </form>
    </div>

    <!-- CSRF Token for AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        async function deleteSubject(subjectId, subjectName) {
            const result = await Swal.fire({
                title: "<i class='ti ti-alert-triangle text-warning'></i> Delete Subject",
                html: `<p style='font-size:14px; color:#4b5563;'>Are you sure you want to delete the subject <strong>"${subjectName}"</strong>?</p><p style='font-size:12px; color:#6b7280; margin-top:10px;'>This action cannot be undone.</p>`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "<i class='ti ti-trash'></i> Yes, Delete",
                cancelButtonText: "<i class='ti ti-x'></i> Cancel",
                confirmButtonColor: "#dc3545",
                cancelButtonColor: "#6c757d",
                background: "#f8f9fa",
                color: "#212529",
                customClass: {
                    popup: "rounded-xl shadow-2xl border border-gray-300",
                    title: "text-lg font-semibold text-gray-800",
                    confirmButton: "px-4 py-2 rounded-md font-medium shadow hover:bg-red-600",
                    cancelButton: "px-4 py-2 rounded-md font-medium shadow hover:bg-gray-500"
                }
            });

            if (result.isConfirmed) {
                // Show loading state
                Swal.fire({
                    title: "<i class='ti ti-loader text-primary' style='animation: spin 1s linear infinite;'></i> Deleting...",
                    text: "Please wait while we delete the subject",
                    showConfirmButton: false,
                    background: "#f8f9fa",
                    color: "#212529",
                    allowOutsideClick: false,
                    allowEscapeKey: false
                });

                try {
                    // Perform fetch delete request
                    const response = await fetch(`/dean/SubjectLoading/${subjectId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json'
                        }
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        Swal.fire({
                            title: "<i class='ti ti-check text-success'></i> Deleted!",
                            text: data.message,
                            icon: "success",
                            confirmButtonText: "<i class='ti ti-check'></i> OK",
                            confirmButtonColor: "#28a745",
                            background: "#f8f9fa",
                            color: "#212529",
                            customClass: {
                                popup: "rounded-xl shadow-2xl border border-gray-300",
                                confirmButton: "px-4 py-2 rounded-md font-medium shadow hover:bg-green-600"
                            }
                        }).then(() => {
                            // Reload the page to show updated data
                            location.reload();
                        });
                    } else {
                        throw new Error(data.message || 'Failed to delete subject');
                    }
                } catch (error) {
                    console.error('Delete error:', error);
                    Swal.fire({
                        title: "<i class='ti ti-x text-danger'></i> Error!",
                        text: error.message || "Failed to delete subject. Please try again.",
                        icon: "error",
                        confirmButtonText: "<i class='ti ti-check'></i> OK",
                        confirmButtonColor: "#dc3545",
                        background: "#f8f9fa",
                        color: "#212529"
                    });
                }
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const subjectSelect = document.getElementById('subject');
            const loadStudentsForm = document.getElementById('loadStudentsForm');

            // When subject is selected, save subject code and units to localStorage
            subjectSelect.addEventListener('change', function () {
                const selectedOption = subjectSelect.options[subjectSelect.selectedIndex];
                if (selectedOption.value) {
                    const subjectCode = selectedOption.getAttribute('data-subject-code');
                    const units = selectedOption.getAttribute('data-units');
                    localStorage.setItem('selectedSubjectCode', subjectCode);
                    localStorage.setItem('selectedUnits', units);
                } else {
                    localStorage.removeItem('selectedSubjectCode');
                    localStorage.removeItem('selectedUnits');
                }
            });

            // Handle form submission with AJAX
            loadStudentsForm.addEventListener('submit', async function (e) {
                e.preventDefault();

                const formData = new FormData(loadStudentsForm);
                const subjectId = formData.get('subject_id');
                const studentIds = formData.getAll('student_ids[]');

                if (!subjectId || studentIds.length === 0) {
                    alert('Please select a subject and at least one student.');
                    return;
                }

                try {
                    const response = await fetch("{{ route('Dean.SubjectLoading.store') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (response.ok && data.success) {
                        alert(data.message);
                        // Optionally reset form or do other UI updates
                    } else {
                        alert(data.message || 'Failed to load students.');
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('An error occurred while loading students.');
                }
            });
        });
    </script>
</x-dean-component>
