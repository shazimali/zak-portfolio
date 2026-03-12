<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\SiteSetting;

class EditableMarquee extends Component
{
    use WithFileUploads;

    const DEFAULTS = [
        1 => 'assets/images/678548430d58f4cbecec19ea_Group_1171274558.png',
        2 => 'assets/images/678548430d58f4cbecec19ee_Group_1171274560.png',
        3 => 'assets/images/678548430d58f4cbecec19de_Group_1171274563.png',
        4 => 'assets/images/678548430d58f4cbecec19e6_Group_1171274559.png',
        5 => 'assets/images/678548430d58f4cbecec19e2_Group_1171274561.png',
        6 => 'assets/images/678548430d58f4cbecec19da_Group_1171274562.png',
    ];

    public array $images = [];
    public bool  $editing = false;

    public $upload1 = null;
    public $upload2 = null;
    public $upload3 = null;
    public $upload4 = null;
    public $upload5 = null;
    public $upload6 = null;

    public function mount(): void
    {
        $this->loadImages();
    }

    public function openEditor(): void
    {
        if (! $this->isAdmin()) return;
        $this->editing = true;
    }

    public function closeEditor(): void
    {
        $this->editing = false;
    }

    public function updatedUpload1() { $this->handleUpload(1, $this->upload1); $this->upload1 = null; }
    public function updatedUpload2() { $this->handleUpload(2, $this->upload2); $this->upload2 = null; }
    public function updatedUpload3() { $this->handleUpload(3, $this->upload3); $this->upload3 = null; }
    public function updatedUpload4() { $this->handleUpload(4, $this->upload4); $this->upload4 = null; }
    public function updatedUpload5() { $this->handleUpload(5, $this->upload5); $this->upload5 = null; }
    public function updatedUpload6() { $this->handleUpload(6, $this->upload6); $this->upload6 = null; }

    private function handleUpload(int $slot, $file): void
    {
        if (! $this->isAdmin() || ! $file) return;

        $this->validateOnly("upload{$slot}", [
            "upload{$slot}" => 'required|image|mimes:jpeg,jpg,png,gif,svg,webp|max:2048',
        ]);

        $path = $file->store('marquee', 'public');
        SiteSetting::updateOrCreate(
            ['key' => "marquee_image_{$slot}"],
            ['value' => 'storage/' . $path]
        );

        $this->images[$slot] = 'storage/' . $path;
    }

    public function resetImage(int $slot): void
    {
        if (! $this->isAdmin()) return;
        SiteSetting::where('key', "marquee_image_{$slot}")->delete();
        $this->images[$slot] = self::DEFAULTS[$slot];
    }

    private function loadImages(): void
    {
        foreach (self::DEFAULTS as $slot => $default) {
            $stored = SiteSetting::where('key', "marquee_image_{$slot}")->value('value');
            if (empty($stored)) { $this->images[$slot] = $default; continue; }
            if (str_starts_with($stored, 'storage/')) {
                if (! \Storage::disk('public')->exists(str_replace('storage/', '', $stored))) {
                    $this->images[$slot] = $default; continue;
                }
            }
            $this->images[$slot] = $stored;
        }
    }

    private function isAdmin(): bool
    {
        return auth()->check() && auth()->user()->is_admin;
    }

    public function render()
    {
        return view('livewire.editable-marquee');
    }
}