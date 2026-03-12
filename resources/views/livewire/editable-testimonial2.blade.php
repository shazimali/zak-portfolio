<div class="div-block-14 dj-t2-wrapper">

    {{-- ── VIEW MODE ── --}}
    @if(! $editing)
        <div class="text-block-2">
            {{ $quote }}<br />
        </div>

        <div class="div-block-15">
            {{-- Avatar with its own upload button --}}
            <div class="dj-t2-avatar-wrapper">
                <img loading="lazy" src="{{ asset($avatarPath) }}" alt="" class="image-13" />

                @auth
                    @if(auth()->user()->is_admin)
                        <label class="dj-t2-avatar-edit-btn" title="Change avatar" data-wf-ignore>
                            <input
                                type="file"
                                accept="image/*"
                                wire:model="newAvatar"
                                data-wf-ignore
                                style="
                                    position: absolute !important;
                                    inset: 0 !important;
                                    width: 100% !important;
                                    height: 100% !important;
                                    opacity: 0 !important;
                                    z-index: 10 !important;
                                    cursor: pointer !important;
                                    overflow: visible !important;
                                "
                            />
                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                                 style="position:relative;z-index:2;pointer-events:none;display:block;">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </label>

                        <style>
                            .dj-t2-avatar-edit-btn input[type="file"],
                            .dj-t2-avatar-edit-btn input[type="file"].w-file-upload-input {
                                position: absolute !important; inset: 0 !important;
                                width: 100% !important; height: 100% !important;
                                opacity: 0 !important; z-index: 10 !important;
                                overflow: visible !important;
                            }
                        </style>

                        <div wire:loading wire:target="newAvatar" class="dj-t2-avatar-loading">
                            <div class="dj-t2-spinner"></div>
                        </div>

                        @if(session()->has('t2_avatar_updated'))
                            <div class="dj-t2-toast">✓ Avatar updated</div>
                        @endif
                    @endif
                @endauth
            </div>

            <div class="div-block-16">
                <div class="text-block-3">{{ $name }}</div>
                <div>{{ $source }}</div>
            </div>
        </div>

        @auth
            @if(auth()->user()->is_admin)
                <button wire:click="startEditing" class="dj-t2-edit-btn" title="Edit testimonial">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                    </svg>
                </button>

                @if(session()->has('t2_updated'))
                    <div class="dj-t2-toast">✓ Testimonial updated</div>
                @endif
            @endif
        @endauth

    {{-- ── EDIT MODE ── --}}
    @else
        <div class="dj-t2-editor">

            {{-- Live preview --}}
            <div class="dj-t2-preview">
                <div class="text-block-2">{{ $editQuote ?: '...' }}</div>
                <div class="div-block-15" style="margin-top: 10px;">
                    <img loading="lazy" src="{{ asset($avatarPath) }}" alt="" class="image-13" />
                    <div class="div-block-16">
                        <div class="text-block-3">{{ $editName ?: '...' }}</div>
                        <div>{{ $editSource ?: '...' }}</div>
                    </div>
                </div>
            </div>

            {{-- Fields --}}
            <div class="dj-t2-fields">
                <label class="dj-field-label">
                    Quote
                    <textarea
                        wire:model.live="editQuote"
                        class="dj-field-textarea"
                        maxlength="300"
                        rows="3"
                        placeholder='"Design is everything, and these guys have nailed it."'
                    ></textarea>
                    @error('editQuote') <p class="dj-field-error">{{ $message }}</p> @enderror
                </label>

                <label class="dj-field-label">
                    Name
                    <input
                        type="text"
                        wire:model.live="editName"
                        class="dj-field-input"
                        maxlength="100"
                        placeholder="Kevin O'Leary"
                    />
                    @error('editName') <p class="dj-field-error">{{ $message }}</p> @enderror
                </label>

                <label class="dj-field-label">
                    Source / Title
                    <input
                        type="text"
                        wire:model.live="editSource"
                        class="dj-field-input"
                        maxlength="100"
                        placeholder="Shark Tank"
                    />
                    @error('editSource') <p class="dj-field-error">{{ $message }}</p> @enderror
                </label>
            </div>

            <div class="dj-t2-actions">
                <button wire:click="save"   class="dj-btn-save">Save</button>
                <button wire:click="cancel" class="dj-btn-cancel">Cancel</button>
            </div>

        </div>
    @endif

