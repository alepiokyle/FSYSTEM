<x-dean-component>
  <style>
    .page-container {
      background: #f9f9fc;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    h2 {
      margin-bottom: 20px;
      font-size: 22px;
      color: #2c3e50;
    }

    .filters {
      display: flex;
      gap: 15px;
      margin-bottom: 20px;
    }

    .filters select {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 8px;
      flex: 1;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 25px;
    }

    th, td {
      padding: 12px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }

    th {
      background: #34495e;
      color: white;
    }

    .btn {
      padding: 8px 12px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      color: white;
    }

    .btn-approve {
      background: #27ae60;
    }

    .btn-reject {
      background: #e74c3c;
    }

    .btn-approve:hover {
      background: #2ecc71;
    }

    .btn-reject:hover {
      background: #c0392b;
    }

    .section-title {
      margin: 25px 0 15px;
      font-size: 18px;
      color: #2c3e50;
    }
  </style>

  <div class="page-container">
    <h2>Approved Grades</h2>

    <!-- Filters -->
    <div class="filters">
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
        <option>Math 101</option>
        <option>English 201</option>
        <option>Science 301</option>
      </select>
    </div>

    <!-- Pending Grades Table -->
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
          <td>88</td>
          <td>90</td>
          <td>85</td>
          <td>92</td>
          <td>Pending</td>
          <td>
            <button class="btn btn-approve">Approve</button>
            <button class="btn btn-reject">Reject</button>
          </td>
        </tr>
        <tr>
          <td>Maria Santos</td>
          <td>91</td>
          <td>87</td>
          <td>89</td>
          <td>94</td>
          <td>Pending</td>
          <td>
            <button class="btn btn-approve">Approve</button>
            <button class="btn btn-reject">Reject</button>
          </td>
        </tr>
      </tbody>
    </table>

    <!-- Approved Grades History -->
    <h3 class="section-title">Already Approved Grades</h3>
    <table>
      <thead>
        <tr>
          <th>Student Name</th>
          <th>Prelim</th>
          <th>Midterm</th>
          <th>Semi-Final</th>
          <th>Final</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Carlos Reyes</td>
          <td>85</td>
          <td>88</td>
          <td>90</td>
          <td>89</td>
          <td>Approved</td>
        </tr>
        <tr>
          <td>Ana Lopez</td>
          <td>92</td>
          <td>91</td>
          <td>94</td>
          <td>93</td>
          <td>Approved</td>
        </tr>
      </tbody>
    </table>
  </div>
</x-dean-component>
