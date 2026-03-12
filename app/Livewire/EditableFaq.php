<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SiteSetting;

class EditableFaq extends Component
{
    public array $faqs    = [];   // rendered list
    public bool  $editing = false;

    // Modal state
    public array  $editFaqs    = [];  // working copy while modal is open
    public string $newQuestion = '';
    public string $newAnswer   = '';

    public function mount(): void
    {
        $this->loadFaqs();
    }

    // ── Admin helper ───────────────────────────────────────────────────────
    public function isAdmin(): bool
    {
        $user = auth()->user();
        if (! $user) return false;
        if (isset($user->is_admin) && $user->is_admin) return true;
        if (isset($user->role)     && $user->role === 'admin') return true;
        return false;
    }

    // ── Load from DB (no defaults — empty array if nothing saved) ─────────
    private function loadFaqs(): void
    {
        $setting    = SiteSetting::where('key', 'faq_items')->first();
        $this->faqs = $setting ? json_decode($setting->value, true) ?? [] : [];
    }

    // ── Actions ────────────────────────────────────────────────────────────
    public function startEditing(): void
    {
        abort_unless($this->isAdmin(), 403);
        $this->editFaqs    = $this->faqs;
        $this->newQuestion = '';
        $this->newAnswer   = '';
        $this->editing     = true;
    }

    public function cancel(): void
    {
        $this->editing     = false;
        $this->editFaqs    = [];
        $this->newQuestion = '';
        $this->newAnswer   = '';
    }

    public function addFaq(): void
    {
        $this->validate([
            'newQuestion' => 'required|string|max:300',
            'newAnswer'   => 'required|string|max:2000',
        ]);

        $this->editFaqs[] = [
            'question' => trim($this->newQuestion),
            'answer'   => trim($this->newAnswer),
        ];

        $this->newQuestion = '';
        $this->newAnswer   = '';
    }

    public function removeFaq(int $index): void
    {
        array_splice($this->editFaqs, $index, 1);
        $this->editFaqs = array_values($this->editFaqs);
    }

    public function moveUp(int $index): void
    {
        if ($index === 0) return;
        [$this->editFaqs[$index - 1], $this->editFaqs[$index]] =
            [$this->editFaqs[$index], $this->editFaqs[$index - 1]];
    }

    public function moveDown(int $index): void
    {
        if ($index >= count($this->editFaqs) - 1) return;
        [$this->editFaqs[$index], $this->editFaqs[$index + 1]] =
            [$this->editFaqs[$index + 1], $this->editFaqs[$index]];
    }

    public function save(): void
    {
        abort_unless($this->isAdmin(), 403);

        // Validate all existing rows
        foreach ($this->editFaqs as $i => $faq) {
            $this->validate([
                "editFaqs.{$i}.question" => 'required|string|max:300',
                "editFaqs.{$i}.answer"   => 'required|string|max:2000',
            ]);
        }

        SiteSetting::updateOrCreate(
            ['key'   => 'faq_items'],
            ['value' => json_encode(array_values($this->editFaqs))]
        );

        $this->editing = false;
        $this->loadFaqs();
        session()->flash('faq_updated', true);
    }

    public function render()
    {
        return view('livewire.editable-faq', [
            'isAdmin' => $this->isAdmin(),
        ]);
    }
}