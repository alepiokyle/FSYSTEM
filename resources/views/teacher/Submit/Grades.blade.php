<x-teacher-component>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Submit Grades - Teacher Dashboard</title>
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
    select {
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
    .btn-submit {
      background: #007bff;
      color: white;
    }
    .btn-export {
      background: #6c757d;
      color: white;
    }
    .note {
      font-size: 13px;
      color: #b33;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <header>
    <h1>Submit Grades</h1>
  </header>

  <div class="content">
    <div class="card">
      <label for="subject">Select Subject</label>
      <select id="subject">
        <option value="">-- Choose Subject --</option>
        @foreach($subjects as $subject)
          <option value="{{ $subject->id }}">{{ $subject->subject_name }} ({{ $subject->subject_code }})</option>
        @endforeach
      </select>
    </div>

    <div class="card">
      <label for="term">Select Term</label>
      <select id="term">
        <option value="">-- Choose Term --</option>
        <option value="prelim">Prelim</option>
        <option value="midterm">Midterm</option>
        <option value="semi_final">Semi-Final</option>
        <option value="final">Final</option>
      </select>
    </div>

    <div class="card">
      <h3>Grades Preview</h3>
      <table>
        <thead>
          <tr>
            <th>Student Name</th>
            <th>Term Grade</th>
            <th>Remarks</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody id="gradesTableBody"></tbody>
      </table>
    </div>

    <div class="actions">
      <button class="btn btn-submit" id="submitGradesBtn" disabled onclick="submitGrades()">Submit Grades</button>
    </div>

    <p class="note">
      ⚠️ Once submitted, grades cannot be edited. Dean will review and approve/post.
    </p>
  </div>

  <script>
    const subjectSelect = document.getElementById('subject');
    const termSelect = document.getElementById('term');
    const gradesTableBody = document.getElementById('gradesTableBody');
    const submitGradesBtn = document.getElementById('submitGradesBtn');

    function getRemarks(termGrade) {
      if (!termGrade || termGrade === '' || termGrade === null) {
        return 'No Grade Yet';
      }
      const grade = parseFloat(termGrade);
      if (isNaN(grade) || grade === 0) {
        return 'Incomplete ⚠️';
      }
      if (grade < 75) {
        return 'Failed ❌';
      }
      return 'Passed ✅';
    }

    function loadGrades() {
      const subjectId = subjectSelect.value;
      const term = termSelect.value;
      gradesTableBody.innerHTML = '';
      submitGradesBtn.disabled = true;

      if (!subjectId || !term) return;

      fetch('/teacher/Submit/fetch-grades', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ subject_id: subjectId, term: term })
      })
      .then(res => res.json())
      .then(data => {
        if (data.error) {
          alert(data.error);
          return;
        }
        data.forEach(grade => {
          const row = document.createElement('tr');
          const remarks = getRemarks(grade.term_grade);
          row.innerHTML = `
            <td>${grade.student_name}</td>
            <td>${grade.term_grade}</td>
            <td>${remarks}</td>
            <td>${grade.status}</td>
          `;
          gradesTableBody.appendChild(row);
        });
        submitGradesBtn.disabled = false;
      })
      .catch(() => alert('Error loading grades.'));
    }

    subjectSelect.addEventListener('change', loadGrades);
    termSelect.addEventListener('change', loadGrades);

    function submitGrades() {
      const subjectId = subjectSelect.value;
      if (!subjectId) {
        alert('Please select a subject.');
        return;
      }
      if (!confirm('Are you sure you want to submit grades to the Dean? Once submitted, you cannot edit them.')) {
        return;
      }

      fetch('/teacher/Submit/submit-grades', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ subject_id: subjectId })
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert(data.message);
          loadGrades();
        } else {
          alert(data.error || 'Error submitting grades.');
        }
      })
      .catch(() => alert('Error submitting grades.'));
    }
  </script>
</body>
</html>
</x-teacher-component>
