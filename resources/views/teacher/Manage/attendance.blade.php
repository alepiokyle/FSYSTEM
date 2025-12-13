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

    /* Subject Details Section */
    .subject-details {
      background: #ffffff;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      padding: 20px;
      margin: 20px 0;
      display: none; /* Hidden initially */
    }

    .subject-details h3 {
      color: #333;
      margin-bottom: 15px;
      text-align: center;
    }

    .subject-info {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .subject-info div {
      flex: 1 1 200px;
    }

    .subject-info label {
      font-weight: bold;
      color: #555;
    }

    .subject-info p {
      margin: 5px 0 0 0;
      color: #333;
    }

    /* Enrolled Students Section */
    .enrolled-students {
      background: #ffffff;
      border-radius: 10px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      padding: 20px;
      margin: 20px 0;
      display: none; /* Hidden initially */
    }

    .enrolled-students h3 {
      color: #333;
      margin-bottom: 15px;
      text-align: center;
    }

    /* Calendar Styles */
    #calendarContainer {
      width: 100%;
      max-width: 300px;
      margin: 0 auto;
    }

    #calendarHeader {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 10px;
    }

    #calendarHeader button {
      background: #007bff;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 5px 10px;
      cursor: pointer;
    }

    #calendarHeader button:hover {
      background: #0056b3;
    }

    #monthYear {
      font-weight: bold;
      font-size: 18px;
    }

    #calendarDays {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      margin-bottom: 5px;
    }

    #calendarDays div {
      text-align: center;
      font-weight: bold;
      padding: 5px;
    }

    #calendarDates {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 5px;
    }

    .calendar-date {
      padding: 10px;
      text-align: center;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .calendar-date:hover {
      background-color: #f0f0f0;
    }

    .calendar-date.selected {
      background-color: #007bff;
      color: #fff;
    }

    .calendar-date.present {
      background-color: #007bff;
      color: #fff;
    }

    .calendar-date.absent {
      background-color: #dc3545;
      color: #fff;
    }

    .calendar-date.excused {
      background-color: #6c757d;
      color: #fff;
    }

    #attendanceButtons {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-bottom: 10px;
    }

    .attendance-btn {
      padding: 5px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
    }

    .attendance-btn.present {
      background-color: #007bff;
      color: #fff;
    }

    .attendance-btn.absent {
      background-color: #dc3545;
      color: #fff;
    }

    .attendance-btn.excused {
      background-color: #6c757d;
      color: #fff;
    }

    .attendance-btn.active {
      border: 2px solid #000;
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

      <!-- Enrolled Students Section -->
      <div class="enrolled-students" id="enrolledStudents">
        <h3>Enrolled Students</h3>
        <table id="enrolledStudentsTable">
          <thead id="enrolledStudentsTableHead">
            <tr>
              <th>Student ID</th>
              <th>Student Name</th>
              <th>Department</th>
              <th>Year Level</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <!-- Enrolled students will be populated here -->
          </tbody>
        </table>
      </div>




   
    </div>
  </div>

  <!-- ================= GRADING BREAKDOWN MODAL ================= -->
  <div id="gradingModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <span id="modalTitle">Grading Breakdown</span>
        <span class="close" id="closeGradingModal">&times;</span>
      </div>
      <div id="modalBody">
        <table>
          <thead>
            <tr>
              <th>Component</th>
              <th>Percentage</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><span class="clickable" onclick="showGradingForComponent('quiz')">Quiz</span></td>
              <td>10%</td>
            </tr>
            <tr>
              <td><span class="clickable" onclick="showGradingForComponent('assignment')">Assignment</span></td>
              <td>10%</td>
            </tr>
            <tr>
              <td><span class="clickable" onclick="showGradingForComponent('attendance_score')">Attendance</span></td>
              <td>10%</td>
            </tr>
            <tr>
              <td><span class="clickable" onclick="showGradingForComponent('exam')">Exam</span></td>
              <td>30%</td>
            </tr>
            <tr>
              <td><span class="clickable" onclick="showGradingForComponent('performance')">Performance</span></td>
              <td>40%</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- ================= ATTENDANCE RECORD MODAL ================= -->
  <div id="attendanceRecordModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <span>Attendance Record</span>
        <div id="attendanceButtons">
          <button class="attendance-btn present" onclick="setAttendanceStatus('present')">Present</button>
          <button class="attendance-btn absent" onclick="setAttendanceStatus('absent')">Absent</button>
          <button class="attendance-btn excused" onclick="setAttendanceStatus('excused')">Excused</button>
        </div>
        <span class="close" id="closeAttendanceRecordModal">&times;</span>
      </div>
      <div id="calendarContainer">
        <div id="calendarHeader">
          <button id="prevMonth"><</button>
          <span id="monthYear"></span>
          <button id="nextMonth">></button>
        </div>
        <div id="calendarDays">
          <div>Sun</div>
          <div>Mon</div>
          <div>Tue</div>
          <div>Wed</div>
          <div>Thu</div>
          <div>Fri</div>
          <div>Sat</div>
        </div>
        <div id="calendarDates"></div>
      </div>
    </div>
  </div>

  <!-- ================= QUIZ–PERFORMANCE RESULTS TABLE ================= -->
  <div class="summary-section">
    <h3>Quiz–Performance Results Summary</h3>
    <form>
      <label for="term">Select Term</label>
      <select id="term">
        <option value="">-- Select Term --</option>
        <option value="prelim">Prelim</option>
        <option value="midterm">Midterm</option>
        <option value="semi-final">Semi-Final</option>
        <option value="final">Final</option>
        <option value="term-grade">Term Grade</option>
      </select>
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
            <th>Actions</th>
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
    let enrolledStudentsData = [];
    let completedStudentsData = [];
    let currentStudentId = null;
    let selectedDates = new Map(); // key: date string, value: status ('present', 'absent', 'excused')
    let currentCalendarDate = new Date();
    let currentAttendanceStatus = 'present'; // default status

    // Load saved subject on page load
    window.addEventListener('DOMContentLoaded', function() {
      const savedSubjectId = localStorage.getItem('selectedSubjectId');
      if (savedSubjectId) {
        document.getElementById('subject').value = savedSubjectId;
        loadSubjectDetails();
      }
    });

    // Load students when subject changes
    function loadSubjectDetails() {
      currentSubjectId = document.getElementById('subject').value;
      const enrolledStudentsDiv = document.getElementById('enrolledStudents');

      if (!currentSubjectId) {
        // Hide sections if no subject selected
        enrolledStudentsDiv.style.display = 'none';
        // Clear summary table
        document.querySelector('.summary-section tbody').innerHTML = '';
        localStorage.removeItem('selectedSubjectId');
        return;
      }

      // Save selected subject to localStorage
      localStorage.setItem('selectedSubjectId', currentSubjectId);

      // Load students for grading and enrolled students display
      fetch(`/teacher/Manage/${currentSubjectId}/grading-students`, {
        method: 'GET',
        headers: {
          'Accept': 'application/json',
          'X-Requested-With': 'XMLHttpRequest'
        },
        credentials: 'same-origin'
      })
        .then(response => {
          const contentType = response.headers.get('content-type');
          if (contentType && contentType.includes('application/json')) {
            return response.json();
          } else {
            throw new Error('Authentication error. Please log in as a teacher.');
          }
        })
        .then(data => {
          if (data.success) {
            studentsData = data.students;
            // Separate enrolled (incomplete and not done) and completed (done) students
            enrolledStudentsData = [...new Map(studentsData.filter(student => !student.is_done).map(s => [s.id, s])).values()];
            completedStudentsData = [...new Map(studentsData.filter(student => student.is_done).map(s => [s.id, s])).values()];
            // Populate enrolled students table
            populateEnrolledStudentsTable(enrolledStudentsData);
            enrolledStudentsDiv.style.display = 'block';
            // Populate summary table with completed students (those marked as done)
            populateSummaryTable(completedStudentsData);
            // Update save buttons visibility
            updateSaveButtons();
          } else {
            alert(data.message || 'Error loading students.');
          }
        })
        .catch(error => {
          console.error('Error loading students:', error);
          alert(error.message || 'Error loading students. Please check your authentication.');
        });
    }

    function isGradingComplete(student) {
      const components = ['quiz', 'assignment', 'attendance_score', 'exam', 'performance'];
      return components.every(comp => student[comp] !== null && student[`total_${comp}`] !== null);
    }

    document.getElementById('subject').addEventListener('change', loadSubjectDetails);

    function populateEnrolledStudentsTable(students) {
      const tbody = document.querySelector('#enrolledStudentsTable tbody');
      tbody.innerHTML = '';
      students.forEach(student => {
        const row = document.createElement('tr');
        row.innerHTML = `
          <td>${student.student_id || 'N/A'}</td>
          <td>${student.name || 'N/A'}</td>
          <td>${student.department || 'N/A'}</td>
          <td>${student.year_level || 'N/A'}</td>
          <td>

            <button class="btn" onclick="openGradingModal('${student.id}')">Edit</button>
          </td>
        `;
        tbody.appendChild(row);
      });
    }

    function populateSummaryTable(students) {
      const tbody = document.querySelector('.summary-section tbody');
      const term = document.getElementById('term').value;
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
          <td>${student.name || 'N/A'}</td>
          <td>${quizWeighted}</td>
          <td>${assignmentWeighted}</td>
          <td>${attendanceWeighted}</td>
          <td>${examWeighted}</td>
          <td>${performanceWeighted}</td>
          <td><strong>${student.final_grade ? student.final_grade.toFixed(2) : '-'}</strong></td>
          <td><button class="btn save-btn" id="save-btn-${student.id}" style="display: ${student.is_done && term ? 'block' : 'none'};" onclick="saveFinalGrade('${student.id}')">Save</button></td>
        `;
        tbody.appendChild(row);
      });
    }

    // Grading modal handling
    const gradingModal = document.getElementById('gradingModal');
    const closeGradingModal = document.getElementById('closeGradingModal');
    closeGradingModal.onclick = () => {
      gradingModal.style.display = "none";
      resetModalToGradingBreakdown();
    };
    window.onclick = e => {
      if (e.target === gradingModal) {
        gradingModal.style.display = "none";
        resetModalToGradingBreakdown();
      }
    };

    // Attendance Record modal handling
    const attendanceRecordModal = document.getElementById('attendanceRecordModal');
    const closeAttendanceRecordModal = document.getElementById('closeAttendanceRecordModal');
    closeAttendanceRecordModal.onclick = () => {
      attendanceRecordModal.style.display = "none";
    };
    window.onclick = e => {
      if (e.target === attendanceRecordModal) {
        attendanceRecordModal.style.display = "none";
      }
    };

    function openGradingModal(studentId) {
      currentStudentId = studentId;
      const student = studentsData.find(s => s.id == studentId);
      if (!student) {
        alert('Student not found.');
        return;
      }
      document.getElementById('modalTitle').textContent = `Grading for ${student.name}`;
      gradingModal.style.display = "block";
    }

    function resetModalToGradingBreakdown() {
      const student = studentsData.find(s => s.id == currentStudentId);
      const isComplete = isGradingComplete(student);
      document.getElementById('modalTitle').textContent = 'Grading Breakdown';
      document.getElementById('modalBody').innerHTML = `
        <table>
          <thead>
            <tr>
              <th>Component</th>
              <th>Percentage</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><span class="clickable" onclick="showGradingForComponent('quiz')">Quiz</span></td>
              <td>10%</td>
            </tr>
            <tr>
              <td><span class="clickable" onclick="showGradingForComponent('assignment')">Assignment</span></td>
              <td>10%</td>
            </tr>
            <tr>
              <td><span class="clickable" onclick="showGradingForComponent('attendance_score')">Attendance</span></td>
              <td>10%</td>
            </tr>
            <tr>
              <td><span class="clickable" onclick="showGradingForComponent('exam')">Exam</span></td>
              <td>30%</td>
            </tr>
            <tr>
              <td><span class="clickable" onclick="showGradingForComponent('performance')">Performance</span></td>
              <td>40%</td>
            </tr>
          </tbody>
        </table>
        <div style="text-align: center; margin-top: 10px;">
          <button class="btn" id="saveBtn" onclick="saveAllComponents()">Save</button>
          <button class="btn" id="doneBtn" onclick="markAsDone()" ${isComplete && !student.is_done ? '' : 'disabled'}>Done</button>
        </div>
      `;
    }

    function showGradingForComponent(component) {
      const componentNames = {
        quiz: 'Quiz',
        assignment: 'Assignment',
        attendance_score: 'Attendance',
        exam: 'Exam',
        performance: 'Performance'
      };
      const student = studentsData.find(s => s.id == currentStudentId);
      document.getElementById('modalTitle').textContent = `${componentNames[component]} Grading for ${student.name}`;
      const modalBody = document.getElementById('modalBody');
      modalBody.innerHTML = `
        <button class="btn" onclick="resetModalToGradingBreakdown()">Back to Grading Breakdown</button>
        <button class="btn" onclick="openAttendanceRecordModal()">Attendance Record</button>
        <table style="margin-top: 10px;">
          <thead>
            <tr>
              <th>Student Name</th>
              <th>Total Items</th>
              <th>Score</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>${student.name || 'N/A'}</td>
              <td><input type="number" placeholder="Total" value="${student[`total_${component}`] || (component === 'quiz' || component === 'exam' || component === 'attendance_score' ? '100' : '')}" /></td>
              <td><input type="number" placeholder="Score" value="${student[component] || ''}" min="0" max="100" data-student-id="${student.id}" data-component="${component}" /></td>
              <td><button class="btn" onclick="saveScoreFromModal('${student.id}', '${component}', this)">Save</button></td>
            </tr>
          </tbody>
        </table>

      `;
    }

    function saveScoreFromModal(studentId, component, button) {
      const row = button.closest('tr');
      const inputs = row.querySelectorAll('input[type="number"]');
      const total = inputs[0].value.trim() === '' ? null : inputs[0].value;
      const score = inputs[1].value.trim() === '' ? null : inputs[1].value;

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
          score: score,
          total: total
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
            student.final_grade = calculateFinalGrade(student);
            // Do not move to completed until Done is clicked
            populateEnrolledStudentsTable(enrolledStudentsData);
            const editedEnrolledStudents = enrolledStudentsData.filter(student => student.quiz !== null || student.assignment !== null || student.attendance_score !== null || student.exam !== null || student.performance !== null);
            populateSummaryTable(editedEnrolledStudents);
          }
        } else {
          alert(data.message || 'Error saving score.');
        }
      })
      .catch(() => alert('Error saving score.'));
    }

    function saveAllComponents() {
      // This function can be used to save all components at once if needed
      alert('All components saved!');
      resetModalToGradingBreakdown();
    }

    function markAsDone() {
      const student = studentsData.find(s => s.id == currentStudentId);
      if (!student) return;

      // Send request to mark as done
      fetch('/teacher/Manage/mark-as-done', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
          subject_id: currentSubjectId,
          student_id: currentStudentId
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Student marked as done successfully!');
          // Update local data
          student.is_done = true;
          // Move student from enrolled to completed
          enrolledStudentsData = enrolledStudentsData.filter(s => s.id != currentStudentId);
          if (!completedStudentsData.find(s => s.id == currentStudentId)) {
            completedStudentsData.push(student);
          }
          // Update tables
          populateEnrolledStudentsTable(enrolledStudentsData);
          populateSummaryTable(completedStudentsData);
          // Close modal
          gradingModal.style.display = "none";
        } else {
          alert(data.message || 'Error marking as done.');
        }
      })
      .catch(() => alert('Error marking as done.'));
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

    function updateSaveButtons() {
      const term = document.getElementById('term').value;
      const saveButtons = document.querySelectorAll('.save-btn');
      saveButtons.forEach(btn => {
        const studentId = btn.id.replace('save-btn-', '');
        const student = studentsData.find(s => s.id == studentId);
        btn.style.display = student && student.is_done && term ? 'block' : 'none';
      });
    }

    document.getElementById('term').addEventListener('change', updateSaveButtons);

    function saveFinalGrade(studentId) {
      const term = document.getElementById('term').value;
      if (!term) {
        alert('Please select a term first.');
        return;
      }

      const student = studentsData.find(s => s.id == studentId);
      if (!student || student.final_grade === null) {
        alert('Final grade is not calculated yet.');
        return;
      }

      fetch('/teacher/Manage/save-final-grade', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
          subject_id: currentSubjectId,
          student_id: studentId,
          term: term,
          grade: student.final_grade
        })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          alert('Final grade saved successfully!');
          // Auto-refresh the summary table
          loadSubjectDetails();
        } else {
          alert(data.message || 'Error saving final grade.');
        }
      })
      .catch(() => alert('Error saving final grade.'));
    }

    function openAttendanceRecordModal() {
      attendanceRecordModal.style.display = "block";
      setAttendanceStatus('present'); // Reset to default
      renderCalendar();
    }

    function highlightDate(input) {
      input.style.backgroundColor = "#e0f7fa"; // Light blue highlight
      setTimeout(() => {
        input.style.backgroundColor = ""; // Reset after a short time
      }, 1000);
    }

    function renderCalendar() {
      const monthYear = document.getElementById('monthYear');
      const calendarDates = document.getElementById('calendarDates');

      monthYear.textContent = currentCalendarDate.toLocaleString('default', { month: 'long', year: 'numeric' });

      calendarDates.innerHTML = '';

      const firstDay = new Date(currentCalendarDate.getFullYear(), currentCalendarDate.getMonth(), 1);
      const lastDay = new Date(currentCalendarDate.getFullYear(), currentCalendarDate.getMonth() + 1, 0);
      const startDate = new Date(firstDay);
      startDate.setDate(startDate.getDate() - firstDay.getDay());

      for (let i = 0; i < 42; i++) {
        const date = new Date(startDate);
        date.setDate(startDate.getDate() + i);

        const dateDiv = document.createElement('div');
        dateDiv.className = 'calendar-date';
        dateDiv.textContent = date.getDate();

        if (date.getMonth() !== currentCalendarDate.getMonth()) {
          dateDiv.classList.add('other-month');
        }

        const dateKey = date.toDateString();
        const status = selectedDates.get(dateKey);
        if (status) {
          dateDiv.classList.add(status);
        }

        dateDiv.onclick = () => selectDate(date);
        calendarDates.appendChild(dateDiv);
      }
    }

    function selectDate(date) {
      const dateKey = date.toDateString();
      const currentStatus = selectedDates.get(dateKey);
      if (currentStatus === currentAttendanceStatus) {
        selectedDates.delete(dateKey);
      } else {
        selectedDates.set(dateKey, currentAttendanceStatus);
      }
      renderCalendar();
    }

    function setAttendanceStatus(status) {
      currentAttendanceStatus = status;
      // Update button active states
      document.querySelectorAll('.attendance-btn').forEach(btn => {
        btn.classList.remove('active');
      });
      document.querySelector(`.attendance-btn.${status}`).classList.add('active');
    }

    document.getElementById('prevMonth').onclick = () => {
      currentCalendarDate.setMonth(currentCalendarDate.getMonth() - 1);
      renderCalendar();
    };

    document.getElementById('nextMonth').onclick = () => {
      currentCalendarDate.setMonth(currentCalendarDate.getMonth() + 1);
      renderCalendar();
    };
  </script>
</body>
</html>
</x-teacher-component> 