<x-app-layout>
    <div class="flex pt-0 pb-12 w-full">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-gray-200 shadow-sm rounded-lg p-6 border-r border-gray-700 ml-0">
            <div class="mb-8 text-2xl font-bold text-red-600">
               GradeWise
            </div>
            <nav class="space-y-4">
                <a href="{{ route('upload.subjects') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700">
                    <span class="ml-2">Upload Subjects</span>
                </a>
                <a href="{{ route('viewgrade') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700">
                    <span class="ml-2">View Student Grades</span>
                </a>
                <a href="{{ route('dean') }}" class="flex items-center px-3 py-2 bg-gray-900 rounded-md">
                    <span class="ml-2 text-white font-bold">Dean Account</span>
                </a>
                <a href="{{ route('teacher.account') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700">
                    <span class="ml-2">Teacher Account</span>
                </a>
                <a href="{{ route('student.account') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700">
                    <span class="ml-2">Student Account</span>
                </a>
                <a href="{{ route('parent.account') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700">
                    <span class="ml-2">Parent Account</span>
                </a>
                <div class="text-gray-400 uppercase text-xs font-semibold mt-6 mb-2">Others</div>
                <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700">
                    <span class="ml-2">Settings</span>
                </a>
                <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700">
                    <span class="ml-2">Logout</span>
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 px-10 py-8 bg-gray-900 text-gray-100 rounded-lg shadow-sm">
            <h2 class="text-2xl font-semibold mb-6">Register Dean Account</h2>

            @if(session('success'))
                <div class="bg-green-600 text-white p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.deans.store') }}" class="bg-gray-800 p-6 rounded shadow-md max-w-md space-y-4">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300">Dean Name</label>
                    <input type="text" name="name" id="name" required class="mt-1 p-2 w-full border border-gray-600 rounded bg-gray-700 text-white">
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300">Dean Email</label>
                    <input type="email" name="email" id="email" required class="mt-1 p-2 w-full border border-gray-600 rounded bg-gray-700 text-white">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300">Temporary Password</label>
                    <input type="password" name="password" id="password" required class="mt-1 p-2 w-full border border-gray-600 rounded bg-gray-700 text-white">
                </div>

                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                    Register Dean
                </button>
            </form>
        </main>
    </div>
</x-app-layout>
