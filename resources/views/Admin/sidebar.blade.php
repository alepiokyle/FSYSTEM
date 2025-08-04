<aside class="w-64 bg-gray-800 text-gray-200 shadow-sm rounded-lg p-6 border-r border-gray-700 ml-0">
    <div class="mb-8 text-2xl font-bold text-red-600">
       GradeWise
    </div>
    <nav class="space-y-4">
        <a href="{{ route('upload.subjects') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 {{ request()->routeIs('upload.subjects') ? 'bg-gray-700' : '' }}">
            <span class="ml-2">Upload Subjects</span>
        </a>
        <a href="{{ route('viewgrade') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 {{ request()->routeIs('viewgrade') ? 'bg-gray-700' : '' }}">
            <span class="ml-2">View Student Grades</span>
        </a>

     <a href="{{ route('dean') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 {{ request()->routeIs('dean') ? 'bg-gray-700' : '' }}">
            <span class="ml-2">Dean Account</span>
        </a>
        <a href="{{ route('teacher.account') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 {{ request()->routeIs('teacher.account') ? 'bg-gray-700' : '' }}">
            <span class="ml-2">Teacher Account</span>
        </a>
        <a href="{{ route('student.account') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 {{ request()->routeIs('student.account') ? 'bg-gray-700' : '' }}">
            <span class="ml-2">Student Account</span>
        </a>
        <a href="{{ route('parent.account') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 {{ request()->routeIs('parent.account') ? 'bg-gray-700' : '' }}">
            <span class="ml-2">Parent Account</span>
        </a>
        <div class="text-gray-400 uppercase text-xs font-semibold mt-6 mb-2">Others</div>
        <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700">
            <span class="ml-2">Settings</span>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
           
                <button
    @click="showLogoutModal = true" 
    class="w-full text-left px-4 py-2 text-white hover:bg-red-600 transition bg-red-500 rounded">
    🔒 Logout
</button>

    </nav>
</aside>
