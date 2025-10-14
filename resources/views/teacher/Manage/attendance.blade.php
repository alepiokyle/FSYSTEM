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
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f5f7fa;
      margin: 0;
      padding: 0;
    }
    .container {
      padding: 20px;
    }
    h1 {
      font-size: 24px;
      margin-bottom: 15px;
      color: #333;
    }
    .card {
      background: #fff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    label {
      font-weight: 500;
      display: block;
      margin-bottom: 6px;
      color: #444;
    }
    select, input[type="date"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 14px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }
    table th, table td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: center;
      font-size: 14px;
    }
    table th {
      background: #f0f2f5;
      font-weight: 600;
    }
    .btn {
      padding: 10px 18px;
      border: none;
      border-radius: 8px;
      font-size: 14px;
      cursor: pointer;
      margin-right: 10px;
    }
    .btn-save {
      background: #4CAF50;
      color: #fff;
    }
    .btn-view {
      background: #007bff;
      color: #fff;
    }
    .btn:hover {
      opacity: 0.9;
    }
    .hidden {
      display: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Manage Attendance</h1>

    <!-- Select Class & Date -->
    <div class="card">
      <label for="subject">Select Subject / Class</label>
      <select id="subject">
        <option value="">-- Choose Subject --</option>
        @foreach($assignedSubjects as $subject)
        <option value="{{ $subject->id }}">{{ $subject->subject_code }} - {{ $subject->subject_name }} ({{ $subject->section }})</option>
        @endforeach
      </select>

      <label for="date">Select Date</label>
      <input type="date" id="date" />
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

    <!-- Static Attendance Table (Original) -->
    <div class="card">
      <h3>Student List (Static)</h3>
      <table>
        <thead>
          <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>2025001</td>
            <td>Juan Dela Cruz</td>
            <td>
              <select>
                <option>Present</option>
                <option>Absent</option>
                <option>Late</option>
                <option>Excused</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>2025002</td>
            <td>Maria Santos</td>
            <td>
              <select>
                <option>Present</option>
                <option>Absent</option>
                <option>Late</option>
                <option>Excused</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>2025003</td>
            <td>Pedro Reyes</td>
            <td>
              <select>
                <option>Present</option>
                <option>Absent</option>
                <option>Late</option>
                <option>Excused</option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Action Buttons -->
    <div>
      <button class="btn btn-save">Save Attendance</button>
      <button class="btn btn-view">View Past Records</button>
    </div>

    <!-- Action Buttons -->
    <div id="actionButtons" style="display: none;">
      <button class="btn btn-save">Save Attendance</button>
      <button class="btn btn-view">View Past Records</button>
    </div>
  </div>

  <script>
    document.getElementById('subject').addEventListener('change', function() {
      const subjectId = this.value;
      const date = document.getElementById('date').value;

      if (subjectId && date) {
        loadStudents(subjectId, date);
      } else {
        document.getElementById('attendanceCard').style.display = 'none';
        document.getElementById('actionButtons').style.display = 'none';
      }
    });

    document.getElementById('date').addEventListener('change', function() {
      const subjectId = document.getElementById('subject').value;
      const date = this.value;

      if (subjectId && date) {
        loadStudents(subjectId, date);
      } else {
        document.getElementById('attendanceCard').style.display = 'none';
        document.getElementById('actionButtons').style.display = 'none';
      }
    });

    function isWeekend(dateString) {
      const date = new Date(dateString);
      const day = date.getDay(); // 0=Sunday, 6=Saturday
      return day === 0 || day === 6;
    }

    function loadStudents(subjectId, date) {
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

      fetch(`/teacher/Manage/${subjectId}/students?date=${date}`, {
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
    document.querySelector('.btn-save').addEventListener('click', function() {
      const subjectId = document.getElementById('subject').value;
      const date = document.getElementById('date').value;

      if (!subjectId || !date) {
        alert('Please select subject and date.');
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
    });
  </script>
</body>
</html>
</x-teacher-component>
