<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SiteSetting;

class EditableMemberCardHeader extends Component
{
    const DEFAULT_TOP    = 'Join';
    const DEFAULT_BOTTOM = 'Designjoy';

    public string $topText    = '';
    public string $bottomText = '';
    public bool   $editing    = false;
    public string $editTop    = '';
    public string $editBottom = '';

    public function mount(): void
    {
        $this->topText    = $this->getSetting('member_card_top',    self::DEFAULT_TOP);
        $this->bottomText = $this->getSetting('member_card_bottom', self::DEFAULT_BOTTOM);
    }

    public function startEditing(): void
    {
        if (! $this->isAdmin()) return;
        $this->editTop    = $this->topText;
        $this->editBottom = $this->bottomText;
        $this->editing    = true;
    }

    public function save(): void
    {
        if (! $this->isAdmin()) return;

        $this->validate([
            'editTop'    => 'required|string|max:100',
            'editBottom' => 'required|string|max:100',
        ]);

        $top    = trim($this->editTop)    ?: self::DEFAULT_TOP;
        $bottom = trim($this->editBottom) ?: self::DEFAULT_BOTTOM;

        SiteSetting::updateOrCreate(['key' => 'member_card_top'],    ['value' => $top]);
        SiteSetting::updateOrCreate(['key' => 'member_card_bottom'], ['value' => $bottom]);

        $this->topText    = $top;
        $this->bottomText = $bottom;
        $this->editing    = false;

        session()->flash('member_card_updated', true);
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
        return view('livewire.editable-member-card-header');
    }
}