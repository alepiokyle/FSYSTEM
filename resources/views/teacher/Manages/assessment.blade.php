<x-teacher-component>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Manage Assessments - Teacher Dashboard</title>
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

    input.grade-input {
      width: 70px;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
      text-align: center;
      font-size: 13px;
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

    .btn-edit {
      background: #f39c12;
      color: white;
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

    .actions {
      margin-top: 10px;
    }

    /* ===== Modal Styles ===== */
    .modal {
      display: none;
      position: fixed;
      z-index: 10;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
      background-color: #fff;
      margin: 8% auto;
      padding: 20px;
      border-radius: 10px;
      width: 400px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.3);
      position: relative;
    }

    .close {
      color: #aaa;
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 22px;
      cursor: pointer;
    }

    .close:hover {
      color: #000;
    }

    .modal-content input {
      width: 100%;
      padding: 8px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .modal-content button {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 6px;
      background: #2f3e46;
      color: #fff;
      font-size: 14px;
      cursor: pointer;
    }

    .modal-content button:hover {
      background: #1f2b32;
    }
  </style>
</head>
<body>
  <header>
    <h1>Manage Assessments</h1>
  </header>

  <div class="content">
    <!-- Subject Selector -->
    <div class="card">
      <label for="subject">Select Subject</label>
      <select id="subject">
        <option value="">-- Choose Subject --</option>
        @foreach($subjects as $subject)
          <option value="{{ $subject->id }}">{{ $subject->subject_name }} ({{ $subject->subject_code }})</option>
        @endforeach
      </select>
    </div>

    <!-- Assessments Table -->
    <div class="card">
      <h3 style="margin-bottom: 10px;">Student Grades</h3>
      <table>
        <thead>
          <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Prelim</th>
            <th>Midterm</th>
            <th>Semi-Final</th>
            <th>Final</th>
            <th>Term Grade</th>
            <th>Remarks</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="studentsTableBody"></tbody>
      </table>
    </div>

    <!-- Action Buttons -->
    <div class="actions">
      <button class="btn btn-submit" id="submitBtn" onclick="showSubmitModal()">Submit to Dean</button>
      <button class="btn btn-export">Export to Excel</button>
    </div>

    <p class="note">
      ⚠️ Once submitted, you can no longer edit the grades. Dean will review and approve/post.
    </p>
  </div>

  <!-- ===== Edit Modal ===== -->
  <div id="editModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeModal()">&times;</span>
      <h3>Edit Grades</h3>
      <form id="editForm">
        <input type="hidden" id="editStudentId">
        <label>Prelim:</label>
        <input type="number" id="editPrelim" min="0" max="100">
        <label>Midterm:</label>
        <input type="number" id="editMidterm" min="0" max="100">
        <label>Semi-Final:</label>
        <input type="number" id="editSemiFinal" min="0" max="100">
        <label>Final:</label>
        <input type="number" id="editFinal" min="0" max="100">
        <button type="submit">Update Grades</button>
      </form>
    </div>
  </div>

  <!-- ===== Submit Confirmation Modal ===== -->
  <div id="submitModal" class="modal">
    <div class="modal-content">
      <span class="close" onclick="closeSubmitModal()">&times;</span>
      <h3>Confirm Submission</h3>
      <p>Are you sure you want to submit the grades to the Dean? Once submitted, you cannot edit them anymore.</p>
      <button class="btn btn-submit" onclick="confirmSubmit()">Yes, Submit</button>
      <button class="btn btn-export" onclick="closeSubmitModal()">Cancel</button>
    </div>
  </div>

  <script>
    // Load students dynamically
    document.getElementById('subject').addEventListener('change', function() {
      const subjectId = this.value;
      const tbody = document.getElementById('studentsTableBody');
      tbody.innerHTML = '';

      if (!subjectId) return;

      fetch(`/teacher/Manages/${subjectId}/students`)
        .then(response => response.json())
        .then(data => {
          data.forEach(student => {
            const row = document.createElement('tr');
            const isEditable = student.status === 'draft' || student.status === 'saved';
            row.innerHTML = `
              <td>${student.id}</td>
              <td>${student.name}</td>
              <td><input type="number" class="grade-input" data-student-id="${student.id}" data-field="prelim" value="${student.prelim ?? ''}" ${isEditable ? '' : 'disabled'} /></td>
              <td><input type="number" class="grade-input" data-student-id="${student.id}" data-field="midterm" value="${student.midterm ?? ''}" ${isEditable ? '' : 'disabled'} /></td>
              <td><input type="number" class="grade-input" data-student-id="${student.id}" data-field="semi_final" value="${student.semi_final ?? ''}" ${isEditable ? '' : 'disabled'} /></td>
              <td><input type="number" class="grade-input" data-student-id="${student.id}" data-field="final" value="${student.final ?? ''}" ${isEditable ? '' : 'disabled'} /></td>
              <td>${student.term_grade ?? '-'}</td>
              <td>${student.remarks ?? '-'}</td>
              <td>
                <button class="btn btn-save" onclick="saveStudentGrades(${student.id})" ${isEditable ? '' : 'disabled'}>Save</button>
                <button class="btn btn-edit" onclick="openEditModal(${student.id})" ${isEditable ? '' : 'disabled'}>Edit</button>
              </td>
            `;
            tbody.appendChild(row);
          });
        })
        .catch(err => alert('Error loading students.'));
    });

    // Save student grades
    function saveStudentGrades(studentId) {
      const subjectId = document.getElementById('subject').value;
      const inputs = document.querySelectorAll(`.grade-input[data-student-id="${studentId}"]`);
      const grades = {};

      inputs.forEach(input => grades[input.dataset.field] = input.value || 0);

      fetch(`/teacher/Manages/${subjectId}/save-grades`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ grades: { [studentId]: grades } })
      })
      .then(res => res.json())
      .then(data => alert(data.success ? 'Grades saved successfully!' : (data.error || 'Error saving grades.')))
      .catch(() => alert('Error saving grades.'));
    }

    // Open Edit Modal
    function openEditModal(studentId) {
      const modal = document.getElementById('editModal');
      document.getElementById('editStudentId').value = studentId;

      // Fill modal with current values
      const prelimInput = document.querySelector(`.grade-input[data-student-id="${studentId}"][data-field="prelim"]`);
      if (prelimInput) document.getElementById('editPrelim').value = prelimInput.value;

      const midtermInput = document.querySelector(`.grade-input[data-student-id="${studentId}"][data-field="midterm"]`);
      if (midtermInput) document.getElementById('editMidterm').value = midtermInput.value;

      const semiFinalInput = document.querySelector(`.grade-input[data-student-id="${studentId}"][data-field="semi_final"]`);
      if (semiFinalInput) document.getElementById('editSemiFinal').value = semiFinalInput.value;

      const finalInput = document.querySelector(`.grade-input[data-student-id="${studentId}"][data-field="final"]`);
      if (finalInput) document.getElementById('editFinal').value = finalInput.value;

      modal.style.display = 'block';
    }

    // Close Modal
    function closeModal() {
      document.getElementById('editModal').style.display = 'none';
    }

    // Submit Edit Form
    document.getElementById('editForm').addEventListener('submit', e => {
      e.preventDefault();
      const studentId = document.getElementById('editStudentId').value;

      const prelimModal = document.getElementById('editPrelim');
      const prelimTable = document.querySelector(`.grade-input[data-student-id="${studentId}"][data-field="prelim"]`);
      if (prelimModal && prelimTable) prelimTable.value = prelimModal.value;

      const midtermModal = document.getElementById('editMidterm');
      const midtermTable = document.querySelector(`.grade-input[data-student-id="${studentId}"][data-field="midterm"]`);
      if (midtermModal && midtermTable) midtermTable.value = midtermModal.value;

      const semiFinalModal = document.getElementById('editSemiFinal');
      const semiFinalTable = document.querySelector(`.grade-input[data-student-id="${studentId}"][data-field="semi_final"]`);
      if (semiFinalModal && semiFinalTable) semiFinalTable.value = semiFinalModal.value;

      const finalModal = document.getElementById('editFinal');
      const finalTable = document.querySelector(`.grade-input[data-student-id="${studentId}"][data-field="final"]`);
      if (finalModal && finalTable) finalTable.value = finalModal.value;

      alert('Grade update submitted for approval!');
      closeModal();
    });

    window.onclick = function(event) {
      const editModal = document.getElementById('editModal');
      const submitModal = document.getElementById('submitModal');
      if (event.target === editModal) editModal.style.display = 'none';
      if (event.target === submitModal) submitModal.style.display = 'none';
    }

    // Show Submit Modal
    function showSubmitModal() {
      const subjectId = document.getElementById('subject').value;
      if (!subjectId) {
        alert('Please select a subject.');
        return;
      }
      document.getElementById('submitModal').style.display = 'block';
    }

    // Close Submit Modal
    function closeSubmitModal() {
      document.getElementById('submitModal').style.display = 'none';
    }

    // Confirm Submit
    function confirmSubmit() {
      closeSubmitModal();
      submitToDean();
    }

    // Submit to Dean
    function submitToDean() {
      const subjectId = document.getElementById('subject').value;

      // Submit the grades
      fetch(`/teacher/Manages/${subjectId}/submit-grades`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert(data.message);
          // Reload students to reflect status change
          document.getElementById('subject').dispatchEvent(new Event('change'));
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
