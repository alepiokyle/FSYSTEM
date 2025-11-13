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

    .btn-save { background: #4CAF50; color: white; }
    .btn-edit { background: #f39c12; color: white; }
    .btn-submit { background: #007bff; color: white; }
    .btn-export { background: #6c757d; color: white; }
    .btn-compute { background: #1e3a8a; color: #fff; }

    .note {
      font-size: 13px;
      color: #333;
      margin-top: 10px;
    }

    .actions { margin-top: 10px; }

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
      justify-content: center;
      align-items: center;
    }

    .modal-content {
      background-color: #fff;
      margin: 8% auto;
      padding: 20px;
      border-radius: 10px;
      width: 400px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.3);
      position: relative;
      animation: pop 0.3s ease;
    }

    @keyframes pop {
      from { transform: scale(0.9); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }

    .close {
      color: #aaa;
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 22px;
      cursor: pointer;
    }

    .close:hover { color: #000; }

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

    .modal-content button:hover { background: #1f2b32; }

    #computeResult {
      background: #f1f5ff;
      padding: 10px;
      border-radius: 8px;
      text-align: center;
      margin-top: 15px;
      font-weight: 600;
    }

    /* ===== Landscape Modal ===== */
    .modal-content.landscape {
      width: 450px;
      margin-top: 4%;
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      align-items: flex-start;
      gap: 15px;
    }

    .modal-content.landscape .left,
    .modal-content.landscape .right {
      width: 47%;
    }

    .modal-content.landscape .right {
      background: #f8f9ff;
      padding: 12px;
      border-radius: 8px;
      min-height: 250px;
    }
  </style>
</head>

<body>
  <header>
    <h1>Manage Assessments</h1>
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

    <div class="actions">
      <button class="btn btn-submit" id="submitBtn" onclick="showSubmitModal()">Submit to Dean</button>
      <button class="btn btn-export">Export to Excel</button>
      <button class="btn btn-compute" onclick="openComputeModal()">Term-Based Grading Computation</button>
   
    

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

  <!-- ===== Compute Grade Modal (Landscape) ===== -->
  <div id="computeModal" class="modal">
    <div class="modal-content landscape">
      <span class="close" onclick="closeComputeModal()">&times;</span>

      <div class="left">
        <h3>Compute Term Grade</h3>
        <form id="computeForm">
          <label>Prelim (20%)</label>
          <input type="number" id="prelim" min="0" max="100" required>
          <label>Midterm (30%)</label>
          <input type="number" id="midterm" min="0" max="100" required>
          <label>Semi-Final (20%)</label>
          <input type="number" id="semi" min="0" max="100" required>
          <label>Final (30%)</label>
          <input type="number" id="final" min="0" max="100" required>
          <button type="submit">Compute</button>
        </form>
      </div>

      <div class="right">
        <!-- Toggle Button -->
        <div style="display: flex; align-items: center; justify-content: space-between; cursor: pointer; user-select: none;" onclick="toggleFormulaNote()">
          <strong>▼ Term-Based Grading Computation</strong>
          <span id="arrowIcon" style="font-size: 18px;">▼</span>
        </div>

        <!-- Hidden Note -->
        <div id="formulaNote" class="note" style="background:#f1f3f5; padding:10px; border-radius:6px; font-size:13px; color:#333; margin-top: 30px;">
          Final Grade = (Prelim × 20%) + (Midterm × 30%) + (Semi-Final × 20%) + (Final × 30%)<br>
          Example: (85 × 0.20) + (90 × 0.30) + (80 × 0.20) + (88 × 0.30) = <strong>85.4</strong><br>
          <em>Remarks:</em> “PASSED” if Final Grade ≥ 75, otherwise “FAILED”.
        </div>

        <div id="computeResult"></div>
      </div>
    </div>
  </div>

  <script>
    // ===== Toggle Note Section =====
    function toggleFormulaNote() {
      const note = document.getElementById("formulaNote");
      const arrow = document.getElementById("arrowIcon");
      if (note.style.display === "none" || note.style.display === "") {
        note.style.display = "block";
        arrow.textContent = "▼";
      } else {
        note.style.display = "none";
        arrow.textContent = "▶";
      }
    }

    // ===== Load Students =====
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
              <td>${student.name || 'N/A'}</td>
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
        .catch(() => alert('Error loading students.'));
    });

    // ===== Save Grades =====
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

    // ===== Edit Modal =====
    function openEditModal(studentId) {
      const modal = document.getElementById('editModal');
      document.getElementById('editStudentId').value = studentId;
      document.getElementById('editPrelim').value = document.querySelector(`.grade-input[data-student-id="${studentId}"][data-field="prelim"]`).value;
      document.getElementById('editMidterm').value = document.querySelector(`.grade-input[data-student-id="${studentId}"][data-field="midterm"]`).value;
      document.getElementById('editSemiFinal').value = document.querySelector(`.grade-input[data-student-id="${studentId}"][data-field="semi_final"]`).value;
      document.getElementById('editFinal').value = document.querySelector(`.grade-input[data-student-id="${studentId}"][data-field="final"]`).value;
      modal.style.display = 'flex';
    }

    function closeModal() { document.getElementById('editModal').style.display = 'none'; }

    document.getElementById('editForm').addEventListener('submit', e => {
      e.preventDefault();
      const id = document.getElementById('editStudentId').value;
      ['prelim', 'midterm', 'semi_final', 'final'].forEach(field => {
        const modalVal = document.getElementById('edit' + field.charAt(0).toUpperCase() + field.slice(1));
        const tableVal = document.querySelector(`.grade-input[data-student-id="${id}"][data-field="${field}"]`);
        if (modalVal && tableVal) tableVal.value = modalVal.value;
      });
      alert('Grade update submitted!');
      closeModal();
    });

    // ===== Submit to Dean =====
    function showSubmitModal() { document.getElementById('submitModal').style.display = 'flex'; }
    function closeSubmitModal() { document.getElementById('submitModal').style.display = 'none'; }
    function confirmSubmit() { closeSubmitModal(); submitToDean(); }

    function submitToDean() {
      const subjectId = document.getElementById('subject').value;
      fetch(`/teacher/Manages/${subjectId}/submit-grades`, {
        method: 'POST',
        headers: { 
          'Content-Type': 'application/json', 
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
        }
      })
      .then(res => res.json())
      .then(data => {
        alert(data.success ? data.message : data.error);
        document.getElementById('subject').dispatchEvent(new Event('change'));
      });
    }

    // ===== Compute Modal =====
    const computeModal = document.getElementById("computeModal");

    function openComputeModal() { computeModal.style.display = "flex"; }
    function closeComputeModal() {
      computeModal.style.display = "none";
      document.getElementById("computeResult").innerHTML = "";
      document.getElementById("computeForm").reset();
    }

    window.onclick = function(e) {
      if (e.target === computeModal) closeComputeModal();
    }

    document.getElementById("computeForm").addEventListener("submit", function(e) {
      e.preventDefault();
      const prelim = parseFloat(document.getElementById("prelim").value);
      const midterm = parseFloat(document.getElementById("midterm").value);
      const semi = parseFloat(document.getElementById("semi").value);
      const final = parseFloat(document.getElementById("final").value);
      const grade = (prelim * 0.2) + (midterm * 0.3) + (semi * 0.2) + (final * 0.3);
      const remark = grade >= 75 ? "PASSED ✅" : "FAILED ❌";
      document.getElementById("computeResult").innerHTML = `
        <p>Final Grade: <b>${grade.toFixed(2)}</b><br>Remarks: <b>${remark}</b></p>
      `;
    });
  </script>
</body>
</html>
</x-teacher-component>
