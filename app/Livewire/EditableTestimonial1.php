<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SiteSetting;

class EditableTestimonial1 extends Component
{
    use WithFileUploads;

    const DEFAULT_QUOTE = '"Designjoy shows that they know the art of subtlety."';
    const DEFAULT_LOGO  = 'assets/images/678199f71b779683c0d14a8f_65dd4dae1c85fee7c339650a_Webflow_logo_2023_(1)_1.svg';

    public string $quote    = '';
    public string $logoPath = '';
    public bool   $editing  = false;
    public string $editQuote = '';
    public $newLogo = null;

    public function mount(): void
    {
        $this->quote    = $this->getSetting('testimonial1_quote', self::DEFAULT_QUOTE);
        $this->logoPath = $this->getLogoPath();
    }

    public function startEditing(): void
    {
        if (! $this->isAdmin()) return;
        $this->editQuote = $this->quote;
        $this->editing   = true;
    }

    public function save(): void
    {
        if (! $this->isAdmin()) return;

        $this->validate([
            'editQuote' => 'required|string|max:300',
        ]);

        $quote = trim($this->editQuote) ?: self::DEFAULT_QUOTE;

        SiteSetting::updateOrCreate(['key' => 'testimonial1_quote'], ['value' => $quote]);

        $this->quote   = $quote;
        $this->editing = false;

        session()->flash('t1_updated', true);
    }

    public function updatedNewLogo(): void
    {
        if (! $this->isAdmin()) return;

        $this->validate([
            'newLogo' => 'required|image|mimes:jpeg,jpg,png,gif,svg,webp|max:2048',
        ]);

        $path = $this->newLogo->store('testimonials', 'public');

        SiteSetting::updateOrCreate(['key' => 'testimonial1_logo'], ['value' => 'storage/' . $path]);

        $this->logoPath = 'storage/' . $path;
        $this->newLogo  = null;

        session()->flash('t1_logo_updated', true);
    }

    public function cancel(): void
    {
        $this->editing = false;
    }

    private function getLogoPath(): string
    {
        $stored = SiteSetting::where('key', 'testimonial1_logo')->value('value');
        if (empty($stored)) return self::DEFAULT_LOGO;
        if (str_starts_with($stored, 'storage/')) {
            if (! \Storage::disk('public')->exists(str_replace('storage/', '', $stored))) {
                return self::DEFAULT_LOGO;
            }
        }
        return $stored;
    }

    private function getSetting(string $key, string $default): string
    {
        $value = SiteSetting::where('key', $key)->value('value');
        return empty($value) ? $default : $value;
    }

    private function isAdmin(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function render()
    {
        return view('livewire.editable-testimonial1');
    }
}