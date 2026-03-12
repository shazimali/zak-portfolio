<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SiteSetting;

class EditableHeroHeading extends Component
{
    const DEFAULT_MAIN   = 'Design subscriptions for';
    const DEFAULT_ITALIC = 'everyone';

    public string $mainText   = '';
    public string $italicText = '';
    public bool   $editing    = false;
    public string $editMain   = '';
    public string $editItalic = '';

    public function mount(): void
    {
        $this->mainText   = $this->getSetting('hero_heading_main',   self::DEFAULT_MAIN);
        $this->italicText = $this->getSetting('hero_heading_italic', self::DEFAULT_ITALIC);
    }

    public function startEditing(): void
    {
        if (! $this->isAdmin()) return;
        $this->editMain   = $this->mainText;
        $this->editItalic = $this->italicText;
        $this->editing    = true;
    }

    public function save(): void
    {
        if (! $this->isAdmin()) return;

        $this->validate([
            'editMain'   => 'required|string|max:200',
            'editItalic' => 'required|string|max:100',
        ]);

        $main   = trim($this->editMain)   ?: self::DEFAULT_MAIN;
        $italic = trim($this->editItalic) ?: self::DEFAULT_ITALIC;

        SiteSetting::updateOrCreate(['key' => 'hero_heading_main'],   ['value' => $main]);
        SiteSetting::updateOrCreate(['key' => 'hero_heading_italic'], ['value' => $italic]);

        $this->mainText   = $main;
        $this->italicText = $italic;
        $this->editing    = false;

        session()->flash('heading_updated', true);
    }

    public function cancel(): void
    {
        $this->editing = false;
    }

    private function isAdmin(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    private function getSetting(string $key, string $default): string
    {
        $value = SiteSetting::where('key', $key)->value('value');
        return empty($value) ? $default : $value;
    }

    public function render()
    {
        return view('livewire.editable-hero-heading');
    }
}