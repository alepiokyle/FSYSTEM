<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Admin</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom Admin Styles -->
    <style>
        :root {
            --sidebar-width: 256px;
            --header-height: 60px;
            --bg-dark: #111827;
            --bg-darker: #1f2937;
            --text-light: #e5e7eb;
            --text-muted: #9ca3af;
            --accent-blue: #3b82f6;
            --accent-red: #ef4444;
        }
        
        * {
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Figtree', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-light);
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        
        .admin-container {
            display: flex;
            min-height: 100vh;
        }
        
        .admin-sidebar {
            width: var(--sidebar-width);
            background-color: var(--bg-darker);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
        }
        
        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }
        
        .admin-sidebar::-webkit-scrollbar-track {
            background: #374151;
        }
        
        .admin-sidebar::-webkit-scrollbar-thumb {
            background: #4b5563;
            border-radius: 3px;
        }
        
        .admin-main {
            flex: 1;
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            background-color: var(--bg-dark);
            overflow-x: hidden;
        }
        
        .admin-content {
            padding: 1.5rem;
            max-width: 100%;
            margin: 0 auto;
        }
        
        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid #374151;
            text-align: center;
        }
        
        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ef4444;
            text-decoration: none;
        }
        
        .sidebar-nav {
            padding: 1rem 0;
        }
        
        .nav-item {
            display: block;
            padding: 0.75rem 1.5rem;
            color: var(--text-light);
            text-decoration: none;
            transition: background-color 0.2s;
            border-left: 3px solid transparent;
        }
        
        .nav-item:hover {
            background-color: #374151;
            border-left-color: var(--accent-blue);
        }
        
        .nav-item.active {
            background-color: #374151;
            border-left-color: var(--accent-blue);
        }
        
        .nav-item i {
            width: 1.25rem;
            margin-right: 0.75rem;
            text-align: center;
        }
        
        .nav-section {
            padding: 1rem 1.5rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            color: var(--text-muted);
            letter-spacing: 0.05em;
        }
        
        .logout-form {
            padding: 1rem 1.5rem;
            margin-top: auto;
            border-top: 1px solid #374151;
        }
        
        .logout-btn {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--accent-red);
            color: white;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .logout-btn:hover {
            background-color: #dc2626;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .admin-sidebar.active {
                transform: translateX(0);
            }
            
            .admin-main {
                margin-left: 0;
            }
            
            .admin-sidebar-overlay {
                display: block;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }
        }
        
        /* Utility Classes */
        .text-center { text-align: center; }
        .w-full { width: 100%; }
        .mb-4 { margin-bottom: 1rem; }
        .mt-4 { margin-top: 1rem; }
        .p-4 { padding: 1rem; }
        .rounded { border-radius: 0.375rem; }
    </style>
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <a href="{{ route('dashboard') }}" class="sidebar-brand">
                    GradeWise
                </a>
            </div>
            
            
                
                <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    Dashboard
                </a>
                
                <a href="{{ route('upload.subjects') }}" class="nav-item {{ request()->routeIs('upload.subjects') ? 'active' : '' }}">
                    <i class="fas fa-upload"></i>
                    Upload Subjects
                </a>
                
                <a href="{{ route('grades.view') }}" class="nav-item {{ request()->routeIs('grades.view') ? 'active' : '' }}">
                    <i class="fas fa-chart-bar"></i>
                    View Grades
                </a>
                
                <a href="{{ route('dean') }}" class="nav-item {{ request()->routeIs('dean') ? 'active' : '' }}">
                    <i class="fas fa-user-tie"></i>
                    Dean Account
                </a>
                
                <a href="{{ route('teacher.account') }}" class="nav-item {{ request()->routeIs('teacher.account') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard-teacher"></i>
                    Teacher Account
                </a>
                
                <a href="{{ route('student.account') }}" class="nav-item {{ request()->routeIs('student.account') ? 'active' : '' }}">
                    <i class="fas fa-user-graduate"></i>
                    Student Account
                </a>
                
                <a href="{{ route('parent.account') }}" class="nav-item {{ request()->routeIs('parent.account') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>
                    Parent Account
                </a>
                
                <div class="nav-section">Settings</div>
                
                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </nav>
        </aside>
        
        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-content">
                @yield('content')
            </div>
        </main>
    </div>
    
    