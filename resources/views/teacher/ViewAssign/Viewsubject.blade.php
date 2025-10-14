<x-teacher-component>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Teacher - Assigned Subjects</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Page Wrapper -->
  <div class="min-h-screen flex flex-col">

    <!-- Main Content -->
    <main class="flex-1 p-8">
      <!-- Page Title -->
      <h2 class="text-2xl font-bold mb-6 text-gray-800">
        📘 View Assigned Subjects
      </h2>

      <!-- Search / Filter Section -->
      <div class="mb-4 flex justify-between items-center">
        <input 
          type="text" 
          placeholder="Search by code, name, or section..."
          class="w-1/3 px-4 py-2 border rounded-lg focus:ring focus:ring-blue-200"
        />
        <button 
          class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
          Export to Excel
        </button>
      </div>

      <!-- Assigned Subjects Table -->
      <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full border border-gray-200">
          <!-- Table Head -->
          <thead class="bg-gray-100 text-gray-700">
            <tr>
              <th class="px-4 py-2 border">Subject Code</th>
              <th class="px-4 py-2 border">Subject Name</th>
              <th class="px-4 py-2 border">Students</th>
              <th class="px-4 py-2 border text-center">Actions</th>
            </tr>
          </thead>

          <!-- Table Body -->
          <tbody class="text-gray-800">
            @forelse($assignedSubjects as $subject)
            <tr class="hover:bg-gray-50">
              <td class="px-4 py-2 border">{{ $subject->subject_code }}</td>
              <td class="px-4 py-2 border">{{ $subject->subject_name }}</td>
              <td class="px-4 py-2 border text-center">{{ $subject->students_count }}</td>
              <td class="px-4 py-2 border">
                <div class="flex flex-wrap gap-2 justify-center">
                  <button class="view-students-btn px-3 py-1 bg-green-600 text-white text-sm rounded-lg shadow hover:bg-green-700" data-subject-id="{{ $subject->id }}">
                    View Students
                  </button>
                  <a href="#" class="remove-btn px-3 py-1 bg-red-600 text-white text-sm rounded-lg shadow hover:bg-red-700" data-id="{{ $subject->id }}">
                    Remove
                  </a>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="4" class="text-center py-4 text-gray-500">
                No subjects assigned yet.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </main>
  </div>

  <!-- Students Modal -->
  <div id="studentsModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden flex items-center justify-center transition-opacity duration-300">
    <div class="mx-auto p-6 border border-gray-300 w-4xl shadow-2xl rounded-xl bg-white transform transition-transform duration-300 scale-95 opacity-0" id="modalContent">
      <div class="mt-3">
        <div class="flex items-center mb-6">
          <div class="flex-shrink-0 w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
            </svg>
          </div>
          <h3 class="ml-3 text-xl font-semibold text-gray-900">Enrolled Students</h3>
        </div>
        <div class="overflow-x-auto">
          <table class="min-w-full border border-gray-200">
            <thead class="bg-gray-100 text-gray-700">
              <tr>
                <th class="px-4 py-2 border">Student ID</th>
                <th class="px-4 py-2 border">Full Name</th>
                <th class="px-4 py-2 border">Department</th>
                <th class="px-4 py-2 border">Year Level</th>
              </tr>
            </thead>
            <tbody id="studentsTableBody" class="text-gray-800">
              <!-- Students will be populated here -->
            </tbody>
          </table>
        </div>
        <div class="flex justify-end mt-4">
          <button id="closeModalBtn" class="px-4 py-2 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600">Close</button>
        </div>
      </div>
    </div>
  </div>

    <script>
        // Handle remove button click
        document.querySelectorAll('.remove-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const subjectId = this.getAttribute('data-id');
                if (!subjectId) return;

                if (confirm('Are you sure you want to unassign this subject?')) {
                    fetch(`/teacher/ViewAssign/${subjectId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            // Remove the row from the table
                            const row = event.target.closest('tr');
                            if (row) row.remove();
                        } else {
                            alert('Failed to unassign subject: ' + data.message);
                        }
                    })
                    .catch(error => {
                        alert('Error unassigning subject.');
                        console.error('Error:', error);
                    });
                }
            });
        });

        // Handle view students button click
        document.querySelectorAll('.view-students-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const subjectId = this.getAttribute('data-subject-id');
                if (!subjectId) return;

                // Fetch students
                fetch(`/teacher/ViewAssign/${subjectId}/students`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const tbody = document.getElementById('studentsTableBody');
                        tbody.innerHTML = '';
                        if (data.students.length > 0) {
                            data.students.forEach(student => {
                                const row = document.createElement('tr');
                                row.className = 'hover:bg-gray-50';
                                row.innerHTML = `
                                    <td class="px-4 py-2 border">${student.student_id}</td>
                                    <td class="px-4 py-2 border">${student.full_name}</td>
                                    <td class="px-4 py-2 border">${student.department}</td>
                                    <td class="px-4 py-2 border">${student.year_level}</td>
                                `;
                                tbody.appendChild(row);
                            });
                        } else {
                            tbody.innerHTML = '<tr><td colspan="4" class="text-center py-4 text-gray-500">No students enrolled.</td></tr>';
                        }
                        // Show modal with animation
                        const modal = document.getElementById('studentsModal');
                        const modalContent = document.getElementById('modalContent');
                        modal.classList.remove('hidden');
                        setTimeout(() => {
                            modalContent.classList.remove('scale-95', 'opacity-0');
                            modalContent.classList.add('scale-100', 'opacity-100');
                        }, 10);
                    } else {
                        alert('Failed to load students: ' + data.message);
                    }
                })
                .catch(error => {
                    alert('Error loading students.');
                    console.error('Error:', error);
                });
            });
        });

        // Handle close modal
        document.getElementById('closeModalBtn').addEventListener('click', function() {
            closeModal();
        });

        // Close modal when clicking outside
        document.getElementById('studentsModal').addEventListener('click', function(event) {
            if (event.target === this) {
                closeModal();
            }
        });

        function closeModal() {
            const modal = document.getElementById('studentsModal');
            const modalContent = document.getElementById('modalContent');
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    </script>
</body>
</html>
</x-teacher-component>
