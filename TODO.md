# Profile Image Upload Fix for Students

## Tasks
- [x] Modify SectionController.php to store images in subfolders by user ID (e.g., public/profile_pictures/{$user->id}/filename)
- [x] Update profile_picture column storage to include user ID folder in path (e.g., '182/filename.jpg')
- [x] Update delete logic in SectionController to handle new path structure
- [x] Update Section.blade.php view to use new path in img src
- [x] Update header.blade.php view to use new path in img src
- [x] Ensure storage link is active (php artisan storage:link)
- [ ] Test upload and display functionality
- [ ] Handle existing files if necessary (optional, focus on new uploads)
