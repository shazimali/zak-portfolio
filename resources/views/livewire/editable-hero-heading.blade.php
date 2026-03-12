<div class="dj-heading-wrapper">

    {{-- ── VIEW MODE ── --}}
    @if(! $editing)
        <h1>
            {{ $mainText }}
            <span class="text-italics">{{ $italicText }}</span>
        </h1>

        @auth
            @if(auth()->user()->is_admin)
                <button wire:click="startEditing" class="dj-heading-edit-btn" title="Edit heading">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                </button>

                @if(session()->has('heading_updated'))
                    <div class="dj-heading-toast">✓ Heading updated</div>
                @endif
            @endif
        @endauth

    {{-- ── EDIT MODE ── --}}
    @else
        <div class="dj-heading-editor">
            <div class="dj-heading-preview">
                <h1>
                    {{ $editMain ?: '...' }}
                    <span class="text-italics">{{ $editItalic ?: '...' }}</span>
                </h1>
            </div>

            <div class="dj-heading-fields">
                <label class="dj-field-label">
                    Main text
                    <input
                        type="text"
                        wire:model.live="editMain"
                        placeholder="Design subscriptions for"
                        class="dj-field-input"
                        maxlength="200"
                    />
                </label>

                <label class="dj-field-label">
                    Italic text <small>(the highlighted word)</small>
                    <input
                        type="text"
                        wire:model.live="editItalic"
                        placeholder="everyone"
                        class="dj-field-input"
                        maxlength="100"
                    />
                </label>

                @error('editMain')   <p class="dj-field-error">{{ $message }}</p> @enderror
                @error('editItalic') <p class="dj-field-error">{{ $message }}</p> @enderror
            </div>

            <div class="dj-heading-actions">
                <button wire:click="save"   class="dj-btn-save">Save</button>
                <button wire:click="cancel" class="dj-btn-cancel">Cancel</button>
            </div>
        </div>
    @endif

</div>

<style>
    .dj-heading-wrapper {
        position: relative;
        display: inline-block;
        width: 100%;
    }
    .dj-heading-edit-btn {
        position: absolute;
        top: 0;
        right: -32px;
        background: #3b82f6;
        border: none;
        border-radius: 50%;
        width: 26px;
        height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: white;
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        padding: 0;
    }
    .dj-heading-wrapper:hover .dj-heading-edit-btn {
        opacity: 1;
        transform: scale(1);
    }
    .dj-heading-edit-btn:hover {
        background: #2563eb;
        transform: scale(1.1) !important;
    }
    .dj-heading-toast {
        position: absolute;
        top: -32px;
        left: 0;
        background: #22c55e;
        color: white;
        padding: 3px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 500;
        white-space: nowrap;
        z-index: 9999;
        animation: dj-heading-fade 2.5s ease forwards;
    }
    @keyframes dj-heading-fade { 0%,60%{opacity:1} 100%{opacity:0} }
    .dj-heading-editor {
        background: white;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.10);
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .dj-heading-preview {
        background: #f8fafc;
        border-radius: 8px;
        padding: 16px;
        border: 1px dashed #cbd5e1;
    }
    .dj-heading-preview h1 { margin: 0; pointer-events: none; }
    .dj-heading-fields { display: flex; flex-direction: column; gap: 12px; }
    .dj-field-label {
        display: flex;
        flex-direction: column;
        gap: 4px;
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .dj-field-label small { font-weight: 400; text-transform: none; letter-spacing: 0; color: #94a3b8; }
    .dj-field-input {
        width: 100%;
        padding: 8px 12px;
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        font-size: 14px;
        color: #1e293b;
        outline: none;
        transition: border-color 0.15s;
        box-sizing: border-box;
    }
    .dj-field-input:focus { border-color: #3b82f6; }
    .dj-field-error { margin: 0; font-size: 12px; color: #ef4444; }
    .dj-heading-actions { display: flex; gap: 8px; }
    .dj-btn-save {
        flex: 1; padding: 9px 0;
        background: #3b82f6; color: white;
        border: none; border-radius: 8px;
        font-size: 14px; font-weight: 600;
        cursor: pointer; transition: background 0.15s;
    }
    .dj-btn-save:hover { background: #2563eb; }
    .dj-btn-cancel {
        flex: 1; padding: 9px 0;
        background: #f1f5f9; color: #64748b;
        border: none; border-radius: 8px;
        font-size: 14px; font-weight: 600;
        cursor: pointer; transition: background 0.15s;
    }
    .dj-btn-cancel:hover { background: #e2e8f0; }
</style>