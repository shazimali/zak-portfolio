<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SiteSetting;

class EditableSubscribeImage extends Component
{
    use WithFileUploads;

    const DEFAULT_IMAGE = 'assets/images/678548430d58f4cbecec1977_price.svg';

    public string $imagePath = '';
    public $newImage = null;

    public function mount(): void
    {
        $this->imagePath = $this->getImagePath();
    }

    public function updatedNewImage(): void
    {
        if (! $this->isAdmin()) return;

        $this->validate([
            'newImage' => 'required|image|mimes:jpeg,jpg,png,gif,svg,webp|max:2048',
        ]);

        $path = $this->newImage->store('subscribe-image', 'public');

        SiteSetting::updateOrCreate(
            ['key' => 'subscribe_image'],
            ['value' => 'storage/' . $path]
        );

        $this->imagePath = 'storage/' . $path;
        $this->newImage  = null;

        session()->flash('image_updated', true);
    }

    private function getImagePath(): string
    {
        $stored = SiteSetting::where('key', 'subscribe_image')->value('value');

        if (empty($stored)) {
            return self::DEFAULT_IMAGE;
        }

        if (str_starts_with($stored, 'storage/')) {
            $relative = str_replace('storage/', '', $stored);
            if (! \Storage::disk('public')->exists($relative)) {
                return self::DEFAULT_IMAGE;
            }
        }

        return $stored;
    }

    private function isAdmin(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function render()
    {
        return view('livewire.editable-subscribe-image');
    }
}