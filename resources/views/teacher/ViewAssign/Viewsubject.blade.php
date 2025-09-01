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
            <!-- Row 1 -->
            <tr class="hover:bg-gray-50">
              <td class="px-4 py-2 border">CS101</td>
              <td class="px-4 py-2 border">Intro to Computer Science</td>
              <td class="px-4 py-2 border">A1</td>
              <td class="px-4 py-2 border">Mon-Wed 9:00 - 10:30</td>
              <td class="px-4 py-2 border">Room 201</td>
              <td class="px-4 py-2 border text-center">45</td>
              <td class="px-4 py-2 border">
                <div class="flex flex-wrap gap-2 justify-center">
                  <a href="#" class="px-3 py-1 bg-green-600 text-white text-sm rounded-lg shadow hover:bg-green-700">
                    View Students
                  </a>
                  <a href="#" class="px-3 py-1 bg-yellow-500 text-white text-sm rounded-lg shadow hover:bg-yellow-600">
                    Attendance
                  </a>
                  <a href="#" class="px-3 py-1 bg-blue-600 text-white text-sm rounded-lg shadow hover:bg-blue-700">
                    Assessment
                  </a>
                </div>
              </td>
            </tr>

            <!-- Row 2 -->
            <tr class="hover:bg-gray-50">
              <td class="px-4 py-2 border">MATH202</td>
              <td class="px-4 py-2 border">Advanced Mathematics</td>
              <td class="px-4 py-2 border">B2</td>
              <td class="px-4 py-2 border">Tue-Thu 10:30 - 12:00</td>
              <td class="px-4 py-2 border">Room 105</td>
              <td class="px-4 py-2 border text-center">38</td>
              <td class="px-4 py-2 border">
                <div class="flex flex-wrap gap-2 justify-center">
                  <a href="#" class="px-3 py-1 bg-green-600 text-white text-sm rounded-lg shadow hover:bg-green-700">
                    View Students
                  </a>
                  <a href="#" class="px-3 py-1 bg-yellow-500 text-white text-sm rounded-lg shadow hover:bg-yellow-600">
                    Attendance
                  </a>
                  <a href="#" class="px-3 py-1 bg-blue-600 text-white text-sm rounded-lg shadow hover:bg-blue-700">
                    Assessment
                  </a>
                </div>
              </td>
            </tr>

            <!-- Empty State Example -->
            <tr>
              <td colspan="7" class="text-center py-4 text-gray-500">
                <!-- No subjects assigned yet. -->
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </main>
  </div>

</body>
</html>
</x-teacher-component>
