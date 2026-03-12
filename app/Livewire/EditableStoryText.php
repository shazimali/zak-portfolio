<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SiteSetting;

class EditableStoryText extends Component
{
    const DEFAULT_TEXT = 'First launched in 2017, Designjoy <span class="text-italics">revolutionized</span> the design industry with its subscription-based model. To this day, Designjoy is run entirely by <a href="https://x.com/BrettFromDJ" target="_blank" class="link">Brett</a>. Designjoy doesn\'t hire extra designers or outsource work—instead, it focuses on delivering top-notch quality to a limited roster of clients at a time.';

    public string $storyText = '';
    public bool   $editing   = false;
    public string $editText  = '';

    public function mount(): void
    {
        $this->storyText = $this->getSetting('story_text', self::DEFAULT_TEXT);
    }

    public function startEditing(): void
    {
        if (! $this->isAdmin()) return;
        $this->editText = $this->storyText;
        $this->editing  = true;
    }

    public function save(string $html): void
    {
        if (! $this->isAdmin()) return;

        // Strip dangerous tags, keep safe formatting ones
        $clean = strip_tags($html, '<b><strong><em><i><a><span><br><p>');

        // Force target="_blank" and rel on all links
        $clean = preg_replace_callback('/<a\s[^>]*>/i', function ($matches) {
            $tag = $matches[0];
            // Remove existing target/rel
            $tag = preg_replace('/\s*target=["\'][^"\']*["\']/i', '', $tag);
            $tag = preg_replace('/\s*rel=["\'][^"\']*["\']/i', '', $tag);
            // Inject safe attributes
            $tag = rtrim($tag, '>') . ' target="_blank" rel="noopener noreferrer">';
            return $tag;
        }, $clean);

        $text = trim($clean) ?: self::DEFAULT_TEXT;

        SiteSetting::updateOrCreate(
            ['key' => 'story_text'],
            ['value' => $text]
        );

        $this->storyText = $text;
        $this->editing   = false;

        session()->flash('story_updated', true);
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
        return view('livewire.editable-story-text');
    }
}