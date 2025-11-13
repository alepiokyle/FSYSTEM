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

    select, input[type="date"], input[type="time"], input[type="number"], input[type="text"] {
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

    .clickable {
      color: #007bff;
      cursor: pointer;
      text-decoration: underline;
      font-weight: 500;
    }

    .btn {
      display: inline-block;
      background: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 8px 16px;
      font-size: 14px;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn:hover {
      background: #0056b3;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 999;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
      background-color: #fff;
      margin: 10% auto;
      padding: 20px;
      border-radius: 8px;
      width: 90%;
      max-width: 700px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }

    .modal-header {
      font-size: 18px;
      font-weight: bold;
      color: #333;
      margin-bottom: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .close {
      color: #333;
      font-size: 22px;
      font-weight: bold;
      cursor: pointer;
    }

    .actions-cell {
      text-align: center;
    }

    /* Summary Section */
    .summary-section {
      background: #ffffff;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      padding: 20px;
      margin: 30px 20px;
    }

    .summary-section h3 {
      color: #333;
      margin-bottom: 10px;
      text-align: center;
    }
  </style>
</head>

<body>
  <header>
    <h1>Manage Attendance</h1>
  </header>

  <div class="content">
    <div class="card">
      <label for="subject">Select Subject / Class</label>
      <select id="subject">
        <option value="">-- Choose Subject --</option>

        @foreach($assignedSubjects as $subject)
        <option value="{{ $subject->id }}">{{ $subject->subject_code }} - {{ $subject->subject_name }} ({{ $subject->section }})</option>
        @endforeach


      </select>

      <label for="student">Select Student</label>
      <select id="student">
        <option value="">-- Choose Student --</option>
        <!-- Students will be populated dynamically -->
      </select>

      <!-- Grading Breakdown Table -->
      <div class="card" style="margin-top: 15px; background: #fefefe;">
        <h3 style="margin-bottom: 10px; color: #333;">Grading Breakdown</h3>
        <table>
          <thead>
            <tr style="background: #f1f3f5;">
              <th>Component</th>
              <th>Percentage</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><span class="clickable" id="openQuizModal">Quiz</span></td>
              <td>10%</td>
            </tr>
            <tr>
              <td><span class="clickable" id="openAssignmentModal">Assignment</span></td>
              <td>10%</td>
            </tr>
            <tr>
              <td><span class="clickable" id="openAttendanceModal">Attendance</span></td>
              <td>10%</td>
            </tr>
            <tr>
              <td><span class="clickable" id="openExamModal">Exam</span></td>
              <td>30%</td>
            </tr>
            <tr>
              <td><span class="clickable" id="openPerformanceModal">Performance</span></td>
              <td>40%</td>
            </tr>
          </tbody>
        </table>
      </div>

      <label for="date">Select Date and Time</label>
      <div style="display: flex; gap: 10px; align-items: center;">
        <input type="date" id="date" style="flex: 1;" />
        <input type="time" id="time" style="flex: 1;" />
      </div>
    </div>
  </div>

  <!-- ================= MODALS (same as your provided code) ================= -->
  <!-- QUIZ -->
  <div id="quizModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <span>Quiz Scores</span>
        <span class="close" id="closeQuizModal">&times;</span>
      </div>
      <table>
        <thead>
          <tr>
            <th>Student Name</th>
            <th>Items</th>
            <th>Score</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Table body will be populated dynamically -->
        </tbody>
      </table>
    </div>
  </div>

  <!-- ASSIGNMENT -->
  <div id="assignmentModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <span>Assignment Grades</span>
        <span class="close" id="closeAssignmentModal">&times;</span>
      </div>
      <table>
        <thead>
          <tr>
            <th>Student Name</th>
            <th>Assignment Title</th>
            <th>Score (1–100)</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Table body will be populated dynamically -->
        </tbody>
      </table>
    </div>
  </div>

  <!-- ATTENDANCE -->
  <div id="attendanceModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <span>Attendance Record</span>
        <span class="close" id="closeAttendanceModal">&times;</span>
      </div>
      <table>
        <thead>
          <tr>
            <th>Student Name</th>
            <th>Subject Name</th>
            <th>Date & Time</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Table body will be populated dynamically -->
        </tbody>
      </table>
    </div>
  </div>

  <!-- EXAM -->
  <div id="examModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <span>Exam Results</span>
        <span class="close" id="closeExamModal">&times;</span>
      </div>
      <table>
        <thead>
          <tr>
            <th>Student Name</th>
            <th>Exam Items</th>
            <th>Score</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Table body will be populated dynamically -->
        </tbody>
      </table>
    </div>
  </div>

  <!-- PERFORMANCE -->
  <div id="performanceModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <span>Performance Evaluation</span>
        <span class="close" id="closePerformanceModal">&times;</span>
      </div>
      <table>
        <thead>
          <tr>
            <th>Student Name</th>
            <th>Activity</th>
            <th>Score (1–100)</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <!-- Table body will be populated dynamically -->
        </tbody>
      </table>
    </div>
  </div>

  <!-- ================= QUIZ–PERFORMANCE RESULTS TABLE ================= -->
  <div class="summary-section">
    <h3>Quiz–Performance Results Summary</h3>
    <form>
      <table>
        <thead>
          <tr>
            <th>Student Name</th>
            <th>Quiz Average (10%)</th>
            <th>Assignment (10%)</th>
            <th>Attendance (10%)</th>
            <th>Exam (30%)</th>
            <th>Performance (40%)</th>
            <th>Final Grade</th>
          </tr>
        </thead>
        <tbody>
          <!-- Rows will be populated dynamically -->
        </tbody>
      </table>
    </form>
  </div>

  <script>
    let currentSubjectId = null;
    let studentsData = [];

    // Load students when subject changes
    function loadStudents() {
      currentSubjectId = document.getElementById('subject').value;
      const studentSelect = document.getElementById('student');
      studentSelect.innerHTML = '<option value="">-- Choose Student --</option>';

      if (!currentSubjectId) {
        alert('Please select a subject first.');
        // Clear summary table
        document.querySelector('.summary-section tbody').innerHTML = '';
        return;
      }

      // Load students for grading
      fetch(`/teacher/Manage/${currentSubjectId}/grading-students`, {
        method: 'GET',
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'same-origin'
      })
        .then(response => {
          if (!response.ok) {
            if (response.status === 401 || response.status === 403) {
              alert('Authentication error. Please log in as a teacher.');
              return;
            }
            throw new Error(`HTTP error! status: ${response.status}`);
          }
          return response.json();
        })
        .then(data => {
          if (data.success) {
            studentsData = data.students;
            // Populate student select
            data.students.forEach(student => {
              const option = document.createElement('option');
              option.value = student.id;
              option.textContent = student.name;
              studentSelect.appendChild(option);
              });
            // Populate summary table
            populateSummaryTable(data.students);
          } else {
            alert(data.message || 'Error loading students.');
          }
        })
        .catch(error => {
          console.error('Error loading students:', error);
          alert('Error loading students. Please check your authentication.');
        });
    }

    document.getElementById('subject').addEventListener('change', loadStudents);

    function populateSummaryTable(students) {
      const tbody = document.querySelector('.summary-section tbody');
      tbody.innerHTML = '';
      students.forEach(student => {
        // Calculate weighted scores
        const quizWeighted = student.quiz && student.total_quiz ? ((student.quiz / student.total_quiz) * 100 * 0.10).toFixed(2) : '-';
        const assignmentWeighted = student.assignment && student.total_assignment ? ((student.assignment / student.total_assignment) * 100 * 0.10).toFixed(2) : '-';
        const attendanceWeighted = student.attendance_score && student.total_attendance_score ? ((student.attendance_score / student.total_attendance_score) * 100 * 0.10).toFixed(2) : '-';
        const examWeighted = student.exam && student.total_exam ? ((student.exam / student.total_exam) * 100 * 0.30).toFixed(2) : '-';
        const performanceWeighted = student.performance && student.total_performance ? ((student.performance / student.total_performance) * 100 * 0.40).toFixed(2) : '-';

        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${student.name}</td>
          <td>${quizWeighted}</td>
          <td>${assignmentWeighted}</td>
          <td>${attendanceWeighted}</td>
          <td>${examWeighted}</td>
          <td>${performanceWeighted}</td>
          <td><strong>${student.final_grade ? student.final_grade.toFixed(2) : '-'}</strong></td>
        `;
        tbody.appendChild(row);
      });
    }

    // Modal handling
    const modals = {
      quiz: ["openQuizModal", "quizModal", "closeQuizModal", "quiz"],
      assignment: ["openAssignmentModal", "assignmentModal", "closeAssignmentModal", "assignment"],
      attendance: ["openAttendanceModal", "attendanceModal", "closeAttendanceModal", "attendance_score"],
      exam: ["openExamModal", "examModal", "closeExamModal", "exam"],
      performance: ["openPerformanceModal", "performanceModal", "closePerformanceModal", "performance"]
    };

    for (const key in modals) {
      const [openId, modalId, closeId, component] = modals[key];
      const openBtn = document.getElementById(openId);
      const modal = document.getElementById(modalId);
      const closeBtn = document.getElementById(closeId);

      openBtn.onclick = () => {
        if (!currentSubjectId) {
          alert('Please select a subject first.');
          return;
        }
        populateModalTable(modal, component);
        modal.style.display = "block";
      };
      closeBtn.onclick = () => modal.style.display = "none";
      window.onclick = e => { if (e.target === modal) modal.style.display = "none"; };
    }

    function populateModalTable(modal, component) {
      const tbody = modal.querySelector('tbody');
      tbody.innerHTML = '';

      studentsData.forEach(student => {
        const row = document.createElement('tr');
        const score = student[component] ?? '';
        const placeholder = component === 'quiz' ? 'Enter items' : component === 'assignment' ? 'Enter title' : component === 'exam' ? 'Enter exam items' : 'Enter activity';

        // Student Name Cell
        const studentNameCell = document.createElement('td');
        studentNameCell.textContent = student.name;
        row.appendChild(studentNameCell);

        // Total Items Cell
        const totalCell = document.createElement('td');
        const totalInput = document.createElement('input');
        totalInput.type = 'number';
        totalInput.placeholder = 'Enter total items';
        totalInput.value = component === 'quiz' || component === 'exam' ? '100' : '';
        totalInput.min = 1;
        totalCell.appendChild(totalInput);
        row.appendChild(totalCell);

        // Score Cell
        const scoreCell = document.createElement('td');
        const scoreInput = document.createElement('input');
        scoreInput.type = 'number';
        scoreInput.placeholder = 'Enter score';
        scoreInput.value = score;
        scoreInput.min = 0;
        scoreInput.max = 100;
        scoreInput.dataset.studentId = student.id;
        scoreInput.dataset.component = component;
        scoreCell.appendChild(scoreInput);
        row.appendChild(scoreCell);

        // Actions Cell
        const actionsCell = document.createElement('td');
        actionsCell.className = 'actions-cell';
        const saveButton = document.createElement('button');
        saveButton.className = 'btn';
        saveButton.textContent = 'Save';
        saveButton.addEventListener('click', () => saveScore(student.id, component, saveButton));
        actionsCell.appendChild(saveButton);
        row.appendChild(actionsCell);

        tbody.appendChild(row);
      });
    }

    function saveScore(studentId, component, button) {
      const row = button.closest('tr');
      const totalInput = row.querySelector('input[type="number"]:not([data-student-id])');
      const scoreInput = row.querySelector(`input[data-student-id="${studentId}"][data-component="${component}"]`);
      const total = totalInput.value;
      const score = scoreInput.value;

      fetch('/teacher/Manage/save-grading-component', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
          subject_id: currentSubjectId,
          component: component,
          student_id: studentId,
          score: score || null,
          total: total || null
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Score saved successfully!');
          // Update local data
          const student = studentsData.find(s => s.id == studentId);
          if (student) {
            student[component] = score;
            student[`total_${component}`] = total;
            // Calculate final grade
            student.final_grade = calculateFinalGrade(student);
            // Update summary table
            populateSummaryTable(studentsData);
            // Update modal inputs
            totalInput.value = total;
            scoreInput.value = score;
          }
        } else {
          alert(data.message || 'Error saving score.');
        }
      })
      .catch(() => alert('Error saving score.'));
    }

    function calculateFinalGrade(student) {
      const components = ['quiz', 'assignment', 'attendance_score', 'exam', 'performance'];
      let total = 0;
      for (const comp of components) {
        if (student[comp] !== null && student[`total_${comp}`] !== null) {
          const percentage = (parseFloat(student[comp]) / parseFloat(student[`total_${comp}`])) * 100;
          const weight = comp === 'quiz' || comp === 'assignment' || comp === 'attendance_score' ? 0.10 : comp === 'exam' ? 0.30 : 0.40;
          total += percentage * weight;
        } else {
          return null; // Incomplete
        }
      }
      return total;
    }
  </script>
</body>
</html>
</x-teacher-component> 