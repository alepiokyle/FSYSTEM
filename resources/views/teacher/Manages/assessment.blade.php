<x-teacher-component>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Assessments - Teacher Dashboard</title>
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
    select {
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
      padding: 8px 14px;
      border: none;
      border-radius: 8px;
      font-size: 14px;
      cursor: pointer;
      margin-right: 8px;
    }
    .btn-edit { background: #ff9800; color: #fff; }
    .btn-submit { background: #4CAF50; color: #fff; }
    .btn-export { background: #007bff; color: #fff; }
    .btn:hover { opacity: 0.9; }

    /* Modal */
    .modal {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }
    .modal-content {
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      width: 700px; /* wider */
      max-width: 95%;
      position: relative;
      animation: fadeIn 0.3s ease;
    }
    .modal-content h3 {
      margin-bottom: 15px;
    }

    /* Two-column form layout */
    .modal-form {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 15px 20px;
    }
    .modal-form label {
      font-weight: bold;
      font-size: 14px;
    }
    .modal-form input {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
    }
    .form-actions {
      grid-column: span 2;
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }
    .btn-cancel {
      background: #ccc; 
      color: #333; 
      padding: 8px 12px; 
      border-radius: 6px; 
      cursor: pointer;
    }
    .btn-save {
      background: #4CAF50; 
      color: white; 
      padding: 8px 12px; 
      border-radius: 6px; 
      cursor: pointer;
    }
    .close-btn {
      position: absolute;
      top: 10px; right: 15px;
      cursor: pointer;
      font-size: 18px;
      font-weight: bold;
      color: #555;
    }
    .close-btn:hover { color: red; }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Manage Assessments</h1>

    <!-- Subject Selector -->
    <div class="card">
      <label for="subject">Select Subject</label>
      <select id="subject">
        <option value="">-- Choose Subject --</option>
        <option>Math 101</option>
        <option>English 102</option>
        <option>Science 103</option>
      </select>
    </div>

    <!-- Assessments Table -->
    <div class="card">
      <h3>Student Grades</h3>
      <table>
        <thead>
          <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Quizzes</th>
            <th>Exams</th>
            <th>Prelim</th>
            <th>Midterm</th>
            <th>Semi-Final</th>
            <th>Final</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>2025-001</td>
            <td>Juan Dela Cruz</td>
            <td>85</td>
            <td>90</td>
            <td>88</td>
            <td>87</td>
            <td>89</td>
            <td>90</td>
            <td>
              <button class="btn btn-edit" onclick="openEditModal('Juan Dela Cruz',85,90,88,87,89,90)">Edit</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Action Buttons -->
    <div>
      <button class="btn btn-submit">Submit to Dean</button>
      <button class="btn btn-export">Export to Excel</button>
    </div>

    <p style="color: red; margin-top: 10px; font-size: 14px;">
      ⚠️ Once submitted, you can no longer edit the grades. Dean will review and approve/post.
    </p>
  </div>

  <!-- Modal -->
  <div class="modal" id="editGradesModal">
    <div class="modal-content">
      <span class="close-btn" onclick="closeEditModal()">&times;</span>
      <h3>Edit Grades</h3>

      <div class="modal-form">
        <div>
          <label>Student Name</label>
          <input type="text" id="studentName" readonly />
        </div>
        <div>
          <label>Quizzes</label>
          <input type="number" id="editQuizzes" />
        </div>
        <div>
          <label>Exams</label>
          <input type="number" id="editExams" />
        </div>
        <div>
          <label>Prelim</label>
          <input type="number" id="editPrelim" />
        </div>
        <div>
          <label>Midterm</label>
          <input type="number" id="editMidterm" />
        </div>
        <div>
          <label>Semi-Final</label>
          <input type="number" id="editSemiFinal" />
        </div>
        <div>
          <label>Final</label>
          <input type="number" id="editFinal" />
        </div>

        <div class="form-actions">
          <button type="button" class="btn-cancel" onclick="closeEditModal()">Cancel</button>
          <button type="button" class="btn-save" onclick="saveChanges()">Save Changes</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Open Modal
    function openEditModal(name, quizzes, exams, prelim, midterm, semiFinal, final) {
      document.getElementById("studentName").value = name;
      document.getElementById("editQuizzes").value = quizzes;
      document.getElementById("editExams").value = exams;
      document.getElementById("editPrelim").value = prelim;
      document.getElementById("editMidterm").value = midterm;
      document.getElementById("editSemiFinal").value = semiFinal;
      document.getElementById("editFinal").value = final;

      document.getElementById("editGradesModal").style.display = "flex";
    }

    // Close Modal
    function closeEditModal() {
      document.getElementById("editGradesModal").style.display = "none";
    }

    // Save Changes (demo only)
    function saveChanges() {
      alert("Grades updated successfully (demo only, not saved to database).");
      closeEditModal();
    }
  </script>
</body>
</html>
</x-teacher-component>
