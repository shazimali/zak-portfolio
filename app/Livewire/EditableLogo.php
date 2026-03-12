<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SiteSetting;

class EditableLogo extends Component
{
    use WithFileUploads;

    const DEFAULT_LOGO = 'assets/images/678548430d58f4cbecec19d7_Designjoy.svg';

    public string $logoPath = '';
    public $newLogo = null;

    public function mount(): void
    {
        $this->logoPath = $this->getLogoPath();
    }

    public function updatedNewLogo(): void
    {
        if (! auth()->check() || ! auth()->user()->is_admin) {
            return;
        }

        $this->validate([
            'newLogo' => 'required|image|mimes:jpeg,jpg,png,gif,svg,webp|max:2048',
        ]);

        $path = $this->newLogo->store('logos', 'public');

        SiteSetting::updateOrCreate(
            ['key' => 'logo_path'],
            ['value' => 'storage/' . $path]
        );

        $this->logoPath = 'storage/' . $path;
        $this->newLogo  = null;

        session()->flash('logo_updated', true);
    }

    private function getLogoPath(): string
    {
        $stored = SiteSetting::where('key', 'logo_path')->value('value');

        // Fall back to default if: null, empty string, or file doesn't exist
        if (empty($stored)) {
            return self::DEFAULT_LOGO;
        }

        // For storage/ paths, verify the file actually exists
        if (str_starts_with($stored, 'storage/')) {
            $relativePath = str_replace('storage/', '', $stored);
            if (! \Storage::disk('public')->exists($relativePath)) {
                return self::DEFAULT_LOGO;
            }
        }

        return $stored;
    }

    public function render()
    {
        return view('livewire.editable-logo');
    }
}