<x-dean-component>
  <div class="subject-loading">
    <!-- Page Title -->
    <h2 class="page-title">📘 Subject Loading</h2>

    <!-- Subject Loading Form -->
    <div class="card">
      <h3>Load Students to Subject</h3>
      <form>
        <div class="form-group">
          <label for="department">Department:</label>
          <select id="department" name="department">
            <option value="">-- Select Department --</option>
            <option value="BSIT">BSIT</option>
            <option value="BSED">BSED</option>
            <option value="BEED">BEED</option>
          </select>
        </div>

        <div class="form-group">
          <label for="yearLevel">Year Level & Section:</label>
          <select id="yearLevel" name="yearLevel">
            <option value="">-- Select Year & Section --</option>
            <option value="1A">1st Year - Section A</option>
            <option value="1B">1st Year - Section B</option>
            <option value="2A">2nd Year - Section A</option>
          </select>
        </div>

        <div class="form-group">
          <label for="subject">Subject:</label>
          <select id="subject" name="subject">
            <option value="">-- Select Subject --</option>
            <option value="IT101">IT101 - Intro to Computing</option>
            <option value="IT102">IT102 - Programming Fundamentals</option>
            <option value="ENG101">ENG101 - Communication Skills</option>
          </select>
        </div>

        <div class="form-group">
          <label for="students">Select Students:</label>
          <select id="students" name="students" multiple>
            <option value="1001">Juan Dela Cruz</option>
            <option value="1002">Maria Santos</option>
            <option value="1003">Pedro Reyes</option>
            <option value="1004">Ana Dizon</option>
          </select>
          <small>Hold CTRL (Windows) or CMD (Mac) to select multiple students.</small>
        </div>

        <button type="submit" class="btn">➕ Load Students</button>
      </form>
    </div>

    <!-- Current Loaded Students Table -->
    <div class="card">
      <h3>📋 Currently Loaded Students</h3>
      <table>
        <thead>
          <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Subject</th>
            <th>Year & Section</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1001</td>
            <td>Juan Dela Cruz</td>
            <td>IT101 - Intro to Computing</td>
            <td>1st Year - Section A</td>
            <td><button class="btn-danger">❌ Remove</button></td>
          </tr>
          <tr>
            <td>1002</td>
            <td>Maria Santos</td>
            <td>IT101 - Intro to Computing</td>
            <td>1st Year - Section A</td>
            <td><button class="btn-danger">❌ Remove</button></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <style>
    .subject-loading {
      padding: 20px;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .page-title {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 15px;
      color: #2c3e50;
    }

    .card {
      background: #fff;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 12px;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
    }

    .card h3 {
      margin-bottom: 15px;
      font-size: 18px;
      color: #34495e;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      font-weight: 600;
      display: block;
      margin-bottom: 5px;
      color: #2c3e50;
    }

    select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ddd;
      border-radius: 6px;
      font-size: 14px;
    }

    small {
      font-size: 12px;
      color: #7f8c8d;
    }

    .btn {
      background: #3498db;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.3s;
    }

    .btn:hover {
      background: #2980b9;
    }

    .btn-danger {
      background: #e74c3c;
      color: white;
      border: none;
      padding: 6px 10px;
      border-radius: 6px;
      cursor: pointer;
    }

    .btn-danger:hover {
      background: #c0392b;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    table th, table td {
      padding: 12px;
      border-bottom: 1px solid #ddd;
      text-align: left;
    }

    table th {
      background: #f8f9fa;
    }
  </style>
</x-dean-component>
