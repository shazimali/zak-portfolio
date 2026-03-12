<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SiteSetting;

class EditableTestimonial2 extends Component
{
    use WithFileUploads;

    const DEFAULT_QUOTE  = '"Design is everything, and these guys have nailed it."';
    const DEFAULT_AVATAR = 'assets/images/678548430d58f4cbecec19bd_Group_1171274555.png';
    const DEFAULT_NAME   = "Kevin O'Leary";
    const DEFAULT_SOURCE = 'Shark Tank';

    public string $quote      = '';
    public string $avatarPath = '';
    public string $name       = '';
    public string $source     = '';
    public bool   $editing    = false;
    public string $editQuote  = '';
    public string $editName   = '';
    public string $editSource = '';
    public $newAvatar = null;

    public function mount(): void
    {
        $this->quote      = $this->getSetting('testimonial2_quote',  self::DEFAULT_QUOTE);
        $this->name       = $this->getSetting('testimonial2_name',   self::DEFAULT_NAME);
        $this->source     = $this->getSetting('testimonial2_source', self::DEFAULT_SOURCE);
        $this->avatarPath = $this->getAvatarPath();
    }

    public function startEditing(): void
    {
        if (! $this->isAdmin()) return;
        $this->editQuote  = $this->quote;
        $this->editName   = $this->name;
        $this->editSource = $this->source;
        $this->editing    = true;
    }

    public function save(): void
    {
        if (! $this->isAdmin()) return;

        $this->validate([
            'editQuote'  => 'required|string|max:300',
            'editName'   => 'required|string|max:100',
            'editSource' => 'required|string|max:100',
        ]);

        $quote  = trim($this->editQuote)  ?: self::DEFAULT_QUOTE;
        $name   = trim($this->editName)   ?: self::DEFAULT_NAME;
        $source = trim($this->editSource) ?: self::DEFAULT_SOURCE;

        SiteSetting::updateOrCreate(['key' => 'testimonial2_quote'],  ['value' => $quote]);
        SiteSetting::updateOrCreate(['key' => 'testimonial2_name'],   ['value' => $name]);
        SiteSetting::updateOrCreate(['key' => 'testimonial2_source'], ['value' => $source]);

        $this->quote   = $quote;
        $this->name    = $name;
        $this->source  = $source;
        $this->editing = false;

        session()->flash('t2_updated', true);
    }

    public function updatedNewAvatar(): void
    {
        if (! $this->isAdmin()) return;

        $this->validate([
            'newAvatar' => 'required|image|mimes:jpeg,jpg,png,gif,svg,webp|max:2048',
        ]);

        $path = $this->newAvatar->store('testimonials', 'public');

        SiteSetting::updateOrCreate(['key' => 'testimonial2_avatar'], ['value' => 'storage/' . $path]);

        $this->avatarPath = 'storage/' . $path;
        $this->newAvatar  = null;

        session()->flash('t2_avatar_updated', true);
    }

    public function cancel(): void
    {
        $this->editing = false;
    }

    private function getAvatarPath(): string
    {
        $stored = SiteSetting::where('key', 'testimonial2_avatar')->value('value');
        if (empty($stored)) return self::DEFAULT_AVATAR;
        if (str_starts_with($stored, 'storage/')) {
            if (! \Storage::disk('public')->exists(str_replace('storage/', '', $stored))) {
                return self::DEFAULT_AVATAR;
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
        return view('livewire.editable-testimonial2');
    }
}