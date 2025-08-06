<aside class="w-64 bg-gray-800 text-gray-200 shadow-sm rounded-lg p-6 border-r border-gray-700 ml-0 flex-shrink-0">
    <div class="mb-8 text-2xl font-bold text-red-600">
       GradeWise
    </div>
    <nav class="space-y-2">
        <a href="{{ route('upload.subjects') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 transition-colors {{ request()->routeIs('upload.subjects') ? 'bg-gray-700' : '' }}">
            <i class="fas fa-upload w-5"></i>
            <span class="ml-3">Upload Subjects</span>
        </a>
        <a href="{{ route('viewgrade') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 transition-colors {{ request()->routeIs('viewgrade') ? 'bg-gray-700' : '' }}">
            <i class="fas fa-chart-bar w-5"></i>
            <span class="ml-3">View Student Grades</span>
        </a>
        <a href="{{ route('dean') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 transition-colors {{ request()->routeIs('dean') ? 'bg-gray-700' : '' }}">
            <i class="fas fa-user-tie w-5"></i>
            <span class="ml-3">Dean Account</span>
        </a>
        <a href="{{ route('teacher.account') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 transition-colors {{ request()->routeIs('teacher.account') ? 'bg-gray-700' : '' }}">
            <i class="fas fa-chalkboard-teacher w-5"></i>
            <span class="ml-3">Teacher Account</span>
        </a>
        <a href="{{ route('student.account') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 transition-colors {{ request()->routeIs('student.account') ? 'bg-gray-700' : '' }}">
            <i class="fas fa-user-graduate w-5"></i>
            <span class="ml-3">Student Account</span>
        </a>
        <a href="{{ route('parent.account') }}" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 transition-colors {{ request()->routeIs('parent.account') ? 'bg-gray-700' : '' }}">
            <i class="fas fa-users w-5"></i>
            <span class="ml-3">Parent Account</span>
        </a>
        
        <div class="text-gray-400 uppercase text-xs font-semibold mt-8 mb-2">Others</div>
        
        <a href="#" class="flex items-center px-3 py-2 rounded-md hover:bg-gray-700 transition-colors">
            <i class="fas fa-cog w-5"></i>
            <span class="ml-3">Settings</span>
        </a>
        
        <form method="POST" action="{{ route('logout') }}" class="mt-4">
            @csrf
            <button type="submit" class="w-full flex items-center px-3 py-2 text-left text-white hover:bg-red-600 transition-colors bg-red-500 rounded-md">
                <i class="fas fa-sign-out-alt w-5"></i>
                <span class="ml-3">Logout</span>
            </button>
        </form>
    </nav>
</aside>
