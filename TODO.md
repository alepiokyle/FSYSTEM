# TODO: Implement Profile Picture Upload for Student Section

## Steps to Complete

1. **Create Migration**: Add `profile_picture` column to `users_profile` table.
2. **Run Migration**: Execute the migration to update the database.
3. **Update UsersProfile Model**: Add `profile_picture` to fillable array.
4. **Update SectionController**: Add `uploadProfilePicture` method to handle file upload.
5. **Add Route**: Add POST route for `/student/upload-profile-picture`.
6. **Update View**: Modify `Section.blade.php` to display uploaded picture and handle upload via JavaScript.

## Progress
- [x] Step 1: Create Migration
- [x] Step 2: Run Migration
- [x] Step 3: Update Model
- [x] Step 4: Update Controller
- [x] Step 5: Add Route
- [x] Step 6: Update View
