<x-admin-component>
 <style>
    body {
        background-color: #e6e9ec; /* morning mist background */
        font-family: Arial, sans-serif;
        color: #333; /* darker text for readability */
    }

    /* Card styling */
    .glass-card {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        border: 1px solid #ddd;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        min-height: 180px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .glass-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    /* Icon styling */
    .card-icon {
        font-size: 2rem;
        margin-bottom: 10px;
    }
    .icon-students { color: #1976d2; }
    .icon-teachers { color: #388e3c; }
    .icon-subjects { color: #f57c00; }
    .icon-users { color: #0288d1; }

    /* Table style */
    .glass-table {
        color: #333;
    }
    .glass-table thead {
        background: #f0f0f0;
    }
    .glass-table tbody tr {
        background: #fff;
    }
    .glass-table th, .glass-table td {
        vertical-align: middle;
    }

    /* Header styles */
    .page-header h5, .breadcrumb-item a, .breadcrumb-item {
        color: #333 !important;
    }

    /* Badges */
    .badge {
        font-size: 0.8rem;
        padding: 4px 8px;
        border-radius: 4px;
    }
    .bg-light-primary { background: #e3f2fd; color: #1976d2; }
    .bg-light-success { background: #e8f5e9; color: #388e3c; }
    .bg-light-warning { background: #fff3e0; color: #f57c00; }
    .bg-light-info { background: #e0f7fa; color: #0288d1; }

    /* Chart container */
    #activitiesChart {
        background: #fff;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #ddd;
    }
</style>


    <x-slot:page_title>
        Admin Dashboard
    </x-slot>

    <!-- Header -->
    <div class="page-header mb-4">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h5 class="m-b-10">Dashboard Overview</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../dashboard/index.html">Home</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Home</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Cards Row -->
   <div class="row g-4 mb-5">
    <div class="col-md-6 col-xl-3">
        <div class="glass-card text-center">
            <i class="fas fa-user-graduate card-icon icon-students"></i>
            <h6 class="mb-2">Total Students</h6>
            <h4>1,250 <span class="badge bg-light-primary border border-primary"><i class="fas fa-arrow-up"></i> 15.3%</span></h4>
            <p class="mb-0 text-muted">Active students in the system</p>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="glass-card text-center">
            <i class="fas fa-chalkboard-teacher card-icon icon-teachers"></i>
            <h6 class="mb-2">Total Teachers</h6>
            <h4>85 <span class="badge bg-light-success border border-success"><i class="fas fa-arrow-up"></i> 8.5%</span></h4>
            <p class="mb-0 text-muted">Active teaching staff</p>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="glass-card text-center">
            <i class="fas fa-book card-icon icon-subjects"></i>
            <h6 class="mb-2">Total Subjects</h6>
            <h4>120 <span class="badge bg-light-warning border border-warning"><i class="fas fa-book"></i></span></h4>
            <p class="mb-0 text-muted">Subjects offered this semester</p>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="glass-card text-center">
            <i class="fas fa-users card-icon icon-users"></i>
            <h6 class="mb-2">System Users</h6>
            <h4>1,455 <span class="badge bg-light-info border border-info"><i class="fas fa-users"></i></span></h4>
            <p class="mb-0 text-muted">Total system users</p>
        </div>
    </div>
</div>
<canvas id="activitiesChart" height="100"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Grab values from the cards
    const totalStudents = parseInt(document.querySelector('.icon-students').parentElement.querySelector('h4').textContent);
    const totalTeachers = parseInt(document.querySelector('.icon-teachers').parentElement.querySelector('h4').textContent);
    const totalSubjects = parseInt(document.querySelector('.icon-subjects').parentElement.querySelector('h4').textContent);
    const totalUsers = parseInt(document.querySelector('.icon-users').parentElement.querySelector('h4').textContent);

    const ctx = document.getElementById('activitiesChart').getContext('2d');

    const activitiesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Students', 'Teachers', 'Subjects', 'Users'],
            datasets: [{
                label: 'System Overview',
                data: [totalStudents, totalTeachers, totalSubjects, totalUsers],
                borderColor: '#4cafef',
                backgroundColor: 'rgba(76, 175, 239, 0.1)',
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#4cafef',
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false
                },
                title: {
                    display: true,
                    text: 'Dashboard Data Overview',
                    font: { size: 16 }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(200, 200, 200, 0.1)'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(200, 200, 200, 0.1)'
                    }
                }
            }
        }
    });
</script>


   
</x-admin-component>
