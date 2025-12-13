# Task: Display Quiz–Performance Results Summary Data in Dean PostGrades Modal

## Overview
Implement functionality to display saved data from the "Quiz–Performance Results Summary" table in teacher/Manage section in the "Student Term Grades" modal in dean/PostGrades section for a specific term.

## Completed Tasks
- [x] Analyzed the task requirements and existing code structure
- [x] Identified relevant files: attendance.blade.php (teacher/Manage), post.blade.php (dean/PostGrades), PostGradesController.php
- [x] Updated post.blade.php to add term select in the modal and simplified table to show Student ID, Name, Term Grade, Remarks
- [x] Updated JavaScript in post.blade.php to load grades based on selected term
- [x] Modified PostGradesController.php fetchGrades method to handle term parameter and filter grades accordingly

## Pending Tasks
- [ ] Test the implementation to ensure data displays correctly for each term
- [ ] Verify that saved data from teacher/Manage appears in the modal after clicking "View Grades"
- [ ] Check for any edge cases or errors in the implementation

## Notes
- The modal now filters grades by the selected term (prelim, midterm, semi-final, final)
- When a term is selected, term_grade shows the value for that specific term
- Remarks are adjusted based on the term grade (Passed/Failed/Incomplete)
- If no term is selected, it shows a message to select a term
