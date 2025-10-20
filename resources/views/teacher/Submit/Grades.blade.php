<x-teacher-component>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Submit Grades - Teacher Dashboard</title>
  <style>
    x-teacher-component {
      background: linear-gradient(to right, #f0f4f8, #ffffff);
      min-height: 100vh;
      padding: 40px 60px;
      display: block;
      font-family: 'Poppins', sans-serif;
    }
    .page-header {
      font-weight: 700;
      color: #1e3a8a;
      border-bottom: 3px solid #2563eb;
      display: inline-block;
      padding-bottom: 8px;
    }
    .card {
      border: none;
      border-radius: 16px;
      transition: all 0.3s ease;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      margin-bottom: 20px;
    }
    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
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
      border-radius: 30px;
      cursor: pointer;
      font-size: 14px;
      margin-right: 6px;
      font-weight: 500;
      transition: 0.3s;
    }
    .btn-submit {
      background: #2563eb;
      color: white;
    }
    .btn-submit:hover {
      background-color: #1e40af;
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

    /* Mobile responsiveness */
    @media (max-width: 768px) {
      x-teacher-component {
        padding: 20px 30px;
      }

      .card {
        border-radius: 12px;
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
  <div class="container mt-4">
    <h3 class="page-header mb-4">📊 Submit Grades</h3>
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
      <h3 style="margin-bottom: 10px;">Grade Preview</h3>
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
