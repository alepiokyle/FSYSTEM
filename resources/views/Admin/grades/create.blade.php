@extends('layouts.admin')

@section('content')
    <div class="flex pt-0 pb-12 w-full">
        <main class="flex-1 bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-100">
            <div class="p-6 bg-gray-800 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold text-white mb-4">Add Student Grades</h2>

                <form action="{{ route('grades.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="student_id" class="block text-sm font-medium text-gray-300 mb-2">
                                Student <span class="text-red-400">*</span>
                            </label>
                            <select name="student_id" id="student_id" required
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white">
                                <option value="">-- Select Student --</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }} ({{ $student->id }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="subject_id" class="block text-sm font-medium text-gray-300 mb-2">
                                Subject <span class="text-red-400">*</span>
                            </label>
                            <select name="subject_id" id="subject_id" required
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white">
                                <option value="">-- Select Subject --</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->subject_name }} ({{ $subject->subject_code }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="teacher_id" class="block text-sm font-medium text-gray-300 mb-2">
                                Teacher <span class="text-red-400">*</span>
                            </label>
                            <select name="teacher_id" id="teacher_id" required
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white">
                                <option value="">-- Select Teacher --</option>
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="semester" class="block text-sm font-medium text-gray-300 mb-2">
                                Semester <span class="text-red-400">*</span>
                            </label>
                            <select name="semester" id="semester" required
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white">
                                <option value="">-- Select Semester --</option>
                                <option value="1st">1st Semester</option>
                                <option value="2nd">2nd Semester</option>
                                <option value="Summer">Summer</option>
                            </select>
                        </div>

                        <div>
                            <label for="school_year" class="block text-sm font-medium text-gray-300 mb-2">
                                School Year <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="school_year" id="school_year" placeholder="e.g., 2025-2026" required
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label for="prelim" class="block text-sm font-medium text-gray-300 mb-2">
                                Prelim
                            </label>
                            <input type="number" name="prelim" id="prelim" min="0" max="100" step="0.01"
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white">
                        </div>

                        <div>
                            <label for="midterm" class="block text-sm font-medium text-gray-300 mb-2">
                                Midterm
                            </label>
                            <input type="number" name="midterm" id="midterm" min="0" max="100" step="0.01"
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white">
                        </div>

                        <div>
                            <label for="semi_final" class="block text-sm font-medium text-gray-300 mb-2">
                                Semi-Final
                            </label>
                            <input type="number" name="semi_final" id="semi_final" min="0" max="100" step="0.01"
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white">
                        </div>

                        <div>
                            <label for="final" class="block text-sm font-medium text-gray-300 mb-2">
                                Final
                            </label>
                            <input type="number" name="final" id="final" min="0" max="100" step="0.01"
                                class="w-full px-3 py-2 bg-gray-700 border border-gray-600 rounded-md text-white">
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full md:w-auto px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md">
                            Save Grades
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
@endsection
