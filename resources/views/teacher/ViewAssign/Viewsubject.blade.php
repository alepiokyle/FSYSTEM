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
              <th class="px-4 py-2 border">Section</th>
              <th class="px-4 py-2 border">Schedule</th>
              <th class="px-4 py-2 border">Room</th>
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
              <td class="px-4 py-2 border">{{ $subject->section }}</td>
              <td class="px-4 py-2 border">-</td>
              <td class="px-4 py-2 border">-</td>
              <td class="px-4 py-2 border text-center">-</td>
              <td class="px-4 py-2 border">
                <div class="flex flex-wrap gap-2 justify-center">
                  <a href="#" class="px-3 py-1 bg-green-600 text-white text-sm rounded-lg shadow hover:bg-green-700">
                    View Students
                  </a>
                  <a href="#" class="remove-btn px-3 py-1 bg-red-600 text-white text-sm rounded-lg shadow hover:bg-red-700" data-id="{{ $subject->id }}">
                    Remove
                  </a>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="text-center py-4 text-gray-500">
                No subjects assigned yet.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </main>
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
    </script>
</body>
</html>
</x-teacher-component>
