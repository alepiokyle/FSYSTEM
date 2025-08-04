<x-app-layout>
    <div class="flex pt-0 pb-12 w-full">
        <!-- Sidebar -->
        @include('Admin.sidebar')

         <main class="flex-1 bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-100">
            <div class="p-6 bg-gray-800 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold text-white mb-4">View Student Grades</h2>

                <!-- Filters -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                    <select class="p-2 border rounded bg-gray-700 text-white" name="department">
                        <option>-- Select Department --</option>
                        <option>BSIT</option>
                        <option>BSCS</option>
                    </select>

                    <select class="p-2 border rounded bg-gray-700 text-white" name="year_level">
                        <option>-- Year Level --</option>
                        <option>1st Year</option>
                        <option>2nd Year</option>
                        <option>3rd Year</option>
                        <option>4th Year</option>
                    </select>

                    <select class="p-2 border rounded bg-gray-700 text-white" name="semester">
                        <option>-- Semester --</option>
                        <option>1st Semester</option>
                        <option>2nd Semester</option>
                        <option>Summer</option>
                    </select>

                    <select class="p-2 border rounded bg-gray-700 text-white" name="school_year">
                        <option>-- School Year --</option>
                        <option>2024-2025</option>
                        <option>2025-2026</option>
                    </select>

                    <input type="text" class="p-2 border rounded bg-gray-700 text-white" placeholder="Search Student Name or ID">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">Search</button>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full border text-sm text-left text-gray-300">
                        <thead class="bg-gray-700 text-white">
                            <tr>
                                <th class="px-4 py-2">Student ID</th>
                                <th class="px-4 py-2">Name</th>
                                <th class="px-4 py-2">Subject</th>
                                <th class="px-4 py-2">Prelim</th>
                                <th class="px-4 py-2">Midterm</th>
                                <th class="px-4 py-2">Semi-Final</th>
                                <th class="px-4 py-2">Final</th>
                                <th class="px-4 py-2">Final Grade</th>
                                <th class="px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- No data yet -->
                        </tbody>
                    </table>
                </div>

                <!-- Informative Message -->
                <p class="text-center text-red-500 mt-4 italic">
                    No records available. Grades will appear once approved by the Dean.
                </p>

                <!-- Export buttons -->
                <div class="mt-4 flex gap-4">
                    <button class="bg-green-600 text-white px-4 py-2 rounded">Export PDF</button>
                    <button class="bg-yellow-500 text-white px-4 py-2 rounded">Export Excel</button>
                    <button class="bg-gray-700 text-white px-4 py-2 rounded">Print</button>
                </div>
            </div>


</x-app-layout>
