<x-admin-component>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard - View Grades</title>
  <style>
    /* ====== General Layout ====== */
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #e6e9ec 0%, #f4f6f7 100%);
        color: #333;
        min-height: 100vh;
        display: flex;
    }

    /* Sidebar */
    .sidebar {
        width: 260px;
        background: rgba(255,255,255,0.8);
        backdrop-filter: blur(12px);
        border-right: 1px solid rgba(255,255,255,0.5);
        box-shadow: 2px 0 12px rgba(0,0,0,0.08);
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        padding: 20px;
    }

    .sidebar h2 {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 25px;
        color: #007bff;
        text-align: center;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar ul li {
        margin-bottom: 15px;
    }

    .sidebar ul li a {
        display: block;
        padding: 12px 16px;
        border-radius: 10px;
        color: #333;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .sidebar ul li a:hover,
    .sidebar ul li a.active {
        background: rgba(0,123,255,0.15);
        color: #007bff;
    }

    /* Content Area */
    .content {
        margin-left: 260px;
        padding: 30px;
        flex: 1;

        /* Centering */
        display: flex;
        justify-content: center;  
        align-items: center;      
        min-height: 100vh;
    }

    /* ====== Glass Card ====== */
    .glass-card {
        background: rgba(255,255,255,0.7);
        backdrop-filter: blur(15px);
        border-radius: 20px;
        padding: 25px;
        border: 1px solid rgba(255,255,255,0.4);
        box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        max-width: 900px;
        width: 100%;
    }

    .glass-card h2 {
        margin-bottom: 15px;
        font-size: 20px;
        font-weight: bold;
    }

    /* Table */
    .glass-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        color: #333;
    }

    .glass-table thead {
        background: rgba(255,255,255,0.6);
    }

    .glass-table th, .glass-table td {
        padding: 12px;
        border-bottom: 1px solid rgba(200,200,200,0.3);
        text-align: left;
    }

    .glass-table tbody tr {
        background: rgba(255,255,255,0.45);
    }

    .status-approved { color: #2ecc71; font-weight: bold; }
    .status-pending { color: #e67e22; font-weight: bold; }
  </style>
</head>
<body>

  <!-- ====== Sidebar ====== -->
  <div class="sidebar">
      <h2>⚙️ Admin Panel</h2>
      <ul>
          <li><a href="#">📚 Upload Subjects</a></li>
          <li><a href="#">📅 School Year & Semester</a></li>
          <li><a href="#" class="active">📖 View Student Grades</a></li>
          <li><a href="#">👩‍🏫 Teacher Accounts</a></li>
          <li><a href="#">🎓 Student Accounts</a></li>
          <li><a href="#">👨‍👩‍👧 Parent Accounts</a></li>
      </ul>
  </div>

  <!-- ====== Content ====== -->
  <div class="content">
      <div class="glass-card">
          <h2>📖 Student Grades (Approved by Dean)</h2>
          <p class="text-muted">Below are sample records. Only approved grades should appear here.</p>

          <div class="table-responsive">
              <table class="glass-table">
                  <thead>
                      <tr>
                          <th>Student Name</th>
                          <th>Subject</th>
                          <th>Prelim</th>
                          <th>Midterm</th>
                          <th>Semi-Final</th>
                          <th>Final</th>
                          <th>Final Grade</th>
                          <th>Status</th>
                      </tr>
                  </thead>
                  <tbody>
                      <tr>
                          <td>Juan Dela Cruz</td>
                          <td>Introduction to Programming</td>
                          <td>85</td>
                          <td>88</td>
                          <td>90</td>
                          <td>92</td>
                          <td><strong>89</strong></td>
                          <td><span class="status-approved">Approved</span></td>
                      </tr>
                      <tr>
                          <td>Maria Santos</td>
                          <td>Business Management</td>
                          <td>80</td>
                          <td>82</td>
                          <td>85</td>
                          <td>87</td>
                          <td><strong>84</strong></td>
                          <td><span class="status-approved">Approved</span></td>
                      </tr>
                      <tr>
                          <td>Carlos Reyes</td>
                          <td>Mathematics</td>
                          <td>70</td>
                          <td>75</td>
                          <td>78</td>
                          <td>80</td>
                          <td><strong>76</strong></td>
                          <td><span class="status-pending">Pending</span></td>
                      </tr>
                  </tbody>
              </table>
          </div>
      </div>
  </div>

</body>
</html>
</x-admin-component>
