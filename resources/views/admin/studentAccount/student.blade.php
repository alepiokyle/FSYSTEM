<x-admin-component>

<style>
body {
    font-family: Arial, sans-serif;
    color: #333;
}

/* Card design */
.glass-card {
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 25px;
    border: 1px solid rgba(255,255,255,0.4);
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    margin-bottom: 30px;
    transition: 0.3s ease-in-out;
}

.glass-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
}

/* Search + Filter */
.search-bar {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.search-bar input, 
.search-bar select {
    flex: 1;
    padding: 8px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

/* Table */
.glass-table {
    width: 100%;
    border-collapse: collapse;
    color: #333;
    border-radius: 10px;
    overflow: hidden;
}

.glass-table thead {
    background: rgba(0, 0, 0, 0.05);
    font-weight: bold;
}

.glass-table tbody tr {
    background: rgba(255,255,255,0.6);
    transition: 0.2s;
}

.glass-table tbody tr:hover {
    background: rgba(255,255,255,0.9);
}

.glass-table th,
.glass-table td {
    padding: 12px;
    text-align: left;
    vertical-align: middle;
}

/* Status */
.status-active { color: #2ecc71; font-weight: bold; }
.status-suspended { color: #e74c3c; font-weight: bold; }

/* Action buttons */
.action-group {
    display: flex;
    gap: 6px;
}

.action-btn {
    flex: 1;
    padding: 6px 10px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    color: white;
    font-size: 0.8rem;
    transition: 0.2s;
}

.edit-btn { background: #3498db; }
.edit-btn:hover { background: #2980b9; }

.suspend-btn { background: #e67e22; }
.suspend-btn:hover { background: #ca6f1e; }

.delete-btn { background: #e74c3c; }
.delete-btn:hover { background: #c0392b; }
</style>

<div class="glass-card">
    <h3>Student List / Directory</h3>

    <!-- Search + Filter -->
    <form class="search-bar">
        <input type="text" placeholder="Search by name, email or ID...">
        <select>
            <option value="">All Courses</option>
            <option value="BSIT">BS Information Technology</option>
            <option value="BSED">BS Education</option>
            <option value="BSBA">BS Business Administration</option>
            <option value="BSN">BS Nursing</option>
            <option value="BSECE">BS Engineering</option>
        </select>
        <button type="button" class="action-btn edit-btn">Filter</button>
    </form>

    <!-- Student Table -->
    <table class="glass-table">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Course / Year</th>
                <th>Status</th>
                <th style="width: 200px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>2023-001</td>
                <td>Juan Dela Cruz</td>
                <td>juan@email.com</td>
                <td>BSIT - 2A</td>
                <td><span class="status-active">Active</span></td>
                <td>
                    <div class="action-group">
                        <button class="action-btn edit-btn">Edit</button>
                        <button class="action-btn suspend-btn">Suspend</button>
                        <button class="action-btn delete-btn">Delete</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>2023-002</td>
                <td>Maria Santos</td>
                <td>maria@email.com</td>
                <td>BSED - 1B</td>
                <td><span class="status-suspended">Suspended</span></td>
                <td>
                    <div class="action-group">
                        <button class="action-btn edit-btn">Edit</button>
                        <button class="action-btn suspend-btn">Activate</button>
                        <button class="action-btn delete-btn">Delete</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>2023-003</td>
                <td>Carlos Reyes</td>
                <td>carlos@email.com</td>
                <td>BSBA - 3C</td>
                <td><span class="status-active">Active</span></td>
                <td>
                    <div class="action-group">
                        <button class="action-btn edit-btn">Edit</button>
                        <button class="action-btn suspend-btn">Suspend</button>
                        <button class="action-btn delete-btn">Delete</button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>


</x-admin-component>