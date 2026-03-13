<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SiteSetting;

class EditableBenefitsHeading extends Component
{
    public bool $editing = false;

    public string $before = '';
    public string $italic = '';
    public string $after  = '';

    public string $editBefore = '';
    public string $editItalic = '';
    public string $editAfter  = '';

    const DEFAULT_BEFORE = "It's";
    const DEFAULT_ITALIC = "you'll never go back";
    const DEFAULT_AFTER  = 'better';

    public function mount(): void
    {
        $this->loadContent();
    }

    private function loadContent(): void
    {
        $setting = SiteSetting::where('key', 'benefits_hero')->first();
        $data    = $setting ? (json_decode($setting->value, true) ?? []) : [];

        $this->before = $data['before'] ?? self::DEFAULT_BEFORE;
        $this->italic = $data['italic'] ?? self::DEFAULT_ITALIC;
        $this->after  = $data['after']  ?? self::DEFAULT_AFTER;
    }

    private function isAdmin(): bool
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
        $this->dispatch('open-modal', id: 'dj-bh-heading-modal');
    }

    public function save(): void
    {
        abort_unless($this->isAdmin(), 403);
        $this->validate([
            'editBefore' => 'nullable|string|max:100',
            'editItalic' => 'nullable|string|max:150',
            'editAfter'  => 'required|string|max:100',
        ]);

        // Load existing data so we don't overwrite para
        $setting  = SiteSetting::where('key', 'benefits_hero')->first();
        $existing = $setting ? (json_decode($setting->value, true) ?? []) : [];

        $this->before = trim($this->editBefore ?? '');
        $this->italic = trim($this->editItalic ?? '');
        $this->after  = trim($this->editAfter);

        SiteSetting::updateOrCreate(
            ['key'   => 'benefits_hero'],
            ['value' => json_encode([
                'before' => $this->before,
                'italic' => $this->italic,
                'after'  => $this->after,
                'para'   => $existing['para'] ?? '',
            ])]
        );

        $this->editing = false;
        $this->resetValidation();
        $this->dispatch('close-modal', id: 'dj-bh-heading-modal');
        session()->flash('benefits_heading_updated', true);
    }

    public function cancel(): void
    {
        $this->editing = false;
        $this->resetValidation();
        $this->dispatch('close-modal', id: 'dj-bh-heading-modal');
    }

    public function render()
    {
        return view('livewire.editable-benefits-heading', [
            'isAdmin' => $this->isAdmin(),
        ]);
    }
}