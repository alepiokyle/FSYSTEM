<x-dean-component>
    <style>
        /* ====== Background & Page ====== */
        x-dean-component {
            background: linear-gradient(to right, #f0f4f8, #ffffff);
            min-height: 100vh;
            padding: 20px 30px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* ====== Page Header ====== */
        .page-header { margin-bottom: 30px; }
        .page-header-title h5 { font-weight: 700; font-size: 1.8rem; color: #222; }
        .breadcrumb { padding: 0; margin-top: 5px; background: transparent; }
        .breadcrumb-item a { text-decoration: none; color: #555; }
        .breadcrumb-item a:hover { text-decoration: underline; }

        /* ====== Card Styles ====== */
        .card {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            border: 1px solid #e6e6e6;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .card:hover { transform: translateY(-5px); box-shadow: 0 12px 24px rgba(0,0,0,0.12); }

        .card h2 {
            font-size: 1.2rem;
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
        }

        /* ====== Form ====== */
        .form-group { margin-bottom: 15px; }
        label { font-weight: 500; color: #555; margin-bottom: 5px; display: block; }
        select {
            width: 100%;
            padding: 8px 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 0.95rem;
        }
        select:focus { outline: none; border-color: #0d6efd; box-shadow: 0 0 4px rgba(13,110,253,0.3); }

        .btn-assign {
            background-color: #0d6efd;
            color: #fff;
            padding: 10px 18px;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-assign:hover { background-color: #0b5ed7; }

        /* ====== Table ====== */
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
        }
        thead { background-color: #f8f9fa; }
        th, td {
            padding: 12px 15px;
            text-align: left;
            font-size: 0.9rem;
            color: #333;
        }
        tbody tr { transition: background 0.2s; }
        tbody tr:hover { background-color: #f5f7fa; }
        .action-links a {
            margin: 0 5px;
            font-size: 0.85rem;
            text-decoration: none;
            font-weight: 500;
        }
        .action-links a.edit { color: #0d6efd; }
        .action-links a.remove { color: #dc3545; }
        .action-links a:hover { text-decoration: underline; }
    </style>

    <!-- ====== Page Header ====== -->
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title"><h5>Assign Teacher</h5></div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dean</a></li>
                        <li class="breadcrumb-item" aria-current="page">Assign Teacher</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- ====== Assign Teacher Form Card ====== -->
    <div class="card">
        <h2>New Assignment</h2>
        <form class="row" style="display: flex; flex-wrap: wrap; gap: 20px;">
            <div class="form-group" style="flex:1;">
                <label for="department">Department</label>
                <select id="department">
                    <option>-- Select Department --</option>
                    <option>BSIT</option>
                    <option>BSED</option>
                    <option>BEED</option>
                </select>
            </div>

            <div class="form-group" style="flex:1;">
                <label for="subject">Subject</label>
                <select id="subject">
                    <option>-- Select Subject --</option>
                    <option>IT101 - Database Management</option>
                    <option>ENG102 - English Communication</option>
                    <option>MATH103 - College Algebra</option>
                </select>
            </div>

            <div class="form-group" style="flex:1;">
                <label for="teacher">Teacher</label>
                <select id="teacher">
                    <option>-- Select Teacher --</option>
                    <option>Mr. Santos</option>
                    <option>Ms. Cruz</option>
                    <option>Mr. Dela Cruz</option>
                </select>
            </div>
        </form>
        <div style="margin-top:20px; text-align:right;">
            <button type="button" class="btn-assign">Assign Teacher</button>
        </div>
    </div>

    <!-- ====== Current Assignments Table Card ====== -->
    <div class="card">
        <h2>📑 Current Assignments</h2>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Subject Code</th>
                        <th>Subject Name</th>
                        <th>Department</th>
                        <th>Assigned Teacher</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>IT101</td>
                        <td>Database Management</td>
                        <td>BSIT</td>
                        <td>Mr. Santos</td>
                        <td class="action-links" style="text-align:center;">
                            <a href="#" class="edit">✏ Reassign</a>
                            <a href="#" class="remove">🗑 Remove</a>
                        </td>
                    </tr>
                    <tr>
                        <td>ENG102</td>
                        <td>English Communication</td>
                        <td>BSED</td>
                        <td>Ms. Cruz</td>
                        <td class="action-links" style="text-align:center;">
                            <a href="#" class="edit">✏ Reassign</a>
                            <a href="#" class="remove">🗑 Remove</a>
                        </td>
                    </tr>
                    <tr>
                        <td>MATH103</td>
                        <td>College Algebra</td>
                        <td>BSIT</td>
                        <td>Mr. Dela Cruz</td>
                        <td class="action-links" style="text-align:center;">
                            <a href="#" class="edit">✏ Reassign</a>
                            <a href="#" class="remove">🗑 Remove</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-dean-component>
