# TODO: Remove Edit User Profile in Admin

## Step 1: Update the Admin Staff View
- [x] Remove "Edit" buttons from dean and teacher rows in `resources/views/admin/AddStaff/addstaff.blade.php`
- [x] Remove the `editStaff` JavaScript function
- [x] Remove edit-related logic from modal (hidden staff_id input, update action, etc.)

## Step 2: Update Routes
- [x] Comment out PUT routes for dean and teacher updates in `routes/web.php`

## Step 3: Update Controller
- [x] Comment out `updateDean` and `updateTeacher` methods in `app/Http/Controllers/Admin/ViewAddStaffController.php`
