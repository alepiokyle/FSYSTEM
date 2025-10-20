<x-teacher-component>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Manage Attendance - Teacher Dashboard</title>

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f8f9fa;
      margin: 0;
      padding: 0;
    }

    header {
      background: #ffffff;
      padding: 15px 20px;
      border-bottom: 1px solid #ddd;
      box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    header h1 {
      margin: 0;
      font-size: 22px;
      color: #333;
    }

    .content {
      padding: 20px;
    }

    .card {
      background: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      margin-bottom: 20px;
    }

    label {
      font-weight: 500;
      display: block;
      margin-bottom: 6px;
      color: #444;
    }

    select, input[type="date"], input[type="time"] {
      width: 100%;
      padding: 8px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 14px;
      margin-bottom: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      font-size: 14px;
    }

    th, td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: center;
    }

    th {
      background: #f1f3f5;
      font-weight: 600;
    }

    .btn {
      padding: 8px 12px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 14px;
      margin-right: 6px;
    }

    .btn-save {
      background: #4CAF50;
      color: white;
    }

    .btn-view {
      background: #007bff;
      color: white;
    }

    .hidden {
      display: none;
    }

    .status-present {
      color: #28a745;
      font-weight: bold;
    }

    .status-absent {
      color: #dc3545;
      font-weight: bold;
    }

    .status-late {
      color: #ffc107;
      font-weight: bold;
    }

    .status-excused {
      color: #6c757d;
      font-weight: bold;
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
      .content {
        padding: 10px;
      }

      .card {
        padding: 15px;
      }

      table {
        font-size: 12px;
      }

      th, td {
        padding: 8px;
      }

      .btn {
        padding: 6px 10px;
        font-size: 12px;
      }
    }
  </style>
</head>

