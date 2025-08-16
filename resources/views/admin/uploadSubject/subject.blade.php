<x-admin-component>
<style>
body {
    background: linear-gradient(135deg, #e6e9ec 0%, #f4f6f7 100%);
    font-family: Arial, sans-serif;
    min-height: 100vh;
    color: #333;
}

.background-overlay, .school-background {
    position: fixed;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
}

.background-overlay {
    left: 0;
    background: linear-gradient(135deg, rgba(230,233,236,0.95), rgba(244,246,247,0.95));
}

.school-background {
    right: 0;
    width: 45%;
    background: linear-gradient(135deg, rgba(200,210,215,0.15), rgba(240,245,248,0.15));
    opacity: 0.4;
    mask-image: linear-gradient(to left, rgba(0,0,0,0.8), rgba(0,0,0,0));
    -webkit-mask-image: linear-gradient(to left, rgba(0,0,0,0.8), rgba(0,0,0,0));
}

@media (max-width: 768px) {
    .school-background { width: 100%; opacity: 0.2; }
}

.glass-card {
    background: rgba(255,255,255,0.7);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 25px;
    color: #333;
    border: 1px solid rgba(255,255,255,0.4);
    box-shadow: 0 8px 32px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

label {
    font-weight: 600;
    margin-bottom: 6px;
    display: block;
    font-size: 14px;
    color: #333;
}

.form-control,
.form-select,
textarea {
    width: 100%;
    height: 46px;
    padding: 10px 12px;
    font-size: 14px;
    background: rgba(255,255,255,0.8);
    border: 1px solid rgba(200,200,200,0.4);
    border-radius: 8px;
    box-sizing: border-box;
    transition: all 0.2s ease;
    color: #333;
}

textarea.form-control { min-height: 80px; resize: vertical; }

.form-control::placeholder,
textarea::placeholder { color: rgba(80,80,80,0.6); font-style: italic; }

.form-control:focus,
.form-select:focus {
    background: rgba(255,255,255,0.95);
    border-color: rgba(0,123,255,0.6);
    box-shadow: 0 0 6px rgba(0,123,255,0.3);
    outline: none;
}

.row.mb-3 { gap: 15px 0; }

.btn-primary {
    background: rgba(0,123,255,0.8);
    border: none;
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
    font-size: 14px;
}

.btn-primary:hover { background: rgba(0,123,255,1); }

.glass-table {
    width: 100%;
    border-collapse: collapse;
    color: #333;
    margin-top: 20px;
}

.glass-table thead {
    background: rgba(255,255,255,0.6);
}

.glass-table tbody tr {
    background: rgba(255,255,255,0.45);
}

.glass-table th,
.glass-table td {
    padding: 12px;
    text-align: left;
}

.status-approved { color: #2ecc71; font-weight: bold; }
.status-pending { color: #e67e22; font-weight: bold; }

@media (max-width: 768px) {
    .form-control, .form-select { height: 42px; font-size: 13px; }
}
</style>

<div class="background-overlay"></div>
<div class="school-background"></div>

<div class="glass-card">
    <h2>Filter Student Grades</h2>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="department">Department</label>
            <select id="department" class="form-select">
                <option value="">-- Select Department --</option>
                <option value="IT">IT</option>
                <option value="Business">Business</option>
                <option value="Education">Education</option>
                <option value="Engineering">Engineering</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="yearLevel">Year Level</label>
            <select id="yearLevel" class="form-select">
                <option value="">-- Select Year Level --</option>
                <option value="1">1st Year</option>
                <option value="2">2nd Year</option>
                <option value="3">3rd Year</option>
                <option value="4">4th Year</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="subject">Subject</label>
            <select id="subject" class="form-select">
                <option value="">-- Select Subject --</option>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <label for="schoolYear">School Year</label>
            <select id="schoolYear" class="form-select">
                <option value="">-- Select School Year --</option>
                <option value="2025-2026">2025–2026</option>
                <option value="2026-2027">2026–2027</option>
            </select>
        </div>
        <div class="col-md-6">
            <label for="semester">Semester</label>
            <select id="semester" class="form-select">
                <option value="">-- Select Semester --</option>
                <option value="1st Semester">1st Semester</option>
                <option value="2nd Semester">2nd Semester</option>
                <option value="Summer">Summer</option>
            </select>
        </div>
    </div>

    <div class="mb-3">
        <label for="search">Search Student Name or ID</label>
        <input type="text" id="search" class="form-control" placeholder="Type student name or ID">
    </div>

    <table class="glass-table" id="gradesTable">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Name</th>
                <th>Subject</th>
                <th>Prelim</th>
                <th>Midterm</th>
                <th>Semi-Final</th>
                <th>Final</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1001</td>
                <td>Juan Dela Cruz</td>
                <td>Math 101</td>
                <td>88</td>
                <td>90</td>
                <td>85</td>
                <td>87</td>
                <td class="status-approved">Approved</td>
            </tr>
            <tr>
                <td>1002</td>
                <td>Maria Santos</td>
                <td>English 101</td>
                <td>92</td>
                <td>94</td>
                <td>91</td>
                <td>93</td>
                <td class="status-approved">Approved</td>
            </tr>
            <tr>
                <td>1003</td>
                <td>Carlo Reyes</td>
                <td>Science 101</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td class="status-pending">Pending</td>
            </tr>
        </tbody>
    </table>
</div>

<script>
const departmentSubjects = {
    IT: ["Programming 101", "Database 101", "Networking 101"],
    Business: ["Economics 101", "Accounting 101", "Marketing 101"],
    Education: ["Teaching 101", "Child Psychology", "Curriculum 101"],
    Engineering: ["Mechanics 101", "Electronics 101"],
};

const departmentSelect = document.getElementById('department');
const subjectSelect = document.getElementById('subject');

departmentSelect.addEventListener('change', () => {
    const dept = departmentSelect.value;
    subjectSelect.innerHTML = '<option value="">-- Select Subject --</option>';
    if(dept && departmentSubjects[dept]){
        departmentSubjects[dept].forEach(sub => {
            const option = document.createElement('option');
            option.value = sub;
            option.textContent = sub;
            subjectSelect.appendChild(option);
        });
    }
});

// Search functionality
const searchInput = document.getElementById('search');
const gradesTable = document.getElementById('gradesTable').getElementsByTagName('tbody')[0];

searchInput.addEventListener('keyup', () => {
    const search = searchInput.value.toLowerCase();
    for(let row of gradesTable.rows){
        const name = row.cells[1].innerText.toLowerCase();
        const id = row.cells[0].innerText.toLowerCase();
        row.style.display = name.includes(search) || id.includes(search) ? '' : 'none';
    }
});
</script>

</x-admin-component>
