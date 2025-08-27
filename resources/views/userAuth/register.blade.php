<x-admin-component>

<style>
  body { font-family: Arial, sans-serif; background: #f5f6fa; margin: 0; padding: 20px; }

  .card { background: #fff; border-radius: 12px; padding: 20px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); max-width: 1000px; margin: auto; position: relative; }

  .card h2 { margin: 0 0 20px; font-size: 22px; color: #333; }

  .add-btn {
    position: absolute; top: 20px; right: 20px;
    background: none; color: #333; border: 1px solid #ccc; border-radius: 6px;
    padding: 8px 12px; display: flex; align-items: center; cursor: pointer; font-size: 14px;
  }
  .add-btn:hover { background: #f0f0f0; border-color: #999; }
  .add-btn i { margin-right: 6px; font-size: 16px; }

  table { width: 100%; border-collapse: collapse; margin-top: 15px; }
  table th, table td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
  table th { background: #f0f0f0; color: #333; }

  .status-active { color: green; font-weight: bold; }
  .status-inactive { color: red; font-weight: bold; }

  /* Actions container for buttons in a row */
  .actions {
    display: flex;
    gap: 5px;
  }
  .actions button { padding: 5px 10px; border: none; border-radius: 6px; cursor: pointer; font-size: 13px; }
  .actions .edit { background: #2196F3; color: white; }
  .actions .suspend { background: #ff9800; color: white; }
  .actions .delete { background: #f44336; color: white; }

  /* Modal */
  .modal { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); justify-content: center; align-items: center; }
  .modal-content { background: #fff; padding: 20px; border-radius: 12px; width: 400px; position: relative; }
  .modal-content h3 { margin: 0 0 15px; }
  .modal-content label { display: block; margin-top: 10px; font-weight: bold; font-size: 14px; }
  .modal-content input, .modal-content select { width: 100%; padding: 8px; margin-top: 5px; border: 1px solid #ddd; border-radius: 6px; }
  .modal-content button { margin-top: 15px; background: #4CAF50; color: white; border: none; padding: 10px; border-radius: 6px; cursor: pointer; width: 100%; }
  .modal-content button:hover { background: #45a049; }

  .close-btn { position: absolute; top: 10px; right: 15px; cursor: pointer; font-size: 18px; font-weight: bold; color: #555; }
  .close-btn:hover { color: red; }
</style>
<script>
function openModal() { 
  document.getElementById("addStaffModal").style.display = "flex"; 
  generatePassword(); // Auto-generate password when modal opens
}
function closeModal() { document.getElementById("addStaffModal").style.display = "none"; }

// Auto-generate password
function generatePassword(length = 10) {
  const chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+";
  let password = "";
  for (let i=0; i<length; i++) {
    password += chars.charAt(Math.floor(Math.random() * chars.length));
  }
  document.getElementById("password").value = password;
}

// Handle form submission
function saveStaff() {
  const name = document.getElementById("name").value;
  const email = document.getElementById("email").value;
  const role = document.getElementById("role").value;
  const department = document.getElementById("department").value;
  const password = document.getElementById("password").value;

  if(!name || !email || !role || !password) {
    alert("Please fill all required fields.");
    return;
  }

  // Add staff to table (only for display, in real app save to DB)
  const tbody = document.querySelector("table tbody");
  const row = tbody.insertRow();
  row.innerHTML = `
    <td>STF-${tbody.rows.length.toString().padStart(3,'0')}</td>
    <td>${name}</td>
    <td>${email}</td>
    <td>${role}</td>
    <td>${department}</td>
    <td><span class="status-active">Active</span></td>
    <td class="actions">
      <button class="edit">Edit</button>
      <button class="suspend">Suspend</button>
      <button class="delete">Delete</button>
    </td>
  `;

  alert(`Staff created! Password: ${password}`);
  closeModal();
  document.getElementById("addStaffForm").reset();
  document.getElementById("password").value = "";
}
</script>
</head>
<body>

<div class="card">
  <h2>Staff Accounts (Deans & Teachers)</h2>
  <button class="add-btn" onclick="openModal()"><i class="fas fa-user-plus"></i> Add Staff</button>

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

    <form id="addStaffForm" onsubmit="event.preventDefault(); saveStaff();">
      <label for="name">Full Name</label>
      <input type="text" id="name" placeholder="Enter full name" required>

      <label for="email">Email</label>
      <input type="email" id="email" placeholder="Enter email" required>

      <label for="role">Role</label>
      <select id="role" required>
        <option value="Dean">Dean</option>
        <option value="Teacher">Teacher</option>
      </select>

      <label for="department">Department</label>
      <select id="department" required>
        <option value="IT">Information Technology</option>
        <option value="Education">Education</option>
        <option value="Business">Business Administration</option>
        <option value="Engineering">Engineering</option>
      </select>

      <label for="password">Password</label>
      <div style="display:flex; gap:8px;">
        <input type="text" id="password" placeholder="Generated password" readonly required>
        <button type="button" onclick="generatePassword()">Generate</button>
      </div>

      <button type="submit">Create Account</button>
    </form>
  </div>
</div>

</body>
</html>
</x-admin-component>
