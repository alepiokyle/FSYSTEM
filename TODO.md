# Admin Grade Section - Design & Centering Improvements

## Current Status: In Progress

### Completed Tasks:
- [ ] Improve design and center content in Grade.blade.php

### Remaining Tasks:
- [ ] Test responsive design
- [ ] Verify content centering on different screen sizes
- [ ] Check visual improvements

## Changes Made:
1. **Design Improvements:**
   - Enhanced glass morphism effects
   - Better color scheme and typography
   - Improved spacing and visual hierarchy
   - Added subtle hover effects

2. **Content Centering:**
   - Centered main content area
   - Improved layout structure
   - Better alignment of elements
   - Responsive centering

## Files Modified:
- `resources/views/admin/Views/Grade.blade.php` - Main design and centering improvements

---

# Upload Subject Department Select - Dynamic Loading

## Status: Completed

### Task:
- Make the select department in upload subject form display departments from the database table instead of hardcoded options.

### Changes Made:
1. **Controller Update:**
   - Added `use App\Models\Department;` import in `UploadController.php`
   - Modified `index()` method to fetch all departments: `$departments = Department::all();`
   - Passed departments to the view: `compact('subjects', 'departments')`

2. **View Update:**
   - Replaced hardcoded department options in `resources/views/admin/uploadSubject/subject.blade.php`
   - Used `@foreach($departments as $department)` to dynamically populate select options
   - Each option uses `value="{{ $department->name }}"` and displays `{{ $department->name }}`

### Files Modified:
- `app/Http/Controllers/UploadController.php` - Added department fetching
- `resources/views/admin/uploadSubject/subject.blade.php` - Dynamic department options

### Result:
- Department select now loads from seeded departments (Computer Science, Information Technology, Business Administration, etc.)
- Form submission remains compatible as department is stored as string in subjects table

---

# Dean SubjectLoading - Department Filtering

## Status: Completed

### Task:
- Filter subjects in the dean SubjectLoading page to show only those matching the logged-in dean's department.

### Changes Made:
1. **Controller Update:**
   - Added `use Illuminate\Support\Facades\Auth;` import in `SubjectLoadingController.php`
   - Modified `index()` method to:
     - Get authenticated dean: `$dean = Auth::guard('dean')->user();`
     - Retrieve department name: `$departmentName = $dean->profile->department->name;`
     - Filter subjects: `Subject::where('department', $departmentName)->orderBy('created_at', 'desc')->get();`

### Files Modified:
- `app/Http/Controllers/dean/SubjectLoadingController.php` - Added department-based filtering

### Result:
- Deans now see only subjects from their department (e.g., Computer Science dean sees only 'Computer Science' subjects)
- Maintains existing ordering and delete functionality
- Compatible with string-based department storage in subjects table

---

# SubjectLoading - Dynamic Student Select

## Status: Completed

### Task:
- Make the "select students" input in the SubjectLoading page display newly added students dynamically instead of hardcoded options.

### Changes Made:
1. **Controller Update:**
   - Added `use App\Models\User;` import in `SubjectLoadingController.php`
   - Modified `index()` method to fetch all students: `$students = User::where('user_role_id', 7)->with('profile')->get();`
   - Passed students to view: `compact('subjects', 'students')`

2. **View Update:**
   - Replaced hardcoded student options in `resources/views/Dean/SubjectLoading/loading.blade.php`
   - Used `@foreach($students as $student)` to dynamically populate select options with null check
   - Each option uses `value="{{ $student->profile->student_id }}"` and displays `{{ $student->profile->student_id }} - {{ $student->profile->first_name }} {{ $student->profile->last_name }}`

3. **Model Fix:**
   - Fixed User model profile relationship from `belongsTo` to `hasOne` with correct foreign key

### Files Modified:
- `app/Http/Controllers/dean/SubjectLoadingController.php` - Added student fetching
- `resources/views/Dean/SubjectLoading/loading.blade.php` - Dynamic student options with null check
- `app/Models/User.php` - Fixed profile relationship

### Result:
- Student select now loads from database (e.g., S001 - John Doe, S002 - Jane Smith, etc.)
- Newly added students will automatically appear in the dropdown
- Compatible with existing student profile structure
