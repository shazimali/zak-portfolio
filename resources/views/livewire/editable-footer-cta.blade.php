<div>

    @if($isAdmin)
    <style>
        .dj-fcta-wrapper:hover .footer__bottom-top {
            outline: 2px solid #3b82f6;
            outline-offset: 8px;
            border-radius: 4px;
        }
    </style>
    @endif

    <div class="dj-fcta-wrapper" style="position: relative;">

        <div class="footer__bottom-top">
            <h1 class="top footer__header">
                {{ $heading }}
                @if($headingItalic)
                    <span class="text-italics">{{ $headingItalic }}</span>
                @endif
            </h1>
            <p class="hero__left-bottom-p m-b-d foooo">
                {{ $subtext }}
            </p>
        </div>

        @if($isAdmin)
            <button wire:click="startEditing" class="dj-fcta-edit-btn" title="Edit section">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
            </button>

            @if(session()->has('footer_cta_updated'))
                <div class="dj-fcta-toast">✓ Updated</div>
            @endif
        @endif

    </div>

    {{-- Modal --}}
    @if($isAdmin && $editing)
        @teleport('body')
        <div class="dj-fcta-backdrop" wire:click.self="cancel">
            <div class="dj-fcta-modal">

                <div class="dj-fcta-modal-header">
                    <span>Edit Footer CTA</span>
                    <button wire:click="cancel" class="dj-fcta-close-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                    </button>
                </div>

                {{-- Live preview --}}
                <div class="dj-fcta-preview">
                    <div class="dj-fcta-preview-label">Preview</div>
                    <h1 class="top footer__header" style="font-size: 18px; margin: 0 0 6px; color:#1e293b!important;">
                        {{ $editHeading ?: '…' }}
                        @if($editHeadingItalic)
                            <span class="text-italics">{{ $editHeadingItalic }}</span>
                        @endif
                    </h1>
                    <p style="margin: 0; font-size: 13px; opacity: 0.7; color:#1e293b!important;">
                        {{ $editSubtext ?: '…' }}
                    </p>
                </div>

                {{-- Fields --}}
                <div class="dj-fcta-fields">

                    <label class="dj-field-label">Heading
                        <input type="text"
                               wire:model.live="editHeading"
                               class="dj-field-input"
                               maxlength="200"
                               placeholder="{{ self::DEFAULT_HEADING }}" />
                        @error('editHeading') <span class="dj-field-error">{{ $message }}</span> @enderror
                    </label>

                    <label class="dj-field-label">
                        Italic suffix
                        <span class="dj-field-hint">The part in italics after the heading — leave blank to hide</span>
                        <input type="text"
                               wire:model.live="editHeadingItalic"
                               class="dj-field-input"
                               maxlength="100"
                               placeholder="{{ self::DEFAULT_HEADING_ITALIC }}" />
                        @error('editHeadingItalic') <span class="dj-field-error">{{ $message }}</span> @enderror
                    </label>

                    <label class="dj-field-label">Subtext
                        <input type="text"
                               wire:model.live="editSubtext"
                               class="dj-field-input"
                               maxlength="300"
                               placeholder="{{ self::DEFAULT_SUBTEXT }}" />
                        @error('editSubtext') <span class="dj-field-error">{{ $message }}</span> @enderror
                    </label>

                </div>

                <div class="dj-fcta-actions">
                    <button wire:click="save" class="dj-btn-save">
                        <span wire:loading.remove wire:target="save">Save Changes</span>
                        <span wire:loading       wire:target="save">Saving…</span>
                    </button>
                    <button wire:click="cancel" class="dj-btn-cancel">Cancel</button>
                </div>

            </div>
        </div>
        @endteleport
    @endif

    <style>
        .dj-fcta-wrapper { position: relative; display: inline-block; width: 100%; }

        .dj-fcta-edit-btn {
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
        .dj-fcta-wrapper:hover .dj-fcta-edit-btn  { opacity: 1; transform: scale(1); }
        .dj-fcta-edit-btn:hover                    { background: #2563eb; transform: scale(1.1) !important; }

        .dj-fcta-toast {
            position: absolute; top: -30px; left: 0;
            background: #22c55e; color: white;
            padding: 3px 10px; border-radius: 4px;
            font-size: 12px; font-weight: 500; white-space: nowrap;
            animation: dj-fcta-fade 2.5s ease forwards;
        }
        @keyframes dj-fcta-fade { 0%,60%{opacity:1} 100%{opacity:0} }

        .dj-fcta-backdrop {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 2147483647;
            display: flex; align-items: center; justify-content: center;
            padding: 20px; backdrop-filter: blur(3px);
        }
        .dj-fcta-modal {
            background: white; border-radius: 16px;
            width: 100%; max-width: 480px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
            display: flex; flex-direction: column; overflow: hidden;
        }
        .dj-fcta-modal-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 20px; border-bottom: 1px solid #e2e8f0;
            font-size: 15px; font-weight: 700; color: #1e293b;
        }
        .dj-fcta-close-btn {
            background: #f1f5f9; border: none; border-radius: 50%;
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: #64748b; transition: all 0.15s;
        }
        .dj-fcta-close-btn:hover { background: #e2e8f0; color: #1e293b; }

        .dj-fcta-preview {
            background: #f8fafc; border: 1px dashed #cbd5e1;
            border-radius: 8px; padding: 14px 16px;
            margin: 16px 20px 0;
        }
        .dj-fcta-preview-label {
            font-size: 10px; font-weight: 700; color: #94a3b8;
            text-transform: uppercase; letter-spacing: 0.06em;
            margin-bottom: 8px;
        }

        .dj-fcta-fields { display: flex; flex-direction: column; gap: 12px; padding: 16px 20px 0; }
        .dj-field-label {
            display: flex; flex-direction: column; gap: 4px;
            font-size: 11px; font-weight: 600; color: #64748b;
            text-transform: uppercase; letter-spacing: 0.04em;
        }
        .dj-field-hint { font-size: 11px; font-weight: 400; color: #94a3b8; text-transform: none; letter-spacing: 0; }
        .dj-field-input {
            width: 100%; padding: 8px 12px;
            border: 1.5px solid #e2e8f0; border-radius: 8px;
            font-size: 14px; color: #1e293b; outline: none;
            transition: border-color 0.15s; box-sizing: border-box;
            font-family: inherit;
        }
        .dj-field-input:focus { border-color: #3b82f6; }
        .dj-field-error { font-size: 11px; color: #ef4444; }

        .dj-fcta-actions { display: flex; gap: 8px; padding: 16px 20px; }
        .dj-btn-save {
            flex: 1; padding: 9px 0; background: #3b82f6; color: white;
            border: none; border-radius: 8px; font-size: 14px; font-weight: 600;
            cursor: pointer; transition: background 0.15s;
        }
        .dj-btn-save:hover { background: #2563eb; }
        .dj-btn-cancel {
            flex: 1; padding: 9px 0; background: #f1f5f9; color: #64748b;
            border: none; border-radius: 8px; font-size: 14px; font-weight: 600;
            cursor: pointer; transition: background 0.15s;
        }
        .dj-btn-cancel:hover { background: #e2e8f0; }
    </style>

</div>