<x-dean-component>
  <style>
    .card {
      background: #fff;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    h2 {
      color: #333;
      margin-bottom: 15px;
    }
    select, button {
      padding: 8px 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      margin-right: 10px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 10px;
      text-align: center;
    }
    th {
      background: #f4f4f4;
    }
    .btn-post {
      background: #28a745;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 6px;
      cursor: pointer;
    }
    .btn-post:hover {
      background: #218838;
    }
  </style>

  <div class="card">
    <h2>Post Grades</h2>

    <!-- Filters -->
    <div>
      <select>
        <option>Select School Year</option>
        <option>2024-2025</option>
        <option>2025-2026</option>
      </select>
      <select>
        <option>Select Semester</option>
        <option>1st Semester</option>
        <option>2nd Semester</option>
      </select>
      <select>
        <option>Select Subject</option>
        <option>IT 101 - Intro to Programming</option>
        <option>Math 201 - Calculus</option>
      </select>
      <select>
        <option>Select Section</option>
        <option>BSIT 1A</option>
        <option>BSIT 2B</option>
      </select>
    </div>

    <!-- Approved Grades ready to be posted -->
    <table>
      <thead>
        <tr>
          <th>Student Name</th>
          <th>Prelim</th>
          <th>Midterm</th>
          <th>Semi-Final</th>
          <th>Final</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Juan Dela Cruz</td>
          <td>85</td>
          <td>87</td>
          <td>89</td>
          <td>90</td>
          <td>Approved</td>
          <td><button class="btn-post">Post</button></td>
        </tr>
        <tr>
          <td>Maria Santos</td>
          <td>88</td>
          <td>90</td>
          <td>92</td>
          <td>95</td>
          <td>Approved</td>
          <td><button class="btn-post">Post</button></td>
        </tr>
      </tbody>
    </table>
  </div>
</x-dean-component>
