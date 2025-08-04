<x-app-layout>
    <div class="flex pt-0 pb-12 w-full">
        <!-- Sidebar -->
        @include('Admin.sidebar')

      <main class="flex-1 bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-100">
    <div class="p-6 bg-gray-800 rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold text-white mb-4">Upload Subjects</h2>

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-600 text-white rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-4 p-4 bg-red-600 text-white rounded">
                {{ session('error') }}
            </div>
        @endif

    <form action="{{ route('subjects.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Department -->
            <div>
                <label for="department" class="block text-sm font-medium text-gray-300 mb-2">
                    Department <span class="text-red-400">*</span>
                </label>
                <select id="department" name="department" onchange="updateSubjects(); generateSubjectCode()" required
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Select Department --</option>
                    <option value="BSIT">BSIT</option>
                    <option value="BSCS">BSCS</option>
                </select>
            </div>

            <!-- Subject Name -->
            <div>
                <label for="subject_name" class="block text-sm font-medium text-gray-300 mb-2">
                    Subject Name <span class="text-red-400">*</span>
                </label>
                <select id="subject_name" name="subject_name" onchange="generateSubjectCode(); autoFillUnits();" required
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Select Subject --</option>
                    <!-- Subjects will be populated dynamically -->
                </select>
            </div>

            <!-- Subject Code (auto-generated) -->
            <div>
                <label for="subject_code" class="block text-sm font-medium text-gray-300 mb-2">
                    Subject Code <span class="text-red-400">*</span>
                </label>
                <input type="text" id="subject_code" name="subject_code" readonly required
                    class="w-full px-3 py-2 bg-gray-600 border border-gray-500 rounded-md text-white cursor-not-allowed"
                    placeholder="Auto-generated">
            </div>

            <!-- Units (auto-filled) -->
            <div>
                <label for="units" class="block text-sm font-medium text-gray-300 mb-2">
                    Units <span class="text-red-400">*</span>
                </label>
                <input type="number" id="units" name="units" readonly required
                    class="w-full px-3 py-2 bg-gray-600 border border-gray-500 rounded-md text-white cursor-not-allowed"
                    placeholder="Auto-filled">
            </div>

            <!-- Year Level -->
            <div>
                <label for="year_level" class="block text-sm font-medium text-gray-300 mb-2">
                    Year Level <span class="text-red-400">*</span>
                </label>
                <select id="year_level" name="year_level" onchange="generateSubjectCode()" required
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Select Year Level --</option>
                    <option value="1st">1st Year</option>
                    <option value="2nd">2nd Year</option>
                    <option value="3rd">3rd Year</option>
                    <option value="4th">4th Year</option>
                </select>
            </div>

            <!-- Semester -->
            <div>
                <label for="semester" class="block text-sm font-medium text-gray-300 mb-2">
                    Semester <span class="text-red-400">*</span>
                </label>
                <select id="semester" name="semester" required
                    class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Select Semester --</option>
                    <option value="1st">1st Semester</option>
                    <option value="2nd">2nd Semester</option>
                </select>
            </div>
        </div>

        <!-- School Year -->
        <div>
            <label for="school_year" class="block text-sm font-medium text-gray-300 mb-2">
                School Year <span class="text-red-400">*</span>
            </label>
            <input type="text" id="school_year" name="school_year" placeholder="e.g., 2025-2026" required
                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button type="submit" 
                class="w-full md:w-auto px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-gray-800 transition duration-200">
                <i class="fas fa-upload mr-2"></i>Upload Subject
            </button>
        </div>
    </form>


       
</main>

<script>
// Department-specific subjects with units
const departmentSubjects = {
    'BSIT': [
        { name: 'Web Systems', units: 3 },
        { name: 'Data Structures', units: 3 },
        { name: 'Object-Oriented Programming', units: 3 },
        { name: 'Database Management Systems', units: 3 },
        { name: 'Software Engineering', units: 3 },
        { name: 'Mobile Application Development', units: 3 },
        { name: 'Computer Networks', units: 3 },
        { name: 'Information Assurance and Security', units: 3 },
        { name: 'Systems Integration and Architecture', units: 3 },
        { name: 'IT Capstone Project 1', units: 3 },
        { name: 'IT Capstone Project 2', units: 3 }
    ],
    'BSCS': [
        { name: 'Calculus 1', units: 3 },
        { name: 'Discrete Mathematics', units: 3 },
        { name: 'Data Structures and Algorithms', units: 3 },
        { name: 'Computer Programming 1', units: 3 },
        { name: 'Computer Programming 2', units: 3 },
        { name: 'Computer Architecture', units: 3 },
        { name: 'Operating Systems', units: 3 },
        { name: 'Theory of Computation', units: 3 },
        { name: 'Design and Analysis of Algorithms', units: 3 },
        { name: 'Software Engineering', units: 3 },
        { name: 'CS Capstone Project 1', units: 3 },
        { name: 'CS Capstone Project 2', units: 3 }
    ]
};

// Function to update subjects based on selected department
function updateSubjects() {
    const department = document.getElementById('department').value;
    const subjectSelect = document.getElementById('subject_name');
    
    // Clear existing options
    subjectSelect.innerHTML = '<option value="">-- Select Subject --</option>';
    
    if (department && departmentSubjects[department]) {
        // Add subjects for the selected department
        departmentSubjects[department].forEach(subject => {
            const option = document.createElement('option');
            option.value = subject.name;
            option.textContent = subject.name;
            option.setAttribute('data-units', subject.units);
            subjectSelect.appendChild(option);
        });
    }
    
    // Reset subject code and units when department changes
    document.getElementById('subject_code').value = '';
    document.getElementById('units').value = '';
}

// Function to auto-fill units based on selected subject
function autoFillUnits() {
    const subjectSelect = document.getElementById('subject_name');
    const selectedOption = subjectSelect.options[subjectSelect.selectedIndex];
    const units = selectedOption.getAttribute('data-units');
    
    if (units) {
        document.getElementById('units').value = units;
    } else {
        document.getElementById('units').value = '';
    }
}

// Function to generate subject code (existing functionality)
function generateSubjectCode() {
    const department = document.getElementById('department').value;
    const subjectName = document.getElementById('subject_name').value;
    const yearLevel = document.getElementById('year_level').value;
    
    if (department && subjectName && yearLevel) {
        // Create subject code based on department, subject, and year level
        const deptCode = department.substring(0, 4).toUpperCase();
        const subjectCode = subjectName.split(' ').map(word => word.charAt(0)).join('').toUpperCase();
        const yearCode = yearLevel.charAt(0);
        
        document.getElementById('subject_code').value = `${deptCode}${subjectCode}${yearCode}`;
    } else {
        document.getElementById('subject_code').value = '';
    }
}

// Initialize subjects on page load
document.addEventListener('DOMContentLoaded', function() {
    updateSubjects();
});
</script>

</x-app-layout>
