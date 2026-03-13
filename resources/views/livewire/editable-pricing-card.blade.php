<div>
    {{-- Pricing Card --}}
    <div class="dj-pricing-wrapper">
        <div data-w-id="4bf06ab7-87fa-09aa-0827-163070734056" class="pricing__card">

            <div class="div-block-4">
                <div class="pricing__card-header">{{ $title }}</div>
                <div class="div-block-5">
                    <div>{{ $badge }}</div>
                </div>
            </div>

            <div class="div-block-6">
                <h2 class="m-t-0 m-b-0 _3">{{ $price }}</h2>
                <div class="pricing__month">{{ $period }}</div>
            </div>

            <div class="div-block-7">
                <div class="w-layout-grid grid">
                    <div class="pricing__list">
                        @foreach($list1 as $item)
                            <div>{{ $item }}</div>
                        @endforeach
                    </div>
                    <div class="pricing__list">
                        @foreach($list2 as $item)
                            <div>{{ $item }}</div>
                        @endforeach
                    </div>
                </div>
                <div class="included"><div>Included</div></div>
            </div>

            <div class="div-block-9">
                <a href="{{ $stripeUrl }}" target="_blank" class="div-block-7-copy-copy w-inline-block">
                    <div class="div-block-8">
                        <img loading="lazy" src="{{ asset('assets/images/678548430d58f4cbecec19a3_smile.svg') }}" alt="" />
                    </div>
                    <div>{{ $btnLabel }}</div>
                </a>
            </div>

            <img loading="lazy" src="{{ asset('assets/images/678548430d58f4cbecec19d5_Group_1171274461.svg') }}" alt="" class="image-29" />
        </div>

        {{-- Admin edit button --}}
        @if($isAdmin)
            <button wire:click="startEditing" class="dj-pricing-edit-btn" title="Edit pricing card">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
            </button>

            @if(session()->has('pricing_updated'))
                <div class="dj-pricing-toast">✓ Updated</div>
            @endif
        @endif
    </div>

    {{-- Edit Modal --}}
    @if($isAdmin && $editing)
        <div class="dj-hiw-backdrop" wire:click.self="cancel">
            <div class="dj-hiw-modal">

                <div class="dj-hiw-modal-header">
                    <span>Edit Pricing Card</span>
                    <button wire:click="cancel" class="dj-hiw-close-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                    </button>
                </div>

                <div class="dj-hiw-fields" style="max-height: 65vh; overflow-y: auto; padding-bottom: 0;">

                    <label class="dj-field-label">Card Title
                        <input type="text" wire:model.live="editTitle" class="dj-field-input" maxlength="100" placeholder="Monthly Club" />
                        @error('editTitle') <span class="dj-field-error">{{ $message }}</span> @enderror
                    </label>

                    <label class="dj-field-label">Badge Text
                        <input type="text" wire:model.live="editBadge" class="dj-field-input" maxlength="100" placeholder="PAUSE OR CANCEL ANYTIME" />
                        @error('editBadge') <span class="dj-field-error">{{ $message }}</span> @enderror
                    </label>

                    <div style="display:flex; gap:8px;">
                        <label class="dj-field-label" style="flex:1">Price
                            <input type="text" wire:model.live="editPrice" class="dj-field-input" maxlength="50" placeholder="$5,995" />
                            @error('editPrice') <span class="dj-field-error">{{ $message }}</span> @enderror
                        </label>
                        <label class="dj-field-label" style="flex:1">Period
                            <input type="text" wire:model.live="editPeriod" class="dj-field-input" maxlength="30" placeholder="/month" />
                            @error('editPeriod') <span class="dj-field-error">{{ $message }}</span> @enderror
                        </label>
                    </div>

                    <label class="dj-field-label">
                        Features — Left Column
                        <span class="dj-field-hint">One item per line</span>
                        <textarea wire:model.live="editList1" class="dj-field-input" rows="4" style="resize: vertical; line-height: 1.5;">{{ $editList1 }}</textarea>
                        @error('editList1') <span class="dj-field-error">{{ $message }}</span> @enderror
                    </label>

                    <label class="dj-field-label">
                        Features — Right Column
                        <span class="dj-field-hint">One item per line</span>
                        <textarea wire:model.live="editList2" class="dj-field-input" rows="3" style="resize: vertical; line-height: 1.5;">{{ $editList2 }}</textarea>
                        @error('editList2') <span class="dj-field-error">{{ $message }}</span> @enderror
                    </label>

                    <label class="dj-field-label">Stripe URL
                        <input type="url" wire:model.live="editStripeUrl" class="dj-field-input" placeholder="https://buy.stripe.com/..." />
                        @error('editStripeUrl') <span class="dj-field-error">{{ $message }}</span> @enderror
                    </label>

                    <label class="dj-field-label">Button Label
                        <input type="text" wire:model.live="editBtnLabel" class="dj-field-input" maxlength="50" placeholder="Join today" />
                        @error('editBtnLabel') <span class="dj-field-error">{{ $message }}</span> @enderror
                    </label>

                </div>

                <div class="dj-hiw-actions">
                    <button wire:click="save" class="dj-btn-save">
                        <span wire:loading.remove wire:target="save">Save Changes</span>
                        <span wire:loading wire:target="save">Saving…</span>
                    </button>
                    <button wire:click="cancel" class="dj-btn-cancel">Cancel</button>
                </div>

            </div>
        </div>
    @endif

    @if($isAdmin)
    <style>
        .dj-pricing-wrapper { position: relative; display: inline-block; width: 100%; }
        .dj-pricing-edit-btn {
            position: absolute; top: -10px; right: -10px;
            background: #3b82f6; border: none; border-radius: 50%;
            width: 26px; height: 26px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: white;
            opacity: 0; transform: scale(0.8);
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            padding: 0; z-index: 10;
        }
        .dj-pricing-wrapper:hover .dj-pricing-edit-btn  { opacity: 1; transform: scale(1); }
        .dj-pricing-edit-btn:hover                      { background: #2563eb; transform: scale(1.1) !important; }
        .dj-pricing-wrapper:hover .pricing__card {
            outline: 2px solid #3b82f6;
            outline-offset: 8px;
            border-radius: 4px;
        }
        .dj-pricing-toast {
            position: absolute; top: -30px; left: 0;
            background: #22c55e; color: white;
            padding: 3px 10px; border-radius: 4px;
            font-size: 12px; font-weight: 500;
            animation: dj-hiw-fade 2.5s ease forwards;
        }
    </style>
    @endif
</div>