@extends('layouts.admin')
@section('content')

<div class="flex pt-0 pb-12 w-full">
    <main class="flex-1 bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-100">
        <div class="p-6 bg-gray-800 rounded-lg shadow-md">
            <!-- Header Section -->
            <div class="mb-6">
                <h2 class="text-2xl font-semibold text-white mb-4">Upload Subjects</h2>
                
                <!-- Success/Error Messages -->
                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-600 text-white rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 p-4 bg-red-600 text-white rounded">
                        {{ session('error') }}
                    </div>
                @endif
            </div>

            <!-- Upload Form -->
            <form id="subjectForm" class="space-y-6">
                @csrf
                
                <!-- Form Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Department -->
                    <div>
                        <label for="department" class="block text-sm font-medium text-gray-300 mb-2">
                            Department <span class="text-red-400">*</span>
                        </label>
                        <select id="department" name="department" onchange="updateSubjects(); generateSubjectCode()" required
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white">
                            <option value="">-- Select Department --</option>
                            <option value="BSIT">BSIT</option>
                            <option value="BSCS">BSCS</option>
                        </select>
                    </div>

                    <!-- Subject Name -->
                    <div>
                        <label for="subject_name" class="block text-sm font-medium text-gray-300 mb-2">
                            Subject Name <span class="text-red-400">*</span>
                        </label>
                        <select id="subject_name" name="subject_name" onchange="generateSubjectCode(); autoFillUnits();" required
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white">
                            <option value="">-- Select Subject --</option>
                        </select>
                    </div>

                    <!-- Subject Code -->
                    <div>
                        <label for="subject_code" class="block text-sm font-medium text-gray-300 mb-2">
                            Subject Code <span class="text-red-400">*</span>
                        </label>
                        <input type="text" id="subject_code" name="subject_code" readonly required
                            class="w-full px-3 py-2 bg-gray-600 border border-gray-500 rounded-md text-white cursor-not-allowed"
                            placeholder="Auto-generated">
                    </div>

                    <!-- Units -->
                    <div>
                        <label for="units" class="block text-sm font-medium text-gray-300 mb-2">
                            Units <span class="text-red-400">*</span>
                        </label>
                        <input type="number" id="units" name="units" readonly required
                            class="w-full px-3 py-2 bg-gray-600 border border-gray-500 rounded-md text-white cursor-not-allowed"
                            placeholder="Auto-filled">
                    </div>

                    <!-- Year Level -->
                    <div>
                        <label for="year_level" class="block text-sm font-medium text-gray-300 mb-2">
                            Year Level <span class="text-red-400">*</span>
                        </label>
                        <select id="year_level" name="year_level" onchange="generateSubjectCode()" required
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white">
                            <option value="">-- Select Year Level --</option>
                            <option value="1st">1st Year</option>
                            <option value="2nd">2nd Year</option>
                            <option value="3rd">3rd Year</option>
                            <option value="4th">4th Year</option>
                        </select>
                    </div>

                    <!-- Semester -->
                    <div>
                        <label for="semester" class="block text-sm font-medium text-gray-300 mb-2">
                            Semester <span class="text-red-400">*</span>
                        </label>
                        <select id="semester" name="semester" required
                            class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white">
                            <option value="">-- Select Semester --</option>
                            <option value="1st">1st Semester</option>
                            <option value="2nd">2nd Semester</option>
                        </select>
                    </div>
                </div>

                <!-- School Year -->
                <div>
                    <label for="school_year" class="block text-sm font-medium text-gray-300 mb-2">
                        School Year <span class="text-red-400">*</span>
                    </label>
                    <select id="school_year" name="school_year" required
                        class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white">
                        <option value="">-- Select School Year --</option>
                        <option value="2024-2025">2024-2025</option>
                        <option value="2025-2026">2025-2026</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <button type="submit" id="submitBtn"
                        class="w-full md:w-auto px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md">
                        <i class="fas fa-upload mr-2"></i>Upload Subject
                    </button>
                </div>
            </form>

            <!-- Subjects Table -->
            <div class="mt-8 p-6 bg-gray-800 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold text-white mb-4">Current Subjects</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-gray-700 rounded-lg">
                        <thead>
                            <tr class="bg-gray-600">
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Subject Code</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Subject Name</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Department</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Year Level</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Semester</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Units</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">School Year</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="subjectsTableBody" class="divide-y divide-gray-600">
                            @forelse($subjects ?? [] as $subject)
                                <tr class="hover:bg-gray-600">
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">{{ $subject->subject_code }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">{{ $subject->subject_name }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">{{ $subject->department }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">{{ $subject->year_level }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">{{ $subject->semester }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">{{ $subject->units }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">{{ $subject->school_year }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">
                                        <div class="flex space-x-2">
                                            <button class="text-blue-400 hover:text-blue-300" title="Edit" onclick="editSubject({{ $subject->id }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="text-red-400 hover:text-red-300" title="Delete" onclick="deleteSubject({{ $subject->id }})">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-gray-300 py-4">No subjects found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- JavaScript Section -->
<script>
    // Subject data configuration
    const subjectsData = {
        'BSIT': [
            { name: 'Introduction to Computing', units: 3 },
            { name: 'Computer Programming 1', units: 3 },
            { name: 'Computer Programming 2', units: 3 },
            { name: 'Data Structures and Algorithms', units: 3 },
            { name: 'Information Management', units: 3 },
            { name: 'Networking 1', units: 3 },
            { name: 'Networking 2', units: 3 },
            { name: 'Web Systems and Technologies', units: 3 },
        ],
        'BSCS': [
            { name: 'Introduction to Computer Science', units: 3 },
            { name: 'Computer Programming 1', units: 3 },
            { name: 'Computer Programming 2', units: 3 },
            { name: 'Data Structures and Algorithms', units: 3 },
            { name: 'Discrete Mathematics', units: 3 },
            { name: 'Digital Logic Design', units: 3 },
            { name: 'Computer Architecture', units: 3 },
            { name: 'Operating Systems', units: 3 },
            { name: 'Software Engineering', units: 3 },
            { name: 'Theory of Computation', units: 3 },
            { name: 'Design and Analysis of Algorithms', units: 3 },
            { name: 'Programming Languages', units: 3 },
            { name: 'CS Capstone Project 1', units: 3 },
            { name: 'CS Capstone Project 2', units: 3 },
            { name: 'Artificial Intelligence', units: 3 },
            { name: 'Computer Networks', units: 3 },
            { name: 'Database Systems', units: 3 }
        ]
    };

    /**
     * Update subjects dropdown based on selected department
     */
    function updateSubjects() {
        const department = document.getElementById('department').value;
        const subjectSelect = document.getElementById('subject_name');
        
        subjectSelect.innerHTML = '<option value="">-- Select Subject --</option>';
        
        if (subjectsData[department]) {
            subjectsData[department].forEach(subject => {
                const option = document.createElement('option');
                option.value = subject.name;
                option.textContent = subject.name;
                option.setAttribute('data-units', subject.units);
                subjectSelect.appendChild(option);
            });
        }
        
        // Reset dependent fields
        document.getElementById('subject_code').value = '';
        document.getElementById('units').value = '';
    }

    /**
     * Auto-fill units based on selected subject
     */
    function autoFillUnits() {
        const subjectSelect = document.getElementById('subject_name');
        const selectedOption = subjectSelect.options[subjectSelect.selectedIndex];
        const units = selectedOption ? selectedOption.getAttribute('data-units') : '';
        document.getElementById('units').value = units;
    }

    /**
     * Generate unique subject code
     */
    function generateSubjectCode() {
        const department = document.getElementById('department').value;
        const subjectName = document.getElementById('subject_name').value;
        const yearLevel = document.getElementById('year_level').value;
        
        if (department && subjectName && yearLevel) {
            const deptCode = department.substring(0, 4).toUpperCase();
            const yearCode = yearLevel.charAt(0);
            const subjectCode = subjectName.substring(0, 3).toUpperCase();
            const code = `${deptCode}${yearCode}${subjectCode}${Math.floor(Math.random() * 100)}`;
            document.getElementById('subject_code').value = code;
        }
    }

    /**
     * Handle AJAX form submission
     */
    document.getElementById('subjectForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const submitBtn = document.getElementById('submitBtn');
        const formData = new FormData(this);
        
        // Disable submit button and show loading
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Uploading...';
        
        fetch('{{ route("subjects.store") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => Promise.reject(err));
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                addSubjectToTable(data.subject);
                showNotification(data.message, 'success');
                
                // Reset form
                document.getElementById('subjectForm').reset();
                document.getElementById('subject_code').value = '';
                document.getElementById('units').value = '';
                document.getElementById('subject_name').innerHTML = '<option value="">-- Select Subject --</option>';
                
                // Remove "No subjects found" message if exists
                const noSubjectsRow = document.querySelector('#subjectsTableBody tr td[colspan="7"]');
                if (noSubjectsRow) {
                    noSubjectsRow.parentElement.remove();
                }
            } else {
                if (data.errors) {
                    let errorMessages = Object.values(data.errors).flat().join('<br>');
                    showNotification(errorMessages, 'error');
                } else {
                    showNotification(data.message || 'Error uploading subject. Please try again.', 'error');
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            let errorMessage = 'Error uploading subject. Please try again.';
            
            if (error.errors) {
                errorMessage = Object.values(error.errors).flat().join('<br>');
            } else if (error.message) {
                errorMessage = error.message;
            }
            
            showNotification(errorMessage, 'error');
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-upload mr-2"></i>Upload Subject';
        });
    });

    /**
     * Add new subject to table
     */
    function addSubjectToTable(subject) {
        const tbody = document.getElementById('subjectsTableBody');
        const newRow = document.createElement('tr');
        newRow.className = 'hover:bg-gray-600';
        newRow.innerHTML = `
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">${subject.subject_code}</td>
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">${subject.subject_name}</td>
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">${subject.department}</td>
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">${subject.year_level}</td>
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">${subject.semester}</td>
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">${subject.units}</td>
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">${subject.school_year}</td>
            <td class="px-4 py-3 whitespace-nowrap text-sm text-gray-300">
                <div class="flex space-x-2">
                    <button class="text-blue-400 hover:text-blue-300" title="Edit" onclick="editSubject(${subject.id})">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="text-red-400 hover:text-red-300" title="Delete" onclick="deleteSubject(${subject.id})">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </td>
        `;
        
        // Add fade-in animation
        newRow.style.opacity = '0';
        tbody.insertBefore(newRow, tbody.firstChild);
        
        setTimeout(() => {
            newRow.style.transition = 'opacity 0.3s ease';
            newRow.style.opacity = '1';
        }, 10);
    }

    /**
     * Show notification messages
     */
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `mb-4 p-4 rounded ${type === 'success' ? 'bg-green-600' : 'bg-red-600'} text-white`;
        notification.innerHTML = message;
        
        const form = document.getElementById('subjectForm');
        form.insertBefore(notification, form.firstChild);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    /**
     * Edit subject
     */
    function editSubject(subjectId) {
        // Redirect to edit page or open modal
        window.location.href = `/admin/subjects/${subjectId}/edit`;
    }

    /**
     * Delete subject
     */
    function deleteSubject(subjectId) {
        if (confirm('Are you sure you want to delete this subject?')) {
            fetch(`/admin/subjects/${subjectId}`, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove row from table
                    const row = event.target.closest('tr');
                    row.remove();
                    showNotification(data.message, 'success');
                    
                    // Check if table is empty
                    const tbody = document.getElementById('subjectsTableBody');
                    if (tbody.children.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="8" class="text-center text-gray-300 py-4">No subjects found.</td></tr>';
                    }
                } else {
                    showNotification(data.message || 'Error deleting subject.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Error deleting subject. Please try again.', 'error');
            });
        }
    }
</script>

@endsection 