<div>

<div class="hero__flex">
    <div class="faq__left" style="position: relative;">

        <h1>
            <span class="text-italics">Frequently</span> asked questions
        </h1>

        @if($isAdmin)
            <button wire:click="startEditing" class="dj-faq-edit-btn" title="Edit FAQs">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
                Edit FAQs
            </button>

            @if(session()->has('faq_updated'))
                <div class="dj-faq-toast">✓ FAQs updated</div>
            @endif
        @endif

        <div class="div-block-13">
            @forelse($faqs as $faq)
                <div class="faq__row">
                    <div>
                        <div class="faq__question m-b-0">{{ $faq['question'] }}</div>
                        <p style="display:none" class="faq__answer">{{ $faq['answer'] }}</p>
                    </div>
                    <img style="transform: rotateZ(0deg)" loading="lazy" alt=""
                         src="{{ asset('assets/images/678548430d58f4cbecec19b8_chevron-down_1.svg') }}"
                         class="faq__arrow" />
                </div>
            @empty
                @if($isAdmin)
                    <div class="dj-faq-empty">
                        No FAQ items yet.
                        <button wire:click="startEditing" class="dj-faq-empty-btn">Add your first question →</button>
                    </div>
                @endif
            @endforelse
        </div>

    </div>

    {{-- Right card (unchanged) --}}
    <div data-w-id="4bf06ab7-87fa-09aa-0827-163070734102" style="opacity:0" class="faq__card">
        <div class="faq__card-inner">
            <img loading="lazy" src="{{ asset('assets/images/678548430d58f4cbecec19b9_Group_10.png') }}" alt="" class="image-11" />
            <div data-w-id="4bf06ab7-87fa-09aa-0827-163070734105" style="opacity:0" class="hero__member-card-header _2">
                Book a 15-min intro call
            </div>
            <a data-w-id="4bf06ab7-87fa-09aa-0827-163070734107" style="opacity:0" href="#book" class="button w-button">Book a call</a>
        </div>
        <a data-w-id="4bf06ab7-87fa-09aa-0827-163070734109" style="opacity:0"
           href="mailto:hello@designjoy.co?subject=Website%20Inquiry"
           class="hero__member-card-call w-inline-block">
            <div class="hero__member-card-call-left">
                <img loading="lazy" src="{{ asset('assets/images/678548430d58f4cbecec19bb_Send-Email--Streamline-Ultimate.png') }}"
                     alt="" class="image-2 send" />
                <div>
                    <div>Prefer to email?</div>
                    <div class="hero__member-card-call-schedule">hello@designjoy.co</div>
                </div>
            </div>
            <img loading="lazy" src="{{ asset('assets/images/678548430d58f4cbecec196a_arrow.svg') }}" alt="" />
        </a>
    </div>
</div>

{{-- EDIT MODAL --}}
@if($isAdmin && $editing)
    @teleport('body')
    <div class="dj-faq-backdrop" wire:click.self="cancel">
        <div class="dj-faq-modal">

            <div class="dj-faq-modal-header">
                <span>Edit FAQs <span class="dj-faq-count">({{ count($editFaqs) }} items)</span></span>
                <button wire:click="cancel" class="dj-faq-close-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>

            <div class="dj-faq-body">
                @forelse($editFaqs as $i => $faq)
                    <div class="dj-faq-item">
                        <div class="dj-faq-item-controls">
                            <span class="dj-faq-num">#{{ $i + 1 }}</span>
                            <div class="dj-faq-arrows">
                                <button wire:click="moveUp({{ $i }})"   class="dj-faq-arrow-btn" title="Move up"   @if($i === 0) disabled @endif>↑</button>
                                <button wire:click="moveDown({{ $i }})" class="dj-faq-arrow-btn" title="Move down" @if($i === count($editFaqs)-1) disabled @endif>↓</button>
                            </div>
                            <button wire:click="removeFaq({{ $i }})" class="dj-faq-remove-btn" title="Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"
                                     fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M9 6V4h6v2"/>
                                </svg>
                            </button>
                        </div>
                        <div class="dj-faq-fields">
                            <label class="dj-field-label">Question
                                <input type="text"
                                       wire:model="editFaqs.{{ $i }}.question"
                                       class="dj-field-input"
                                       maxlength="300"
                                       placeholder="Enter question…" />
                                @error("editFaqs.{$i}.question") <span class="dj-field-error">{{ $message }}</span> @enderror
                            </label>
                            <label class="dj-field-label">Answer
                                <textarea wire:model="editFaqs.{{ $i }}.answer"
                                          class="dj-field-input dj-field-textarea"
                                          maxlength="2000"
                                          rows="3"
                                          placeholder="Enter answer…"></textarea>
                                @error("editFaqs.{$i}.answer") <span class="dj-field-error">{{ $message }}</span> @enderror
                            </label>
                        </div>
                    </div>
                @empty
                    <p class="dj-faq-modal-empty">No questions yet. Add one below.</p>
                @endforelse
            </div>

            <div class="dj-faq-add-section">
                <div class="dj-faq-add-header">+ Add New Question</div>
                <div class="dj-faq-add-fields">
                    <label class="dj-field-label">Question
                        <input type="text"
                               wire:model="newQuestion"
                               class="dj-field-input"
                               maxlength="300"
                               placeholder="How fast will I receive my designs?" />
                        @error('newQuestion') <span class="dj-field-error">{{ $message }}</span> @enderror
                    </label>
                    <label class="dj-field-label">Answer
                        <textarea wire:model="newAnswer"
                                  class="dj-field-input dj-field-textarea"
                                  maxlength="2000"
                                  rows="3"
                                  placeholder="On average, most requests are completed in just two days…"></textarea>
                        @error('newAnswer') <span class="dj-field-error">{{ $message }}</span> @enderror
                    </label>
                    <button wire:click="addFaq" class="dj-btn-add">Add Question</button>
                </div>
            </div>

            <div class="dj-faq-actions">
                <button wire:click="save" class="dj-btn-save">
                    <span wire:loading.remove wire:target="save">Save All Changes</span>
                    <span wire:loading       wire:target="save">Saving…</span>
                </button>
                <button wire:click="cancel" class="dj-btn-cancel">Cancel</button>
            </div>

        </div>
    </div>
    @endteleport
