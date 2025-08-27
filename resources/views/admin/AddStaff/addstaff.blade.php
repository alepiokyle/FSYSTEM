<x-admin-component>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Add Staff</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f5f6fa;
      margin: 0;
      padding: 20px;
    }

    .card {
      background: #fff;
      border-radius: 12px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      max-width: 1000px;
      margin: auto;
      position: relative;
    }

    .card h2 {
      margin: 0 0 20px;
      font-size: 22px;
      color: #333;
    }

    .add-btn {
      position: absolute;
      top: 20px;
      right: 20px;
      background: none;
      color: #333;
      border: 1px solid #ccc;
      border-radius: 6px;
      padding: 8px 12px;
      display: flex;
      align-items: center;
      cursor: pointer;
      font-size: 14px;
      transition: background 0.3s ease, border-color 0.3s ease;
    }
    .add-btn:hover {
      background: #f0f0f0;
      border-color: #999;
    }
    .add-btn i {
      margin-right: 6px;
      font-size: 16px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }

    table th, table td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    table th {
      background: #f0f0f0;
      color: #333;
    }

    .status-active {
      color: green;
      font-weight: bold;
    }
    .status-inactive {
      color: red;
      font-weight: bold;
    }

    .actions button {
      margin-right: 5px;
      padding: 5px 10px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 13px;
    }
    .actions .edit { background: #2196F3; color: white; }
    .actions .suspend { background: #ff9800; color: white; }
    .actions .delete { background: #f44336; color: white; }

    /* Modal */
    .modal {
      display: none;
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
      justify-content: center;
      align-items: center;
    }
    .modal-content {
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      width: 400px;
      position: relative;
      animation: fadeIn 0.3s ease;
    }
    .modal-content h3 {
      margin: 0 0 15px;
    }
    .modal-content label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
      font-size: 14px;
    }
    .modal-content input, 
    .modal-content select {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ddd;
      border-radius: 6px;
    }
    .modal-content .form-actions {
      display: flex;
      justify-content: space-between;
      margin-top: 15px;
    }
    .modal-content button {
      padding: 10px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }
    .btn-cancel { background: #ccc; color: #333; }
    .btn-cancel:hover { background: #bbb; }
    .btn-create { background: #4CAF50; color: white; }
    .btn-create:hover { background: #45a049; }

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
  <script>
    function openModal() {
      document.getElementById("addStaffModal").style.display = "flex";
    }
    function closeModal() {
      document.getElementById("addStaffModal").style.display = "none";
    }

    function toggleDepartment() {
      const role = document.getElementById("role").value;
      const deptRow = document.getElementById("departmentRow");
      if(role === "Teacher") {
        deptRow.style.display = "block";
      } else {
        deptRow.style.display = "none";
      }
    }
  </script>
</head>
<body>

  <div class="card">
    <h2>Staff Accounts (Deans & Teachers)</h2>
    <button class="add-btn" onclick="openModal()">
      <i class="fas fa-user-plus"></i> Add Staff
    </button>

    <table>
      <thead>
        <tr>
          <th>Staff ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Role</th>
          <th>Department</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>STF-001</td>
          <td>Dr. Ana Reyes</td>
          <td>ana.reyes@email.com</td>
          <td>Dean</td>
          <td>Business Administration</td>
          <td><span class="status-active">Active</span></td>
          <td class="actions">
            <button class="edit">Edit</button>
            <button class="suspend">Suspend</button>
            <button class="delete">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Modal -->
  <div class="modal" id="addStaffModal">
    <div class="modal-content">
      <span class="close-btn" onclick="closeModal()">&times;</span>
      <h3>Create Dean / Teacher Account</h3>

      <label for="name">Full Name</label>
      <input type="text" id="name" placeholder="Enter full name">

      <label for="email">Email</label>
      <input type="email" id="email" placeholder="Enter email">

      <label for="role">Role</label>
      <select id="role" onchange="toggleDepartment()">
        <option value="Dean">Dean</option>
        <option value="Teacher">Teacher</option>
      </select>

      <div id="departmentRow" style="display:none;">
        <label for="department">Department</label>
        <select id="department">
          <option value="IT">Information Technology</option>
          <option value="Education">Education</option>
          <option value="Business">Business Administration</option>
          <option value="Engineering">Engineering</option>
        </select>
      </div>

      <label for="password">Password</label>
      <input type="password" id="password" placeholder="Enter password">

      <div class="form-actions">
        <button type="button" class="btn-cancel" onclick="closeModal()">Cancel</button>
        <button type="button" class="btn-create">Create Account</button>
      </div>
    </div>
  </div>

</body>
</html>
</x-admin-component>
