<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SiteSetting;

class EditableBenefitsHero extends Component
{
    public string $before  = '';
    public string $italic  = '';
    public string $after   = '';
    public string $para    = '';
    public bool   $editing = false;

    public string $editBefore = '';
    public string $editItalic = '';
    public string $editAfter  = '';
    public string $editPara   = '';

    const DEFAULT_BEFORE  = "It's";
    const DEFAULT_ITALIC  = '"you\'ll never go back"';
    const DEFAULT_AFTER   = 'better';
    const DEFAULT_PARA    = 'Designjoy replaces unreliable freelancers and expensive agencies for one flat monthly fee, with designs delivered so fast you won\'t want to go anywhere else.';

    public function mount(): void
    {
        $this->loadContent();
    }

    private function loadContent(): void
    {
        $setting = SiteSetting::where('key', 'benefits_hero')->first();

        if ($setting) {
            $data         = json_decode($setting->value, true) ?? [];
            $this->before = $data['before'] ?? self::DEFAULT_BEFORE;
            $this->italic = $data['italic'] ?? self::DEFAULT_ITALIC;
            $this->after  = $data['after']  ?? self::DEFAULT_AFTER;
            $this->para   = $data['para']   ?? self::DEFAULT_PARA;
        } else {
            $this->before = self::DEFAULT_BEFORE;
            $this->italic = self::DEFAULT_ITALIC;
            $this->after  = self::DEFAULT_AFTER;
            $this->para   = self::DEFAULT_PARA;
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
        $this->editPara   = $this->para;
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
            'editBefore' => 'required|string|max:100',
            'editItalic' => 'nullable|string|max:150',
            'editAfter'  => 'required|string|max:100',
            'editPara'   => 'required|string|max:500',
        ]);

        SiteSetting::updateOrCreate(
            ['key'   => 'benefits_hero'],
            ['value' => json_encode([
                'before' => trim($this->editBefore),
                'italic' => trim($this->editItalic),
                'after'  => trim($this->editAfter),
                'para'   => trim($this->editPara),
            ])]
        );

        $this->editing = false;
        $this->loadContent();
        session()->flash('benefits_hero_updated', true);
    }

    public function render()
    {
        return view('livewire.editable-benefits-hero', [
            'isAdmin' => $this->isAdmin(),
        ]);
    }
}