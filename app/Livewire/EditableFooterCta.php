<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SiteSetting;

class EditableFooterCta extends Component
{
    public string $heading      = '';
    public string $headingItalic = '';
    public string $subtext      = '';
    public bool   $editing      = false;

    public string $editHeading      = '';
    public string $editHeadingItalic = '';
    public string $editSubtext      = '';

    const DEFAULT_HEADING       = 'See if Designjoy is the right fit for you';
    const DEFAULT_HEADING_ITALIC = '(it totally is)';
    const DEFAULT_SUBTEXT       = 'Schedule a quick, 15 minute guided tour through Designjoy.';

    public function mount(): void
    {
        $this->loadContent();
    }

    private function loadContent(): void
    {
        $setting = SiteSetting::where('key', 'footer_cta')->first();

        if ($setting) {
            $data                  = json_decode($setting->value, true) ?? [];
            $this->heading         = $data['heading']       ?? self::DEFAULT_HEADING;
            $this->headingItalic   = $data['headingItalic'] ?? self::DEFAULT_HEADING_ITALIC;
            $this->subtext         = $data['subtext']       ?? self::DEFAULT_SUBTEXT;
        } else {
            $this->heading         = self::DEFAULT_HEADING;
            $this->headingItalic   = self::DEFAULT_HEADING_ITALIC;
            $this->subtext         = self::DEFAULT_SUBTEXT;
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
        $this->editHeading       = $this->heading;
        $this->editHeadingItalic = $this->headingItalic;
        $this->editSubtext       = $this->subtext;
        $this->editing           = true;
    }

    public function cancel(): void
    {
        $this->editing = false;
    }

    public function save(): void
    {
        abort_unless($this->isAdmin(), 403);

        $this->validate([
            'editHeading'       => 'required|string|max:200',
            'editHeadingItalic' => 'nullable|string|max:100',
            'editSubtext'       => 'required|string|max:300',
        ]);

        SiteSetting::updateOrCreate(
            ['key'   => 'footer_cta'],
            ['value' => json_encode([
                'heading'       => trim($this->editHeading),
                'headingItalic' => trim($this->editHeadingItalic),
                'subtext'       => trim($this->editSubtext),
            ])]
        );

        $this->editing = false;
        $this->loadContent();
        session()->flash('footer_cta_updated', true);
    }

    public function render()
    {
        return view('livewire.editable-footer-cta', [
            'isAdmin' => $this->isAdmin(),
        ]);
    }
}