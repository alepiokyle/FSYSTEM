@extends('layouts.admin')

@section('content')
    <main class="flex-1 p-6 bg-gray-900 rounded-lg shadow-sm sm:rounded-lg text-gray-100">
        <h2 class="text-2xl font-bold mb-4">🎓 Student Accounts</h2>

        <table class="min-w-full bg-gray-800 rounded-lg shadow text-sm">
            <thead class="bg-gray-700 text-gray-300 uppercase text-xs">
                <tr>
                    <th class="py-3 px-4 text-left">Student ID</th>
                    <th class="py-3 px-4 text-left">Name</th>
                    <th class="py-3 px-4 text-left">Course</th>
                    <th class="py-3 px-4 text-left">Year Level</th>
                    <th class="py-3 px-4 text-left">Email</th>
                    <th class="py-3 px-4 text-left">Login History</th>
                    <th class="py-3 px-4 text-left">View Grades</th>
                    <th class="py-3 px-4 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Sample row - Replace with dynamic data -->
                <tr class="border-b hover:bg-gray-700">
                    <td class="py-3 px-4">STD202301</td>
                    <td class="py-3 px-4">Ana Santos</td>
                    <td class="py-3 px-4">BSIT</td>
                    <td class="py-3 px-4">2nd Year</td>
                    <td class="py-3 px-4">asantos@student.edu</td>
                    <td class="py-3 px-4">July 30, 2025 - 08:50 AM</td>
                    <td class="py-3 px-4">
                        <a href="#" class="text-blue-400 hover:underline">View</a>
                    </td>
                    <td class="py-3 px-4 space-x-2">
                        <div class="flex space-x-2">
                            <button class="bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700">Edit</button>
                            <button class="bg-gray-600 text-white px-2 py-1 rounded text-xs hover:bg-gray-700">Reset Password</button>
                            <button class="bg-red-600 text-white px-2 py-1 rounded text-xs hover:bg-red-700">Suspend</button>
                        </div>
                    </td>
                </tr>
                <!-- More rows go here -->
            </tbody>
        </table>
    </main>
@endsection
