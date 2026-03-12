<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SiteSetting;

class EditableMemberCardText extends Component
{
    const DEFAULT_LINE1 = 'Join';
    const DEFAULT_LINE2 = 'Designjoy';
    const DEFAULT_DESC  = 'One subscription to rule them all.';

    public string $line1 = '';
    public string $line2 = '';
    public string $desc  = '';
    public bool   $editing = false;
    public string $editLine1 = '';
    public string $editLine2 = '';
    public string $editDesc  = '';

    public function mount(): void
    {
        $this->line1 = $this->getSetting('member_card_text_line1', self::DEFAULT_LINE1);
        $this->line2 = $this->getSetting('member_card_text_line2', self::DEFAULT_LINE2);
        $this->desc  = $this->getSetting('member_card_text_desc',  self::DEFAULT_DESC);
    }

    public function startEditing(): void
    {
        if (! $this->isAdmin()) return;
        $this->editLine1 = $this->line1;
        $this->editLine2 = $this->line2;
        $this->editDesc  = $this->desc;
        $this->editing   = true;
    }

    public function save(): void
    {
        if (! $this->isAdmin()) return;

        $this->validate([
            'editLine1' => 'required|string|max:100',
            'editLine2' => 'required|string|max:100',
            'editDesc'  => 'required|string|max:200',
        ]);

        $line1 = trim($this->editLine1) ?: self::DEFAULT_LINE1;
        $line2 = trim($this->editLine2) ?: self::DEFAULT_LINE2;
        $desc  = trim($this->editDesc)  ?: self::DEFAULT_DESC;

        SiteSetting::updateOrCreate(['key' => 'member_card_text_line1'], ['value' => $line1]);
        SiteSetting::updateOrCreate(['key' => 'member_card_text_line2'], ['value' => $line2]);
        SiteSetting::updateOrCreate(['key' => 'member_card_text_desc'],  ['value' => $desc]);

        $this->line1   = $line1;
        $this->line2   = $line2;
        $this->desc    = $desc;
        $this->editing = false;

        session()->flash('mct_updated', true);
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
        return view('livewire.editable-member-card-text');
    }
}