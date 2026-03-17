<div>

@auth
    @if(auth()->user()->is_admin)
    <style>
        .dj-mct-wrapper .hero__member-card-header,
        .dj-mct-wrapper .hero__member-card-p {
            opacity: 1 !important;
        }
        dj-mct-wrapper:hover .hero__member-card-header,
        .dj-mct-wrapper:hover .hero__member-card-p {
            outline: 2px solid #3b82f6;
            outline-offset: 4px;
            border-radius: 4px;
        }
    </style>
    @endif
@endauth

<div class="dj-mct-wrapper">

    {{-- Always visible text --}}
    <div class="hero__member-card-header">{{ $line1 }}</div>
    <div class="hero__member-card-header">{{ $line2 }}</div>
    <div class="hero__member-card-p">{{ $desc }}</div>

    @auth
        @if(auth()->user()->is_admin)
            <button wire:click="startEditing" class="dj-mct-edit-btn" title="Edit text">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
            </button>

            @if(session()->has('mct_updated'))
                <div class="dj-mct-toast">✓ Updated</div>
            @endif
        @endif
    @endauth

</div>

{{-- Modal rendered inline — position:fixed handles the stacking --}}
@auth
    @if(auth()->user()->is_admin)
        @if($editing)
            <div class="dj-mct-backdrop" wire:click.self="cancel">
                <div class="dj-mct-modal">

                    <div class="dj-mct-modal-header">
                        <span>Edit Member Card Text</span>
                        <button wire:click="cancel" class="dj-mct-close-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"/>
                                <line x1="6" y1="6" x2="18" y2="18"/>
                            </svg>
                        </button>
                    </div>

                    <div class="dj-mct-preview">
                        <div class="hero__member-card-header">{{ $editLine1 ?: '...' }}</div>
                        <div class="hero__member-card-header">{{ $editLine2 ?: '...' }}</div>
                        <div class="hero__member-card-p">{{ $editDesc ?: '...' }}</div>
                    </div>

                    <div class="dj-mct-fields">
                        <label class="dj-field-label">
                            Line 1
                            <input
                                type="text"
                                wire:model.live="editLine1"
                                class="dj-field-input"
                                maxlength="100"
                                placeholder="Join"
                            />
                            @error('editLine1') <p class="dj-field-error">{{ $message }}</p> @enderror
                        </label>

                        <label class="dj-field-label">
                            Line 2
                            <input
                                type="text"
                                wire:model.live="editLine2"
                                class="dj-field-input"
                                maxlength="100"
                                placeholder="Designjoy"
                            />
                            @error('editLine2') <p class="dj-field-error">{{ $message }}</p> @enderror
                        </label>

                        <label class="dj-field-label">
                            Description
                            <input
                                type="text"
                                wire:model.live="editDesc"
                                class="dj-field-input"
                                maxlength="200"
                                placeholder="One subscription to rule them all."
                            />
                            @error('editDesc') <p class="dj-field-error">{{ $message }}</p> @enderror
                        </label>
                    </div>

                    <div class="dj-mct-actions">
                        <button wire:click="save"   class="dj-btn-save">Save</button>
                        <button wire:click="cancel" class="dj-btn-cancel">Cancel</button>
                    </div>

                </div>
            </div>
        @endif
    @endif
@endauth

<style>
    .dj-mct-wrapper { position: relative; }

    .dj-mct-edit-btn {
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
    .dj-mct-wrapper:hover .dj-mct-edit-btn { opacity: 1; transform: scale(1); }
    .dj-mct-edit-btn:hover { background: #2563eb; transform: scale(1.1) !important; }

    .dj-mct-toast {
        position: absolute; top: -30px; left: 0;
        background: #22c55e; color: white;
        padding: 3px 10px; border-radius: 4px;
        font-size: 12px; font-weight: 500; white-space: nowrap;
        z-index: 9999; animation: dj-mct-fade 2.5s ease forwards;
    }
    @keyframes dj-mct-fade { 0%,60%{opacity:1} 100%{opacity:0} }

    .dj-mct-backdrop {
        position: fixed; inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 2147483647;
        display: flex; align-items: center; justify-content: center;
        padding: 20px;
        backdrop-filter: blur(3px);
    }
    .dj-mct-modal {
        background: white; border-radius: 16px;
        width: 100%; max-width: 440px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.25);
        display: flex; flex-direction: column; overflow: hidden;
    }
    .dj-mct-modal-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 16px 20px; border-bottom: 1px solid #e2e8f0;
        font-size: 15px; font-weight: 700; color: #1e293b;
    }
    .dj-mct-close-btn {
        background: #f1f5f9; border: none; border-radius: 50%;
        width: 32px; height: 32px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: #64748b; transition: all 0.15s;
    }
    .dj-mct-close-btn:hover { background: #e2e8f0; color: #1e293b; }
    .dj-mct-preview {
        background: #f8fafc; border: 1px dashed #cbd5e1;
        border-radius: 8px; padding: 14px; margin: 16px 20px 0;
    }
    .dj-mct-preview .hero__member-card-header { color: #1e293b !important; }
.dj-mct-preview .hero__member-card-p      { color: #475569 !important; }
    .dj-mct-fields { display: flex; flex-direction: column; gap: 10px; padding: 16px 20px 0; }
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
    .dj-mct-actions { display: flex; gap: 8px; padding: 16px 20px; }
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