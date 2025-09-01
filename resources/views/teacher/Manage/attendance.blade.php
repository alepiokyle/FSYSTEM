<x-teacher-component>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Manage Attendance - Teacher Dashboard</title>
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
    select, input[type="date"] {
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
      padding: 10px 18px;
      border: none;
      border-radius: 8px;
      font-size: 14px;
      cursor: pointer;
      margin-right: 10px;
    }
    .btn-save {
      background: #4CAF50;
      color: #fff;
    }
    .btn-view {
      background: #007bff;
      color: #fff;
    }
    .btn:hover {
      opacity: 0.9;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Manage Attendance</h1>

    <!-- Select Class & Date -->
    <div class="card">
      <label for="subject">Select Subject / Class</label>
      <select id="subject">
        <option value="">-- Choose Subject --</option>
        <option>Math 101 - Section A</option>
        <option>Science 202 - Section B</option>
        <option>English 303 - Section C</option>
      </select>

      <label for="date">Select Date</label>
      <input type="date" id="date" />
    </div>

    <!-- Attendance Table -->
    <div class="card">
      <h3>Student List</h3>
      <table>
        <thead>
          <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>2025001</td>
            <td>Juan Dela Cruz</td>
            <td>
              <select>
                <option>Present</option>
                <option>Absent</option>
                <option>Late</option>
                <option>Excused</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>2025002</td>
            <td>Maria Santos</td>
            <td>
              <select>
                <option>Present</option>
                <option>Absent</option>
                <option>Late</option>
                <option>Excused</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>2025003</td>
            <td>Pedro Reyes</td>
            <td>
              <select>
                <option>Present</option>
                <option>Absent</option>
                <option>Late</option>
                <option>Excused</option>
              </select>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Action Buttons -->
    <div>
      <button class="btn btn-save">Save Attendance</button>
      <button class="btn btn-view">View Past Records</button>
    </div>
  </div>
</body>
</html>
</x-teacher-component>
