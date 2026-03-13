<div>
    <div class="dj-bh-heading-wrapper">
        <h1 class="max">
            {{ $before }}
            @if($italic)
                <span class="text-italics">"{{ $italic }}"</span>
            @endif
            <span>{{ $after }}</span>
        </h1>

        @if($isAdmin)
            <button wire:click="startEditing" class="dj-bh-edit-btn" title="Edit heading">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
            </button>

            @if(session()->has('benefits_heading_updated'))
                <div class="dj-bh-toast">✓ Updated</div>
            @endif
        @endif
    </div>

    @if($isAdmin && $editing)
        @teleport('body')
        <div class="dj-bh-backdrop" wire:click.self="cancel">
            <div class="dj-bh-modal">
                <div class="dj-bh-modal-header">
                    <span>Edit Heading</span>
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
                            <label class="dj-field-label">Text before italic
                                <input type="text" wire:model.live="editBefore" class="dj-field-input"
                                       maxlength="100" placeholder="It's" />
                                @error('editBefore') <span class="dj-field-error">{{ $message }}</span> @enderror
                            </label>
                            <label class="dj-field-label">
                                Italic text
                                <span class="dj-field-hint">In quotes + italics — blank to hide</span>
                                <input type="text" wire:model.live="editItalic" class="dj-field-input"
                                       maxlength="150" placeholder="you'll never go back" />
                                @error('editItalic') <span class="dj-field-error">{{ $message }}</span> @enderror
                            </label>
                            <label class="dj-field-label">Text after italic
                                <input type="text" wire:model.live="editAfter" class="dj-field-input"
                                       maxlength="100" placeholder="better" />
                                @error('editAfter') <span class="dj-field-error">{{ $message }}</span> @enderror
                            </label>
                        </div>
                    </div>

                    <div class="dj-bh-col">
                        <div class="dj-bh-preview-label">Live Preview</div>
                        <div class="dj-bh-preview">
                            <h1 class="max" style="font-size:18px;margin:0;line-height:1.35;color:#1e293b!important;">
                                {{ $editBefore ?: '…' }}
                                @if($editItalic)
                                    <span class="text-italics">"{{ $editItalic }}"</span>
                                @endif
                                <span style="color:#1e293b!important;">{{ $editAfter ?: '…' }}</span>
                            </h1>
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
        .dj-bh-heading-wrapper {
            position: relative; display: inline-block; width: 100%;
        }
        .dj-bh-edit-btn {
            position: absolute; top: -10px; right: -10px;
            background: #3b82f6; border: none; border-radius: 50%;
            width: 26px; height: 26px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: white;
            opacity: 0; transition: opacity 0.2s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            padding: 0; z-index: 9999;
        }
        .dj-bh-heading-wrapper:hover .dj-bh-edit-btn { opacity: 1; }
        .dj-bh-edit-btn:hover { background: #2563eb; }
        .dj-bh-heading-wrapper:hover h1.max {
            outline: 2px solid #3b82f6;
            outline-offset: 6px;
            border-radius: 4px;
        }
        .dj-bh-toast {
            position: absolute; top: -30px; left: 0;
            background: #22c55e; color: white;
            padding: 3px 10px; border-radius: 4px;
            font-size: 12px; font-weight: 500; white-space: nowrap;
            animation: dj-bh-fade 2.5s ease forwards;
        }
        @keyframes dj-bh-fade { 0%,60%{opacity:1} 100%{opacity:0} }

        .dj-bh-backdrop {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 2147483647;
            display: flex; align-items: center; justify-content: center;
            padding: 20px;
            backdrop-filter: blur(3px);
        }
        .dj-bh-modal {
            background: white; border-radius: 16px;
            width: 100%; max-width: 860px;
            max-height: 90vh; overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0,0,0,0.35);
            display: flex; flex-direction: column;
        }
        .dj-bh-modal-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 14px 20px; border-bottom: 1px solid #e2e8f0;
            font-size: 15px; font-weight: 700; color: #1e293b;
            position: sticky; top: 0; background: white; z-index: 1;
        }
        .dj-bh-close-btn {
            background: #f1f5f9; border: none; border-radius: 50%;
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: #64748b; transition: all 0.15s;
        }
        .dj-bh-close-btn:hover { background: #e2e8f0; color: #1e293b; }
        .dj-bh-body {
            display: grid; grid-template-columns: 1fr 1fr;
            gap: 0; flex: 1; min-height: 0;
        }
        .dj-bh-col { padding: 18px 20px; display: flex; flex-direction: column; }
        .dj-bh-col:first-child { border-right: 1px solid #e2e8f0; }
        .dj-bh-fields { display: flex; flex-direction: column; gap: 12px; }
        .dj-field-label {
            display: flex; flex-direction: column; gap: 4px;
            font-size: 11px; font-weight: 600; color: #64748b;
            text-transform: uppercase; letter-spacing: 0.04em;
        }
        .dj-field-hint { font-size: 11px; font-weight: 400; color: #94a3b8; text-transform: none; letter-spacing: 0; }
        .dj-field-input {
            width: 100%; padding: 8px 12px;
            border: 1.5px solid #e2e8f0; border-radius: 8px;
            font-size: 13px; color: #1e293b; outline: none;
            transition: border-color 0.15s; box-sizing: border-box; font-family: inherit;
        }
        .dj-field-input:focus { border-color: #3b82f6; }
        .dj-field-error { font-size: 11px; color: #ef4444; }
        .dj-bh-preview-label {
            font-size: 10px; font-weight: 700; color: #94a3b8;
            text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 10px;
        }
        .dj-bh-preview {
            background: #f8fafc; border: 1px dashed #cbd5e1;
            border-radius: 10px; padding: 16px; flex: 1;
        }
        .dj-bh-actions {
            display: flex; gap: 8px; padding: 14px 20px;
            border-top: 1px solid #e2e8f0;
            position: sticky; bottom: 0; background: white;
        }
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
        @media (max-width: 600px) {
            .dj-bh-body { grid-template-columns: 1fr; }
            .dj-bh-col:first-child { border-right: none; border-bottom: 1px solid #e2e8f0; }
            .dj-bh-modal { max-width: 100%; }
        }
    </style>
</div>