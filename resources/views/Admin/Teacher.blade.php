<x-app-layout>
    <div class="flex pt-0 pb-12 w-full">
        @include('Admin.sidebar')

        <main class="flex-1 p-6 bg-gray-900 rounded-lg shadow-sm sm:rounded-lg text-gray-100">
            <h2 class="text-2xl font-bold mb-4">👨‍🏫 Teacher Accounts</h2>

            <table class="min-w-full bg-gray-800 rounded-lg shadow text-sm">
                <thead class="bg-gray-700 text-gray-300 uppercase text-xs">
                    <tr>
                        <th class="py-3 px-4 text-left">Teacher ID</th>
                        <th class="py-3 px-4 text-left">Full Name</th>
                        <th class="py-3 px-4 text-left">Email Address</th>
                        <th class="py-3 px-4 text-left">Account Status</th>
                        <th class="py-3 px-4 text-left">Last Login</th>
                        <th class="py-3 px-4 text-left">Admin Controls</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample teacher row -->
                    <tr class="border-b hover:bg-gray-700">
                        <td class="py-3 px-4">TCH001</td>
                        <td class="py-3 px-4">Prof. Maria Reyes</td>
                        <td class="py-3 px-4">mreyes@school.edu</td>
                        <td class="py-3 px-4">
                            <span class="text-green-500 font-semibold">Active</span>
                        </td>
                        <td class="py-3 px-4">July 31, 2025 • 09:15 AM</td>
                        <td class="py-3 px-4 space-x-2">
                            <div class="flex space-x-2">
                                <button class="bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700">Edit Info</button>
                                <button class="bg-yellow-500 text-white px-2 py-1 rounded text-xs hover:bg-yellow-600">Assign Subjects</button>
                                <button class="bg-gray-600 text-white px-2 py-1 rounded text-xs hover:bg-gray-700">Reset Login</button>
                                <button class="bg-red-600 text-white px-2 py-1 rounded text-xs hover:bg-red-700">Suspend</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Dynamically generated teacher rows will appear here -->
                </tbody>
            </table>

            <!-- Optional: Message if no teachers are available -->
            <p class="text-sm text-gray-400 mt-4">* Only verified and active teachers will be displayed. Suspended accounts can be reactivated anytime.</p>
        </main>
    </div>
</x-app-layout>
