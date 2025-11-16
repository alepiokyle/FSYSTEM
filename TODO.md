# TODO: Fix Quiz-Performance Results Summary Page Issues

## Database Changes
- [x] Add `is_done` column to `grades` table via migration
- [x] Update Grade model to include `is_done` in fillable

## Controller Updates
- [x] Modify `getGradingStudents` to filter enrolled students where `is_done = 0` and completed where `is_done = 1`
- [x] Add new method `markAsDone` to set `is_done = 1` and update `term_grade`
- [x] Ensure `saveGradingComponent` does not set `is_done` (only for Save button in modal)
- [x] Update `saveFinalGrade` if needed for term-specific saving

## Blade Template Updates
- [x] Ensure modal Save button calls `saveScoreFromModal` without moving student
- [x] Ensure Done button calls new `markAsDone` endpoint
- [x] Update summary table population logic

## JavaScript Updates
- [x] Modify `saveScoreFromModal` to not move student to completed on Save
- [x] Add function to call `markAsDone` on Done button click
- [x] Update `loadSubjectDetails` to properly separate enrolled and completed based on `is_done`
- [x] Ensure summary table only updates on Done or final grade save
- [x] Fix refresh persistence by relying on backend filtering

## Route Updates
- [x] Add new route for `markAsDone` endpoint

## Testing
- [ ] Test Save: Updates components, student stays in edit section
- [ ] Test Done: Moves student to summary, sets `is_done=1`, persists on refresh
- [ ] Test filtering: Completed students not in enrolled list on refresh
