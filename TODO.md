# TODO: Implement Final Grade Calculation Based on Term and Semester Selection

## Tasks
- [x] Add Term and Semester selectors to assessment.blade.php page
- [x] Update the "Term-Based Grading Computation" modal to include Term and Semester selection
- [x] Modify JavaScript to send term and semester data when computing/saving grades
- [x] Update the controller to handle term and semester in the grade calculation and saving process
- [x] Ensure the computed final grade displays in the Term Grade column after clicking Done
- [x] Fix "Failed to save final grade. Please try again" error by adding missing semester validation and saveFinalGradeFromSummary method

## Files to Edit
- [x] resources/views/teacher/Manages/assessment.blade.php
- [x] app/Http/Controllers/teacher/TeacherController.php
