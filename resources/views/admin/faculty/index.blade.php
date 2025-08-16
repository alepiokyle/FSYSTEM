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

.glass-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.15);
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

textarea.form-control {
    min-height: 80px;
    resize: vertical;
}

.form-control::placeholder,
textarea::placeholder {
    color: rgba(80,80,80,0.6);
    font-style: italic;
}

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

.btn-primary:hover {
    background: rgba(0,123,255,1);
}

.glass-table {
    width: 100%;
    border-collapse: collapse;
    color: #333;
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

.status-active { color: #2ecc71; font-weight: bold; }
.status-inactive { color: #e74c3c; font-weight: bold; }

.action-btn {
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    color: white;
    font-size: 0.85rem;
}
.edit-btn { background: #3498db; }
.delete-btn { background: #e74c3c; }

@media (max-width: 768px) {
    .form-control, .form-select { height: 42px; font-size: 13px; }
}
</style>

<div class="background-overlay"></div>
<div class="school-background"></div>

    
    <div class="glass-card">
        <form method="POST" action="">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="department">Department</label>
                    <select id="department" name="department" class="form-select" required>
                        <option value="">-- Select Department --</option>
                        <option value="IT">Information Technology</option>
                        <option value="Business">Business</option>
                        <option value="Education">Education</option>
                        <option value="Engineering">Engineering</option>
                        <option value="Nursing">Nursing</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="subject_code">Subject Code</label>
                    <input type="text" id="subject_code" name="subject_code" class="form-control" placeholder="Auto-generated or type manually" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-8">
                    <label for="subject_name">Subject Name</label>
                    <input type="text" id="subject_name" name="subject_name" class="form-control" placeholder="Enter subject name" required>
                </div>
                <div class="col-md-4">
                    <label for="units">Units</label>
                    <input type="number" id="units" name="units" class="form-control" placeholder="Auto-filled or enter manually" min="1" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="description">Description (Optional)</label>
                <textarea id="description" name="description" class="form-control" placeholder="Short course description"></textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="school_year">School Year</label>
                    <select id="school_year" name="school_year" class="form-select" required>
                        <option value="">-- Select School Year --</option>
                        <option value="2025-2026">2025–2026</option>
                        <option value="2026-2027">2026–2027</option>
                        <option value="2027-2028">2027–2028</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="semester">Semester</label>
                    <select id="semester" name="semester" class="form-select" required>
                        <option value="">-- Select Semester --</option>
                        <option value="1st Semester">1st Semester</option>
                        <option value="2nd Semester">2nd Semester</option>
                        <option value="Summer">Summer</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label for="status">Status</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="">-- Select Status --</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Save Subject</button>
            </div>
        </form>
    </div>
</div>
</x-admin-component>
