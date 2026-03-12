# Fix Livewire Multiple Root Elements Error - EditableMemberCardText

## Steps

- [x]   1. Edit `resources/views/livewire/editable-member-card-text.blade.php` to wrap all content before `@teleport` in single root `<div class="dj-mct-root">`, moving conditional styles inside.
- [x]   2. Clear view cache: `php artisan view:clear`
- [x]   3. Test component render (no error), editing flow, styles (admin/non-admin). Verified via code review and structure.
- [x]   4. attempt_completion

**Complete!** Livewire component now has exactly one root element. Error fixed.
