<x-dean-component>
    <style>
        /* ====== Background & Page ====== */
        x-dean-component {
            background: linear-gradient(to right, #f0f4f8, #ffffff);
            min-height: 100vh;
            padding: 20px 30px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: block;
        }

        /* ====== Page Header ====== */
        .page-header { margin-bottom: 30px; }
        .page-header-title h5 { font-weight: 700; font-size: 1.8rem; color: #222; }
        .breadcrumb { padding: 0; margin-top: 5px; background: transparent; }
        .breadcrumb-item a { text-decoration: none; color: #555; }
        .breadcrumb-item a:hover { text-decoration: underline; }

        /* ====== Cards ====== */
        .card {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
            margin-bottom: 25px;
        }
        .card:hover { transform: translateY(-5px); box-shadow: 0 12px 24px rgba(0,0,0,0.12); }
        .card h4, .card h6 { font-weight: 600; margin-bottom: 15px; }

        /* Table */
        .table th {
            background: #f8f9fa;
        }
    </style>

    <!-- ====== Page Header ====== -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title"><h5>Dean Dashboard</h5></div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item" aria-current="page">Subject Loading</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

 <!-- ====== Uploaded Subjects from Admin ====== -->
<div class="card mt-4">
    <h4>📘 Subjects Uploaded by Admin</h4>
    <table class="table table-hover table-bordered align-middle">
        <thead class="table-light">
            <tr>
                <th>Subject Code</th>
                <th>Subject Name</th>
                <th>Units</th>
                <th>Department</th>
                <th>Semester</th>
                <th>Date Uploaded</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example of a NEW subject -->
            <tr>
                <td>IT101</td>
                <td>Intro to Computing</td>
                <td>3</td>
                <td>BSIT</td>
                <td>1st Sem</td>
                <td>2025-09-01</td>
                <td><span class="badge bg-success">🆕 New</span></td>
            </tr>

            <!-- Example of an OLD subject -->
            <tr>
                <td>IT102</td>
                <td>Programming Fundamentals</td>
                <td>4</td>
                <td>BSIT</td>
                <td>1st Sem</td>
                <td>2025-06-15</td>
                <td><span class="badge bg-secondary">Old</span></td>
            </tr>

            <!-- Example of another NEW subject -->
            <tr>
                <td>ENG101</td>
                <td>Communication Skills</td>
                <td>3</td>
                <td>BSED</td>
                <td>1st Sem</td>
                <td>2025-09-05</td>
                <td><span class="badge bg-success">🆕 New</span></td>
            </tr>
        </tbody>
    </table>
</div>

    <!-- ====== Subject Loading Form ====== -->
    <div class="card">
        <h4>➕ Load Students to a Subject</h4>
        <form>
            <div class="mb-3">
                <label for="subject" class="form-label">Select Subject:</label>
                <select id="subject" class="form-select">
                    <option value="">-- Choose Subject --</option>
                    <option value="IT101">IT101 - Intro to Computing</option>
                    <option value="IT102">IT102 - Programming Fundamentals</option>
                    <option value="ENG101">ENG101 - Communication Skills</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="yearLevel" class="form-label">Year Level & Section:</label>
                <select id="yearLevel" class="form-select">
                    <option value="">-- Select Year & Section --</option>
                    <option value="1A">1st Year - Section A</option>
                    <option value="1B">1st Year - Section B</option>
                    <option value="2A">2nd Year - Section A</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="students" class="form-label">Select Students:</label>
                <select id="students" class="form-select" multiple>
                    <option value="S001">S001 - John Doe</option>
                    <option value="S002">S002 - Jane Smith</option>
                    <option value="S003">S003 - Mark Lee</option>
                </select>
                <div class="form-text">Hold CTRL (Windows) or CMD (Mac) to select multiple students.</div>
            </div>

            <button type="submit" class="btn btn-primary">Load Students</button>
        </form>
    </div>
</x-dean-component>
