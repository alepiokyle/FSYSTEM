<x-app-layout>
    <div class="flex pt-0 pb-12 w-full">
        @include('Dean.sidebar')

        <main class="flex-1 bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-100">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                
                <!-- Total Teachers Card -->
                <div class="bg-gray-800 rounded-lg p-4 shadow">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-medium text-gray-400">Total Teachers</h3>
                        <i class="fas fa-chalkboard-teacher text-xl text-blue-400"></i>
                    </div>
                    <p class="mt-1 text-2xl font-semibold text-white">12</p>
                    <p class="text-gray-400 text-sm mt-1">Active teachers</p>
                </div>

                <!-- Total Students Card -->
                <div class="bg-gray-800 rounded-lg p-4 shadow">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-medium text-gray-400">Total Students</h3>
                        <i class="fas fa-user-graduate text-xl text-yellow-300"></i>
                    </div>
                    <p class="mt-1 text-2xl font-semibold text-white">346</p>
                    <p class="text-gray-400 text-sm mt-1">Enrolled students</p>
                </div>

                <!-- Pending Grades Card -->
                <div class="bg-gray-800 rounded-lg p-4 shadow">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-medium text-gray-400">Pending Grades</h3>
                        <i class="fas fa-clock text-xl text-orange-400"></i>
                    </div>
                    <p class="mt-1 text-2xl font-semibold text-white">24</p>
                    <p class="text-gray-400 text-sm mt-1">Waiting approval</p>
                </div>

                <!-- Notifications Card -->
                <div class="bg-gray-800 rounded-lg p-4 shadow">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-medium text-gray-400">Notifications</h3>
                        <i class="fas fa-bell text-xl text-green-400"></i>
                    </div>
                    <p class="mt-1 text-2xl font-semibold text-white">7</p>
                    <p class="text-gray-400 text-sm mt-1">Unread alerts</p>
                </div>
                
            </div>
             </x-app-layout>