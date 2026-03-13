<div>
    <div class="dj-bp-wrapper">
        <p class="benefits__p">{{ $para }}</p>

        @if($isAdmin)
            <button wire:click="startEditing" class="dj-bp-edit-btn" title="Edit paragraph">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
            </button>

            @if(session()->has('benefits_para_updated'))
                <div class="dj-bp-toast">✓ Updated</div>
            @endif
        @endif
    </div>

    @if($isAdmin && $editing)
        @teleport('body')
        <div class="dj-bh-backdrop" wire:click.self="cancel">
            <div class="dj-bh-modal">
                <div class="dj-bh-modal-header">
                    <span>Edit Paragraph</span>
                    <button wire:click="cancel" class="dj-bh-close-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                             fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                    </button>
                </div>

                <div class="dj-bh-body">
                    <div class="dj-bh-col">
                        <div class="dj-bh-fields">
                            <label class="dj-field-label">Paragraph
                                <textarea wire:model.live="editPara" class="dj-field-input dj-field-textarea"
                                          maxlength="500" rows="5"
                                          placeholder="Designjoy replaces unreliable freelancers…"></textarea>
                                @error('editPara') <span class="dj-field-error">{{ $message }}</span> @enderror
                            </label>
                        </div>
                    </div>

                    <div class="dj-bh-col">
                        <div class="dj-bh-preview-label">Live Preview</div>
                        <div class="dj-bh-preview">
                            <p style="font-size:13px;margin:0;line-height:1.6;color:#475569!important;">
                                {{ $editPara ?: '…' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="dj-bh-actions">
                    <button wire:click="save" class="dj-btn-save">
                        <span wire:loading.remove wire:target="save">Save Changes</span>
                        <span wire:loading wire:target="save">Saving…</span>
                    </button>
                    <button wire:click="cancel" class="dj-btn-cancel">Cancel</button>
                </div>
            </div>
        </div>
        @endteleport
    @endif

    <style>
        .dj-bp-wrapper {
            position: relative; display: inline-block; width: 100%;
        }
        .dj-bp-edit-btn {
            position: absolute; top: -10px; right: -10px;
            background: #3b82f6; border: none; border-radius: 50%;
            width: 26px; height: 26px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: white;
            opacity: 0; transition: opacity 0.2s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            padding: 0; z-index: 9999;
        }
        .dj-bp-wrapper:hover .dj-bp-edit-btn { opacity: 1; }
        .dj-bp-edit-btn:hover { background: #2563eb; }
        .dj-bp-wrapper:hover .benefits__p {
            outline: 2px solid #3b82f6;
            outline-offset: 6px;
            border-radius: 4px;
        }
        .dj-bp-toast {
            position: absolute; top: -30px; left: 0;
            background: #22c55e; color: white;
            padding: 3px 10px; border-radius: 4px;
            font-size: 12px; font-weight: 500; white-space: nowrap;
            animation: dj-bp-fade 2.5s ease forwards;
        }
        @keyframes dj-bp-fade { 0%,60%{opacity:1} 100%{opacity:0} }
        .dj-field-textarea { resize: vertical; min-height: 80px; }
    </style>
</div>