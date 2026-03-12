<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SiteSetting;

class EditableHiwHeader extends Component
{
    public string $before  = '';
    public string $italic  = '';
    public string $after   = '';
    public bool   $editing = false;

    public string $editBefore = '';
    public string $editItalic = '';
    public string $editAfter  = '';

    const DEFAULT_BEFORE = 'The way design';
    const DEFAULT_ITALIC = "should've";
    const DEFAULT_AFTER  = 'been done in the first place';

    public function mount(): void
    {
        $this->loadContent();
    }

    private function loadContent(): void
    {
        $setting = SiteSetting::where('key', 'hiw_header')->first();

        if ($setting) {
            $data         = json_decode($setting->value, true) ?? [];
            $this->before = $data['before'] ?? self::DEFAULT_BEFORE;
            $this->italic = $data['italic'] ?? self::DEFAULT_ITALIC;
            $this->after  = $data['after']  ?? self::DEFAULT_AFTER;
        } else {
            $this->before = self::DEFAULT_BEFORE;
            $this->italic = self::DEFAULT_ITALIC;
            $this->after  = self::DEFAULT_AFTER;
        }
    }

    public function isAdmin(): bool
    {
        $user = auth()->user();
        if (! $user) return false;
        if (isset($user->is_admin) && $user->is_admin) return true;
        if (isset($user->role)     && $user->role === 'admin') return true;
        return false;
    }

    public function startEditing(): void
    {
        abort_unless($this->isAdmin(), 403);
        $this->editBefore = $this->before;
        $this->editItalic = $this->italic;
        $this->editAfter  = $this->after;
        $this->editing    = true;
    }

    public function cancel(): void
    {
        $this->editing = false;
    }

    public function save(): void
    {
        abort_unless($this->isAdmin(), 403);

        $this->validate([
            'editBefore' => 'required|string|max:200',
            'editItalic' => 'nullable|string|max:100',
            'editAfter'  => 'required|string|max:200',
        ]);

        SiteSetting::updateOrCreate(
            ['key'   => 'hiw_header'],
            ['value' => json_encode([
                'before' => trim($this->editBefore),
                'italic' => trim($this->editItalic),
                'after'  => trim($this->editAfter),
            ])]
        );

        $this->editing = false;
        $this->loadContent();
        session()->flash('hiw_header_updated', true);
    }

    public function render()
    {
        return view('livewire.editable-hiw-header', [
            'isAdmin' => $this->isAdmin(),
        ]);
    }
}