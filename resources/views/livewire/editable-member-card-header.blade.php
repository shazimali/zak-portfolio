<div class="dj-mch-wrapper">

    {{-- ── VIEW MODE ── --}}
    @if(! $editing)
        <div
            data-w-id="4bf06ab7-87fa-09aa-0827-163070734051"
            style="opacity: 0"
            class="hero__member-card-header"
        >{{ $topText }}</div>

        <div
            data-w-id="4bf06ab7-87fa-09aa-0827-163070734053"
            style="opacity: 0"
            class="hero__member-card-header bottom"
        >{{ $bottomText }}</div>

        @auth
            @if(auth()->user()->is_admin)
                <button wire:click="startEditing" class="dj-mch-edit-btn" title="Edit text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                </button>

                @if(session()->has('member_card_updated'))
                    <div class="dj-mch-toast">✓ Updated</div>
                @endif
            @endif
        @endauth

    {{-- ── EDIT MODE ── --}}
    @else
        <div class="dj-mch-editor">

            {{-- Live preview --}}
            <div class="dj-mch-preview">
                <div class="hero__member-card-header">{{ $editTop ?: '...' }}</div>
                <div class="hero__member-card-header bottom">{{ $editBottom ?: '...' }}</div>
            </div>

            <div class="dj-mch-fields">
                <label class="dj-field-label">
                    Top line
                    <input
                        type="text"
                        wire:model.live="editTop"
                        class="dj-field-input"
                        maxlength="100"
                        placeholder="Join"
                    />
                    @error('editTop') <p class="dj-field-error">{{ $message }}</p> @enderror
                </label>

                <label class="dj-field-label">
                    Bottom line
                    <input
                        type="text"
                        wire:model.live="editBottom"
                        class="dj-field-input"
                        maxlength="100"
                        placeholder="Designjoy"
                    />
                    @error('editBottom') <p class="dj-field-error">{{ $message }}</p> @enderror
                </label>
            </div>

            <div class="dj-mch-actions">
                <button wire:click="save"   class="dj-btn-save">Save</button>
                <button wire:click="cancel" class="dj-btn-cancel">Cancel</button>
            </div>
        </div>
    @endif

</div>

@auth
    @if(auth()->user()->is_admin)
    {{-- Override Webflow opacity:0 so admin can hover and click to edit --}}
    <style>
        .dj-mch-wrapper .hero__member-card-header {
            opacity: 1 !important;
        }
    </style>
    @endif
@endauth

<style>
    .dj-mch-wrapper { position: relative; display: inline-block; }

    /* Edit button */
    .dj-mch-edit-btn {
        position: absolute;
        top: -12px; right: -12px;
        background: #3b82f6; border: none; border-radius: 50%;
        width: 26px; height: 26px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: white;
        opacity: 0; transform: scale(0.8);
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        padding: 0; z-index: 2147483647;
    }
    .dj-mch-wrapper:hover .dj-mch-edit-btn { opacity: 1; transform: scale(1); }
    .dj-mch-edit-btn:hover { background: #2563eb; transform: scale(1.1) !important; }

    /* Hover outline on the text blocks */
    .dj-mch-wrapper:hover .hero__member-card-header {
        outline: 2px solid #3b82f6;
        outline-offset: 4px;
        border-radius: 4px;
    }

    /* Toast */
    .dj-mch-toast {
        position: absolute; top: -30px; left: 0;
        background: #22c55e; color: white;
        padding: 3px 10px; border-radius: 4px;
        font-size: 12px; font-weight: 500; white-space: nowrap;
        z-index: 9999; animation: dj-mch-fade 2.5s ease forwards;
    }
    @keyframes dj-mch-fade { 0%,60%{opacity:1} 100%{opacity:0} }

    /* Editor panel */
    .dj-mch-editor {
        background: white; border: 1.5px solid #e2e8f0;
        border-radius: 12px; padding: 16px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.10);
        display: flex; flex-direction: column; gap: 12px;
        min-width: 280px;
    }
    .dj-mch-preview {
        background: #f8fafc; border: 1px dashed #cbd5e1;
        border-radius: 8px; padding: 14px;
    }
    .dj-mch-fields { display: flex; flex-direction: column; gap: 10px; }
    .dj-field-label {
        display: flex; flex-direction: column; gap: 6px;
        font-size: 12px; font-weight: 600; color: #64748b;
        text-transform: uppercase; letter-spacing: 0.04em;
    }
    .dj-field-input {
        width: 100%; padding: 8px 12px;
        border: 1.5px solid #e2e8f0; border-radius: 8px;
        font-size: 14px; color: #1e293b; outline: none;
        transition: border-color 0.15s; box-sizing: border-box;
    }
    .dj-field-input:focus { border-color: #3b82f6; }
    .dj-field-error { margin: 0; font-size: 12px; color: #ef4444; }
    .dj-mch-actions { display: flex; gap: 8px; }
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