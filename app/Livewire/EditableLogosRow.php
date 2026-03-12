<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SiteSetting;

class EditableLogosRow extends Component
{
    use WithFileUploads;

    public array $logos    = [];
    public array $previews = [];
    public bool  $editing  = false;

    public $upload0 = null;
    public $upload1 = null;
    public $upload2 = null;
    public $upload3 = null;
    public $upload4 = null;

    // Keys MUST be 0-4 integers so $logos[$i] always resolves
    const DEFAULTS = [
        0 => 'assets/images/678548430d58f4cbecec1986_Nectar-sleep-logo-vector_1.svg',
        1 => 'assets/images/678548430d58f4cbecec1987_bmc-full-logo_1.svg',
        2 => 'assets/images/678548430d58f4cbecec198a_svg.svg',
        3 => 'assets/images/678548430d58f4cbecec1989_Vector.svg',
        4 => 'assets/images/678548430d58f4cbecec1988_6203180d8e14605fb2d2c003_Vector_1.svg',
    ];

    public function mount(): void
    {
        $this->loadLogos();
        $this->previews = array_fill(0, 5, null);
    }

    // ── Preview hooks (fire when Livewire finishes chunking the file) ──────
    public function updatedUpload0(): void { $this->previews[0] = $this->upload0?->temporaryUrl(); }
    public function updatedUpload1(): void { $this->previews[1] = $this->upload1?->temporaryUrl(); }
    public function updatedUpload2(): void { $this->previews[2] = $this->upload2?->temporaryUrl(); }
    public function updatedUpload3(): void { $this->previews[3] = $this->upload3?->temporaryUrl(); }
    public function updatedUpload4(): void { $this->previews[4] = $this->upload4?->temporaryUrl(); }

    // ── Admin helper ───────────────────────────────────────────────────────
    public function isAdmin(): bool
    {
        $user = auth()->user();
        if (! $user) return false;
        if (isset($user->is_admin) && $user->is_admin) return true;
        if (isset($user->role)     && $user->role === 'admin') return true;
        return false;
    }

    // ── Actions ────────────────────────────────────────────────────────────
    public function startEditing(): void
    {
        abort_unless($this->isAdmin(), 403);
        $this->editing = true;
    }

    public function cancel(): void
    {
        $this->editing = false;
        $this->clearUploads();
    }

    public function save(): void
    {
        abort_unless($this->isAdmin(), 403);

        $this->validate([
            'upload0' => 'nullable|file|max:2048',
            'upload1' => 'nullable|file|max:2048',
            'upload2' => 'nullable|file|max:2048',
            'upload3' => 'nullable|file|max:2048',
            'upload4' => 'nullable|file|max:2048',
        ]);

        $uploads = [
            0 => $this->upload0,
            1 => $this->upload1,
            2 => $this->upload2,
            3 => $this->upload3,
            4 => $this->upload4,
        ];

        foreach ($uploads as $i => $file) {
            if ($file) {
                $path = $file->store('logos', 'public');
                SiteSetting::updateOrCreate(
                    ['key'   => "logo_row_{$i}"],
                    ['value' => 'storage/' . $path]   // stored as relative path
                );
            }
        }

        $this->editing = false;
        $this->clearUploads();
        $this->loadLogos();
        session()->flash('logos_updated', true);
    }

    public function resetLogo(int $index): void
    {
        abort_unless($this->isAdmin(), 403);
        SiteSetting::where('key', "logo_row_{$index}")->delete();
        $this->loadLogos();
        session()->flash('logos_updated', true);
    }

    // ── Helpers ────────────────────────────────────────────────────────────

    /**
     * Always returns a value for every slot 0-4.
     * DB value  → used as-is (relative path, asset() applied in blade)
     * No DB row → falls back to self::DEFAULTS[$i]
     */
    private function loadLogos(): void
    {
        $this->logos = [];
        foreach (range(0, 4) as $i) {
            $setting          = SiteSetting::where('key', "logo_row_{$i}")->first();
            $this->logos[$i]  = $setting?->value ?? self::DEFAULTS[$i];
        }
    }

    private function clearUploads(): void
    {
        $this->upload0 = $this->upload1 = $this->upload2 =
        $this->upload3 = $this->upload4 = null;
        $this->previews = array_fill(0, 5, null);
    }

    public function render()
    {
        return view('livewire.editable-logos-row', [
            'isAdmin' => $this->isAdmin(),
        ]);
    }
}