<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SiteSetting;

class EditableBenefitsPara extends Component
{
    public bool $editing = false;

    public string $para     = '';
    public string $editPara = '';

    const DEFAULT_PARA = "Designjoy replaces unreliable freelancers and expensive agencies for one flat monthly fee, with designs delivered so fast you won't want to go anywhere else.";

    public function mount(): void
    {
        $this->loadContent();
    }

    private function loadContent(): void
    {
        $setting = SiteSetting::where('key', 'benefits_hero')->first();
        $data    = $setting ? (json_decode($setting->value, true) ?? []) : [];

        $this->para = $data['para'] ?? self::DEFAULT_PARA;
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
        $this->editPara = $this->para;
        $this->editing  = true;
        $this->dispatch('open-modal', id: 'dj-bh-para-modal');
    }

    public function save(): void
    {
        abort_unless($this->isAdmin(), 403);
        $this->validate(['editPara' => 'required|string|max:500']);

        // Load existing data so we don't overwrite heading
        $setting  = SiteSetting::where('key', 'benefits_hero')->first();
        $existing = $setting ? (json_decode($setting->value, true) ?? []) : [];

        $this->para = trim($this->editPara);

        SiteSetting::updateOrCreate(
            ['key'   => 'benefits_hero'],
            ['value' => json_encode([
                'before' => $existing['before'] ?? '',
                'italic' => $existing['italic'] ?? '',
                'after'  => $existing['after']  ?? '',
                'para'   => $this->para,
            ])]
        );

        $this->editing = false;
        $this->resetValidation();
        $this->dispatch('close-modal', id: 'dj-bh-para-modal');
        session()->flash('benefits_para_updated', true);
    }

    public function cancel(): void
    {
        $this->editing = false;
        $this->resetValidation();
        $this->dispatch('close-modal', id: 'dj-bh-para-modal');
    }

    public function render()
    {
        return view('livewire.editable-benefits-para', [
            'isAdmin' => $this->isAdmin(),
        ]);
    }
}