@endif

<style>
    .dj-faq-edit-btn {
        display: inline-flex; align-items: center; gap: 6px;
        background: #3b82f6; color: white; border: none;
        border-radius: 8px; padding: 6px 12px;
        font-size: 12px; font-weight: 600; cursor: pointer;
        margin-bottom: 16px; transition: background 0.15s;
    }
    .dj-faq-edit-btn:hover { background: #2563eb; }

    .dj-faq-empty {
        padding: 24px; text-align: center;
        color: #94a3b8; font-size: 14px;
        border: 2px dashed #e2e8f0; border-radius: 10px;
        display: flex; flex-direction: column; align-items: center; gap: 10px;
    }
    .dj-faq-empty-btn {
        background: none; border: none; color: #3b82f6;
        font-size: 13px; font-weight: 600; cursor: pointer;
    }
    .dj-faq-empty-btn:hover { text-decoration: underline; }

    .dj-faq-toast {
        display: inline-block;
        background: #22c55e; color: white;
        padding: 3px 10px; border-radius: 4px;
        font-size: 12px; font-weight: 500;
        margin-bottom: 12px;
        animation: dj-faq-fade 2.5s ease forwards;
    }
    @keyframes dj-faq-fade { 0%,60%{opacity:1} 100%{opacity:0} }

    .dj-faq-backdrop {
        position: fixed; inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 2147483647;
        display: flex; align-items: center; justify-content: center;
        padding: 20px; backdrop-filter: blur(3px);
    }
    .dj-faq-modal {
        background: white; border-radius: 16px;
        width: 100%; max-width: 560px; max-height: 90vh;
        display: flex; flex-direction: column;
        box-shadow: 0 20px 60px rgba(0,0,0,0.25);
        overflow: hidden;
    }
    .dj-faq-modal-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 16px 20px; border-bottom: 1px solid #e2e8f0;
        font-size: 15px; font-weight: 700; color: #1e293b;
        flex-shrink: 0;
    }
    .dj-faq-count { font-size: 12px; font-weight: 500; color: #94a3b8; margin-left: 6px; }
    .dj-faq-close-btn {
        background: #f1f5f9; border: none; border-radius: 50%;
        width: 32px; height: 32px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: #64748b; transition: all 0.15s; flex-shrink: 0;
    }
    .dj-faq-close-btn:hover { background: #e2e8f0; color: #1e293b; }

    .dj-faq-body {
        overflow-y: auto; flex: 1;
        display: flex; flex-direction: column; gap: 10px;
        padding: 16px 20px;
    }
    .dj-faq-modal-empty { color: #94a3b8; font-size: 13px; text-align: center; padding: 20px 0; }

    .dj-faq-item {
        background: #f8fafc; border: 1px solid #e2e8f0;
        border-radius: 10px; padding: 12px;
        display: flex; flex-direction: column; gap: 10px;
    }
    .dj-faq-item-controls { display: flex; align-items: center; gap: 8px; }
    .dj-faq-num {
        font-size: 11px; font-weight: 700; color: #94a3b8;
        background: #e2e8f0; border-radius: 4px; padding: 2px 6px;
    }
    .dj-faq-arrows { display: flex; gap: 2px; margin-right: auto; }
    .dj-faq-arrow-btn {
        background: #f1f5f9; border: 1px solid #e2e8f0; border-radius: 4px;
        width: 24px; height: 24px; font-size: 13px; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        color: #64748b; transition: all 0.15s; padding: 0;
    }
    .dj-faq-arrow-btn:hover:not(:disabled) { background: #e2e8f0; }
    .dj-faq-arrow-btn:disabled { opacity: 0.3; cursor: not-allowed; }
    .dj-faq-remove-btn {
        background: #fff0f0; border: 1px solid #fca5a5; border-radius: 6px;
        width: 28px; height: 28px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: #ef4444; transition: all 0.15s;
    }
    .dj-faq-remove-btn:hover { background: #fee2e2; }
    .dj-faq-fields { display: flex; flex-direction: column; gap: 8px; }

    .dj-faq-add-section {
        border-top: 2px dashed #e2e8f0; flex-shrink: 0;
        padding: 14px 20px;
    }
    .dj-faq-add-header {
        font-size: 12px; font-weight: 700; color: #3b82f6;
        text-transform: uppercase; letter-spacing: 0.05em;
        margin-bottom: 10px;
    }
    .dj-faq-add-fields { display: flex; flex-direction: column; gap: 8px; }

    .dj-field-label {
        display: flex; flex-direction: column; gap: 4px;
        font-size: 11px; font-weight: 600; color: #64748b;
        text-transform: uppercase; letter-spacing: 0.04em;
    }
    .dj-field-input {
        width: 100%; padding: 8px 10px;
        border: 1.5px solid #e2e8f0; border-radius: 8px;
        font-size: 13px; color: #1e293b; outline: none;
        transition: border-color 0.15s; box-sizing: border-box;
        background: white; font-family: inherit;
    }
    .dj-field-input:focus { border-color: #3b82f6; }
    .dj-field-textarea { resize: vertical; min-height: 72px; }
    .dj-field-error { font-size: 11px; color: #ef4444; margin-top: 2px; }

    .dj-btn-add {
        align-self: flex-start; padding: 8px 16px;
        background: #f0f9ff; color: #0284c7;
        border: 1.5px solid #bae6fd; border-radius: 8px;
        font-size: 13px; font-weight: 600; cursor: pointer;
        transition: all 0.15s;
    }
    .dj-btn-add:hover { background: #e0f2fe; border-color: #7dd3fc; }

    .dj-faq-actions {
        display: flex; gap: 8px; padding: 14px 20px;
        border-top: 1px solid #e2e8f0; flex-shrink: 0;
        background: white;
    }
    .dj-btn-save {
        flex: 1; padding: 10px 0; background: #3b82f6; color: white;
        border: none; border-radius: 8px; font-size: 14px; font-weight: 600;
        cursor: pointer; transition: background 0.15s;
    }
    .dj-btn-save:hover { background: #2563eb; }
    .dj-btn-cancel {
        flex: 1; padding: 10px 0; background: #f1f5f9; color: #64748b;
        border: none; border-radius: 8px; font-size: 14px; font-weight: 600;
        cursor: pointer; transition: background 0.15s;
    }
    .dj-btn-cancel:hover { background: #e2e8f0; }
</style>
<script>
    function initFaqAccordion() {
        document.querySelectorAll('.faq__row').forEach(function (row) {
            // Remove old listener to avoid duplicates
            row.replaceWith(row.cloneNode(true));
        });

        document.querySelectorAll('.faq__row').forEach(function (row) {
            row.style.cursor = 'pointer';
            row.addEventListener('click', function () {
                var answer = row.querySelector('.faq__answer');
                var arrow  = row.querySelector('.faq__arrow');
                var isOpen = answer.style.display === 'block';

                // Close all others
                document.querySelectorAll('.faq__row').forEach(function (r) {
                    r.querySelector('.faq__answer').style.display = 'none';
                    r.querySelector('.faq__arrow').style.transform = 'rotateZ(0deg)';
                });

                // Toggle current
                if (!isOpen) {
                    answer.style.display = 'block';
                    arrow.style.transform = 'rotateZ(180deg)';
                }
            });
        });
    }

    // Run on page load
    document.addEventListener('DOMContentLoaded', initFaqAccordion);

    // Re-run after Livewire updates (in case FAQs are saved/changed)
    document.addEventListener('livewire:updated', initFaqAccordion);
</script>
</div>