</div>

<style>
    .dj-t2-wrapper { position: relative; }

    /* Main edit button */
    .dj-t2-edit-btn {
        position: absolute; top: -12px; right: -12px;
        background: #3b82f6; border: none; border-radius: 50%;
        width: 26px; height: 26px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: white;
        opacity: 0; transform: scale(0.8);
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15); padding: 0;
    }
    .dj-t2-wrapper:hover .dj-t2-edit-btn { opacity: 1; transform: scale(1); }
    .dj-t2-edit-btn:hover { background: #2563eb; transform: scale(1.1) !important; }

    /* Avatar wrapper + edit button */
    .dj-t2-avatar-wrapper { position: relative; display: inline-block; }
    .dj-t2-avatar-wrapper:hover img { outline: 2px solid #3b82f6; outline-offset: 3px; border-radius: 50%; }
    .dj-t2-avatar-edit-btn {
        position: absolute; top: -8px; right: -8px;
        background: #3b82f6; border-radius: 50%;
        width: 22px; height: 22px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: white;
        opacity: 0; transform: scale(0.8);
        transition: all 0.2s ease;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        z-index: 9999; padding: 0; overflow: hidden;
    }
    .dj-t2-avatar-wrapper:hover .dj-t2-avatar-edit-btn { opacity: 1; transform: scale(1); }
    .dj-t2-avatar-edit-btn:hover { background: #2563eb; transform: scale(1.1) !important; }

    .dj-t2-avatar-loading {
        position: absolute; inset: 0;
        background: rgba(255,255,255,0.85);
        display: flex; align-items: center; justify-content: center;
        border-radius: 50%; z-index: 9999;
    }
    .dj-t2-spinner {
        width: 16px; height: 16px;
        border: 2px solid rgba(59,130,246,0.3);
        border-radius: 50%; border-top-color: #3b82f6;
        animation: dj-t2-spin 0.8s linear infinite;
    }
    @keyframes dj-t2-spin { to { transform: rotate(360deg); } }

    .dj-t2-toast {
        position: absolute; top: -30px; left: 0;
        background: #22c55e; color: white;
        padding: 3px 10px; border-radius: 4px;
        font-size: 12px; white-space: nowrap;
        z-index: 9999; animation: dj-t2-fade 2.5s ease forwards;
    }
    @keyframes dj-t2-fade { 0%,60%{opacity:1} 100%{opacity:0} }

    /* Editor panel */
    .dj-t2-editor {
        background: white; border: 1.5px solid #e2e8f0;
        border-radius: 12px; padding: 16px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.10);
        display: flex; flex-direction: column; gap: 12px;
    }
    .dj-t2-preview {
        background: #f8fafc; border: 1px dashed #cbd5e1;
        border-radius: 8px; padding: 14px;
    }
    .dj-t2-fields { display: flex; flex-direction: column; gap: 10px; }
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
    .dj-field-textarea {
        width: 100%; padding: 8px 12px;
        border: 1.5px solid #e2e8f0; border-radius: 8px;
        font-size: 14px; color: #1e293b; outline: none;
        transition: border-color 0.15s; box-sizing: border-box;
        resize: vertical; font-family: inherit; line-height: 1.6;
    }
    .dj-field-textarea:focus { border-color: #3b82f6; }
    .dj-field-error { margin: 0; font-size: 12px; color: #ef4444; }
    .dj-t2-actions { display: flex; gap: 8px; }
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