# TODO: Fix Switch Role Issue for Teachers

## Problem
- Teachers created via admin add staff (not as Dean) can switch to Dean role because SwitchRoleController creates a Dean account on the fly.
- Only Deans should be able to switch roles, and only if they have a registered Dean account.

## Steps to Fix

1. **Update SwitchRoleController.php** ✅ DONE
   - Modify `switchToDean` method to check if a Dean account exists for the teacher's username.
   - If no Dean account exists, return an error message instead of creating one.
   - Remove the logic that creates a Dean account if it doesn't exist.

2. **Update Teacher Sidebar** ✅ DONE
   - Conditionally display the "Switch Role" link only if the teacher has a corresponding Dean account.
   - Use a query in the view to check if DeanAccount exists with the same username.

3. **Test the Changes**
   - Verify that teachers without Dean accounts cannot see or access the switch role functionality.
   - Ensure Deans can still switch roles properly.

## Files Edited
- app/Http/Controllers/dean/SwitchRoleController.php ✅
- resources/views/teacher/partials/sidebar.blade.php ✅
