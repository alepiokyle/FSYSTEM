<x-app-layout>
    <div class="flex pt-0 pb-12 w-full">
        @include('Admin.sidebar')

        <main class="flex-1 p-6 bg-gray-900 rounded-lg shadow-sm sm:rounded-lg text-gray-100">
            <h2 class="text-2xl font-bold mb-4">👪 Parent Accounts</h2>

            <table class="min-w-full bg-gray-800 rounded-lg shadow text-sm">
                <thead class="bg-gray-700 text-gray-300 uppercase text-xs">
                    <tr>
                        <th class="py-3 px-4 text-left">Parent ID</th>
                        <th class="py-3 px-4 text-left">Name</th>
                        <th class="py-3 px-4 text-left">Email</th>
                        <th class="py-3 px-4 text-left">Contact</th>
                        <th class="py-3 px-4 text-left">Linked Student</th>
                        <th class="py-3 px-4 text-left">Status</th>
                        <th class="py-3 px-4 text-left">Last Login</th>
                        <th class="py-3 px-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Row -->
                    <tr class="border-b hover:bg-gray-700">
                        <td class="py-3 px-4">PRT001</td>
                        <td class="py-3 px-4">Mr. Jose Ramirez</td>
                        <td class="py-3 px-4">j.ramirez@example.com</td>
                        <td class="py-3 px-4">09123456789</td>
                        <td class="py-3 px-4">Juan Dela Cruz (BSIT 3A)</td>
                        <td class="py-3 px-4 text-green-500 font-semibold">Active</td>
                        <td class="py-3 px-4">August 1, 2025 08:00AM</td>
                        <td class="py-3 px-4 space-x-2">
                            <div class="flex space-x-2">
                                <button class="bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700">Edit</button>
                                <button class="bg-gray-600 text-white px-2 py-1 rounded text-xs hover:bg-gray-700">Reset Password</button>
                                <button class="bg-red-600 text-white px-2 py-1 rounded text-xs hover:bg-red-700">Suspend</button>
                            </div>
                        </td>
                    </tr>

                    <!-- More rows to be added dynamically -->
                </tbody>
            </table>
        </main>
    </div>
</x-app-layout>
