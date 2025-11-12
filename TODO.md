# TODO: Implement Session-Based Role Switching for Dean and Teacher

- [x] Create/update RoleSessionMiddleware to handle dynamic guard switching based on session
- [x] Modify SwitchRoleController to use session tracking instead of logout/login
- [x] Register RoleSessionMiddleware in Kernel.php
- [x] Update dean sidebar to conditionally show Switch Role button only if linked teacher exists
- [x] Update teacher sidebar to show Switch Role button (always visible for deans with teacher accounts)
- [x] Modify ViewAddStaffController to automatically create corresponding teacher account when dean is registered
- [ ] Test role switching maintains session without re-login
- [ ] Verify middleware correctly switches guards
- [ ] Confirm button visibility logic works
- [ ] Test automatic account creation for dean registration