<body>
  <header>
    <h1>Manage Attendance</h1>
  </header>

  <div class="content">
    <!-- Select Class, Date & Time -->
    <div class="card">
      <label for="subject">Select Subject / Class</label>
      <select id="subject">
        <option value="">-- Choose Subject --</option>
        @foreach($assignedSubjects as $subject)
        <option value="{{ $subject->id }}">{{ $subject->subject_code }} - {{ $subject->subject_name }} ({{ $subject->section }})</option>
        @endforeach
      </select>

      <label for="date">Select Date and Time</label>
      <div style="display: flex; gap: 10px; align-items: center;">
        <input type="date" id="date" style="flex: 1;" />
        <input type="time" id="time" style="flex: 1;" />
      </div>
    </div>

    <!-- Attendance Table -->
    <div class="card" id="attendanceCard" style="display: none;">
      <h3>Student List</h3>
      <div id="weekendMessage" style="display: none; color: red; font-weight: bold;">
        🚫 Attendance cannot be recorded on weekends.
      </div>
      <table id="attendanceTable">
        <thead>
          <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody id="studentsTableBody">
          <!-- Students will be populated here -->
        </tbody>
      </table>
    </div>

    <!-- Action Buttons -->
    <div id="actionButtons" style="display: none;">
      <button class="btn btn-save">Save Attendance</button>
    </div>

    <!-- View Past Records Button (Always Visible) -->
    <div style="text-align: center; margin: 20px 0;">
      <button class="btn btn-view" id="viewPastRecordsBtn">View Past Records</button>
    </div>
  </div>

  <script>
    // Event listeners for subject, date, and time
    document.getElementById('subject').addEventListener('change', handleSelectionChange);
    document.getElementById('date').addEventListener('change', handleSelectionChange);
    document.getElementById('time').addEventListener('change', handleSelectionChange);

    function handleSelectionChange() {
      const subjectId = document.getElementById('subject').value;
      const date = document.getElementById('date').value;
      const time = document.getElementById('time').value;

      if (subjectId && date && time) {
        loadStudents(subjectId, date, time);
      } else {
        document.getElementById('attendanceCard').style.display = 'none';
        document.getElementById('actionButtons').style.display = 'none';
      }
    }

    function isWeekend(dateString) {
      const date = new Date(dateString);
      const day = date.getDay(); // 0=Sunday, 6=Saturday
      return day === 0 || day === 6;
    }

    function loadStudents(subjectId, date, time) {
      const weekendMessage = document.getElementById('weekendMessage');
      const attendanceTable = document.getElementById('attendanceTable');
      const actionButtons = document.getElementById('actionButtons');

      if (isWeekend(date)) {
        weekendMessage.style.display = 'block';
        attendanceTable.style.display = 'none';
        actionButtons.style.display = 'none';
        return;
      } else {
        weekendMessage.style.display = 'none';
        attendanceTable.style.display = 'table';
      }

      fetch(`/teacher/Manage/${subjectId}/students?date=${date}&time=${time}`, {
        method: 'GET',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
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
              const selectedPresent = student.status === 'Present' ? 'selected' : '';
              const selectedAbsent = student.status === 'Absent' ? 'selected' : '';
              const selectedLate = student.status === 'Late' ? 'selected' : '';
              row.innerHTML = `
                <td>${student.student_id}</td>
                <td>${student.full_name}</td>
                <td>
                  <select name="attendance[${student.id}]">
                    <option value="Present" ${selectedPresent}>Present</option>
                    <option value="Absent" ${selectedAbsent}>Absent</option>
                    <option value="Late" ${selectedLate}>Late</option>
                    <option value="Excused">Excused</option>
                  </select>
                </td>
              `;
              tbody.appendChild(row);
            });
            document.getElementById('attendanceCard').style.display = 'block';
            actionButtons.style.display = 'block';
          } else {
            tbody.innerHTML = '<tr><td colspan="3">No students enrolled in this subject.</td></tr>';
            document.getElementById('attendanceCard').style.display = 'block';
            actionButtons.style.display = 'none';
          }
        } else {
          alert('Failed to load students: ' + data.message);
        }
      })
      .catch(error => {
        alert('Error loading students.');
        console.error('Error:', error);
      });
    }

    // Save attendance
    document.addEventListener('click', function(e) {
      if (e.target.classList.contains('btn-save')) {
        const subjectId = document.getElementById('subject').value;
        const date = document.getElementById('date').value;
        const time = document.getElementById('time').value;

        if (!subjectId || !date || !time) {
          alert('Please select subject, date, and time.');
          return;
        }

        const attendanceData = {};
        const selects = document.querySelectorAll('select[name^="attendance["]');
        selects.forEach(select => {
          const studentId = select.name.match(/\[(\d+)\]/)[1];
          attendanceData[studentId] = select.value;
        });

        fetch('/teacher/Manage/save-attendance', {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
          },
          body: JSON.stringify({
            subject_id: subjectId,
            date: date,
            time: time,
            attendance: attendanceData
          })
        })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            alert('Attendance saved successfully.');
          } else {
            alert('Failed to save attendance: ' + data.message);
          }
        })
        .catch(error => {
          alert('Error saving attendance.');
          console.error('Error:', error);
        });
      }
    });

    // View past records
    document.addEventListener('click', function(e) {
      if (e.target.id === 'viewPastRecordsBtn') {
        loadPastRecords();
      }
    });

    function loadPastRecords() {
      fetch('/teacher/Manage/past-records', {
        method: 'GET',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Create or update the past records section
          let pastRecordsSection = document.getElementById('pastRecordsSection');
          if (!pastRecordsSection) {
            pastRecordsSection = document.createElement('div');
            pastRecordsSection.id = 'pastRecordsSection';
            pastRecordsSection.className = 'bg-white shadow rounded-lg p-4 sm:p-6 mb-6';
            pastRecordsSection.innerHTML = `
              <h3 class="text-lg font-semibold mb-4 text-gray-800">Past Attendance Records</h3>
              <div class="overflow-x-auto">
                <table id="pastRecordsTable" class="min-w-full border border-gray-200">
                  <thead class="bg-gray-100 text-gray-700">
                    <tr>
                      <th class="px-4 py-2 border">Date</th>
                      <th class="px-4 py-2 border">Time</th>
                      <th class="px-4 py-2 border">Student ID</th>
                      <th class="px-4 py-2 border">Student Name</th>
                      <th class="px-4 py-2 border">Status</th>
                      <th class="px-4 py-2 border">Subject</th>
                    </tr>
                  </thead>
                  <tbody id="pastRecordsTableBody" class="text-gray-800">
                  </tbody>
                </table>
              </div>
              <div id="noRecordsMessage" class="hidden text-center text-gray-500 italic py-4">
                No attendance records found.
              </div>
            `;
            document.querySelector('main').appendChild(pastRecordsSection);
          }

          const tbody = document.getElementById('pastRecordsTableBody');
          const noRecordsMessage = document.getElementById('noRecordsMessage');
          tbody.innerHTML = '';

          if (data.records.length > 0) {
            data.records.forEach(record => {
              const row = document.createElement('tr');
              let statusClass = '';
              switch (record.status) {
                case 'Present':
                  statusClass = 'text-green-600 font-bold';
                  break;
                case 'Absent':
                  statusClass = 'text-red-600 font-bold';
                  break;
                case 'Late':
                  statusClass = 'text-yellow-600 font-bold';
                  break;
                case 'Excused':
                  statusClass = 'text-gray-600 font-bold';
                  break;
              }
              row.innerHTML = `
                <td class="px-4 py-2 border">${record.date}</td>
                <td class="px-4 py-2 border">${record.time}</td>
                <td class="px-4 py-2 border">${record.student_id}</td>
                <td class="px-4 py-2 border">${record.student_name}</td>
                <td class="px-4 py-2 border ${statusClass}">${record.status}</td>
                <td class="px-4 py-2 border">${record.subject}</td>
              `;
              tbody.appendChild(row);
            });
            noRecordsMessage.classList.add('hidden');
            pastRecordsSection.classList.remove('hidden');
          } else {
            noRecordsMessage.classList.remove('hidden');
            pastRecordsSection.classList.remove('hidden');
          }
        } else {
          alert('Failed to load past records: ' + data.message);
        }
      })
      .catch(error => {
        alert('Error loading past records.');
        console.error('Error:', error);
      });
    }
  </script>
</body>
</html>
</x-teacher-component>
