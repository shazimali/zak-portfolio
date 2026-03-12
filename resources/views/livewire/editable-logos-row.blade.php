<div>

    @if($isAdmin)
        <style>
            .dj-logos-wrapper:hover .logos__row {
                outline: 2px solid #3b82f6;
                outline-offset: 6px;
                border-radius: 4px;
            }
        </style>
    @endif

    <div class="dj-logos-wrapper">

        {{-- ── Logo row (default images show when DB has no value) ── --}}
        <div class="logos__row">
            @foreach($logos as $i => $src)
                {{--
                    $src is either:
                      "assets/images/..."   → default, needs asset()
                      "storage/logos/..."   → uploaded, needs asset()
                    Both are relative so asset() works for both.
                --}}
                <img loading="lazy"
                     src="{{ asset($src) }}"
                     alt="Partner logo {{ $i + 1 }}"
                     onerror="this.src='{{ asset(App\Livewire\EditableLogosRow::DEFAULTS[$i]) }}'" />
            @endforeach
        </div>

        @if($isAdmin)
            <button wire:click="startEditing" class="dj-logos-edit-btn" title="Edit logos">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
            </button>

            @if(session()->has('logos_updated'))
                <div class="dj-logos-toast">✓ Logos updated</div>
            @endif
        @endif

    </div>

    {{-- ── Modal ── --}}
    @if($isAdmin && $editing)
        <div class="dj-logos-backdrop" wire:click.self="cancel">
            <div class="dj-logos-modal">

                <div class="dj-logos-modal-header">
                    <span>Edit Partner Logos</span>
                    <button wire:click="cancel" class="dj-logos-close-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                    </button>
                </div>

                <div class="dj-logos-body">

                    {{-- Slot 0 --}}
                    <div class="dj-logo-row">
                        <div class="dj-logo-preview">
                            <img src="{{ $previews[0] ? $previews[0] : asset($logos[0]) }}" alt="Logo 1"
                                 onerror="this.src='{{ asset(App\Livewire\EditableLogosRow::DEFAULTS[0]) }}'" />
                        </div>
                        <div class="dj-logo-upload-wrap">
                            <label class="dj-field-label">Logo 1
                                <input type="file" wire:model="upload0" class="dj-file-input" accept="image/*,.svg" />
                                <span wire:loading wire:target="upload0" class="dj-uploading">Uploading…</span>
                                @error('upload0') <span class="dj-field-error">{{ $message }}</span> @enderror
                            </label>
                        </div>
                        <button wire:click="resetLogo(0)" class="dj-logo-reset-btn" title="Reset to default">↺</button>
                    </div>

                    {{-- Slot 1 --}}
                    <div class="dj-logo-row">
                        <div class="dj-logo-preview">
                            <img src="{{ $previews[1] ? $previews[1] : asset($logos[1]) }}" alt="Logo 2"
                                 onerror="this.src='{{ asset(App\Livewire\EditableLogosRow::DEFAULTS[1]) }}'" />
                        </div>
                        <div class="dj-logo-upload-wrap">
                            <label class="dj-field-label">Logo 2
                                <input type="file" wire:model="upload1" class="dj-file-input" accept="image/*,.svg" />
                                <span wire:loading wire:target="upload1" class="dj-uploading">Uploading…</span>
                                @error('upload1') <span class="dj-field-error">{{ $message }}</span> @enderror
                            </label>
                        </div>
                        <button wire:click="resetLogo(1)" class="dj-logo-reset-btn" title="Reset to default">↺</button>
                    </div>

                    {{-- Slot 2 --}}
                    <div class="dj-logo-row">
                        <div class="dj-logo-preview">
                            <img src="{{ $previews[2] ? $previews[2] : asset($logos[2]) }}" alt="Logo 3"
                                 onerror="this.src='{{ asset(App\Livewire\EditableLogosRow::DEFAULTS[2]) }}'" />
                        </div>
                        <div class="dj-logo-upload-wrap">
                            <label class="dj-field-label">Logo 3
                                <input type="file" wire:model="upload2" class="dj-file-input" accept="image/*,.svg" />
                                <span wire:loading wire:target="upload2" class="dj-uploading">Uploading…</span>
                                @error('upload2') <span class="dj-field-error">{{ $message }}</span> @enderror
                            </label>
                        </div>
                        <button wire:click="resetLogo(2)" class="dj-logo-reset-btn" title="Reset to default">↺</button>
                    </div>

                    {{-- Slot 3 --}}
                    <div class="dj-logo-row">
                        <div class="dj-logo-preview">
                            <img src="{{ $previews[3] ? $previews[3] : asset($logos[3]) }}" alt="Logo 4"
                                 onerror="this.src='{{ asset(App\Livewire\EditableLogosRow::DEFAULTS[3]) }}'" />
                        </div>
                        <div class="dj-logo-upload-wrap">
                            <label class="dj-field-label">Logo 4
                                <input type="file" wire:model="upload3" class="dj-file-input" accept="image/*,.svg" />
                                <span wire:loading wire:target="upload3" class="dj-uploading">Uploading…</span>
                                @error('upload3') <span class="dj-field-error">{{ $message }}</span> @enderror
                            </label>
                        </div>
                        <button wire:click="resetLogo(3)" class="dj-logo-reset-btn" title="Reset to default">↺</button>
                    </div>

                    {{-- Slot 4 --}}
                    <div class="dj-logo-row">
                        <div class="dj-logo-preview">
                            <img src="{{ $previews[4] ? $previews[4] : asset($logos[4]) }}" alt="Logo 5"
                                 onerror="this.src='{{ asset(App\Livewire\EditableLogosRow::DEFAULTS[4]) }}'" />
                        </div>
                        <div class="dj-logo-upload-wrap">
                            <label class="dj-field-label">Logo 5
                                <input type="file" wire:model="upload4" class="dj-file-input" accept="image/*,.svg" />
                                <span wire:loading wire:target="upload4" class="dj-uploading">Uploading…</span>
                                @error('upload4') <span class="dj-field-error">{{ $message }}</span> @enderror
                            </label>
                        </div>
                        <button wire:click="resetLogo(4)" class="dj-logo-reset-btn" title="Reset to default">↺</button>
                    </div>

                </div>

                <div class="dj-logos-actions">
                    <button wire:click="save" class="dj-btn-save">
                        <span wire:loading.remove wire:target="save">Save Changes</span>
                        <span wire:loading       wire:target="save">Saving…</span>
                    </button>
                    <button wire:click="cancel" class="dj-btn-cancel">Cancel</button>
                </div>

            </div>
        </div>
    @endif

    <style>
        .dj-logos-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        /* ── Edit button ── */
        .dj-logos-edit-btn {
            position: absolute; top: -12px; right: -12px;
            background: #3b82f6; border: none; border-radius: 50%;
            width: 26px; height: 26px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: white;
            opacity: 0; transform: scale(0.8);
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            padding: 0; z-index: 10;
        }
        .dj-logos-wrapper:hover .dj-logos-edit-btn { opacity: 1; transform: scale(1); }
        .dj-logos-edit-btn:hover { background: #2563eb; transform: scale(1.1) !important; }

        /* ── Toast ── */
        .dj-logos-toast {
            position: absolute; top: -30px; left: 0;
            background: #22c55e; color: white;
            padding: 3px 10px; border-radius: 4px;
            font-size: 12px; font-weight: 500; white-space: nowrap;
            animation: dj-logos-fade 2.5s ease forwards;
        }
        @keyframes dj-logos-fade { 0%,60%{opacity:1} 100%{opacity:0} }

        /* ── Backdrop / Modal ── */
        .dj-logos-backdrop {
            position: fixed; inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 2147483647;
            display: flex; align-items: center; justify-content: center;
            padding: 20px; backdrop-filter: blur(3px);
        }
        .dj-logos-modal {
            background: white; border-radius: 16px;
            width: 100%; max-width: 480px; max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 20px 60px rgba(0,0,0,0.25);
            display: flex; flex-direction: column;
        }
        .dj-logos-modal-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 20px; border-bottom: 1px solid #e2e8f0;
            font-size: 15px; font-weight: 700; color: #1e293b;
            position: sticky; top: 0; background: white; z-index: 1;
        }
        .dj-logos-close-btn {
            background: #f1f5f9; border: none; border-radius: 50%;
            width: 32px; height: 32px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: #64748b; transition: all 0.15s;
        }
        .dj-logos-close-btn:hover { background: #e2e8f0; color: #1e293b; }

        /* ── Logo rows ── */
        .dj-logos-body { display: flex; flex-direction: column; gap: 10px; padding: 16px 20px; }
        .dj-logo-row {
            display: flex; align-items: center; gap: 12px;
            background: #f8fafc; border: 1px solid #e2e8f0;
            border-radius: 10px; padding: 10px 12px;
        }
        .dj-logo-preview {
            width: 64px; height: 40px; flex-shrink: 0;
            display: flex; align-items: center; justify-content: center;
            background: white; border: 1px solid #e2e8f0;
            border-radius: 6px; overflow: hidden; padding: 4px;
            box-sizing: border-box;
        }
        .dj-logo-preview img { max-width: 100%; max-height: 100%; object-fit: contain; }
        .dj-logo-upload-wrap { flex: 1; min-width: 0; }
        .dj-field-label {
            display: flex; flex-direction: column; gap: 4px;
            font-size: 11px; font-weight: 600; color: #64748b;
            text-transform: uppercase; letter-spacing: 0.04em;
        }
        .dj-file-input {
            font-size: 12px; color: #1e293b;
            border: 1.5px solid #e2e8f0; border-radius: 6px;
            padding: 5px 8px; background: white; cursor: pointer;
            width: 100%; box-sizing: border-box; margin-top: 2px;
        }
        .dj-file-input:focus { outline: none; border-color: #3b82f6; }
        .dj-uploading { font-size: 11px; color: #3b82f6; }
        .dj-field-error { font-size: 11px; color: #ef4444; }
        .dj-logo-reset-btn {
            flex-shrink: 0; background: #f1f5f9;
            border: 1px solid #e2e8f0; border-radius: 6px;
            width: 30px; height: 30px; font-size: 16px;
            display: flex; align-items: center; justify-content: center;
            cursor: pointer; color: #64748b; transition: all 0.15s;
        }
        .dj-logo-reset-btn:hover { background: #fee2e2; border-color: #fca5a5; color: #ef4444; }

        /* ── Actions ── */
        .dj-logos-actions {
            display: flex; gap: 8px; padding: 16px 20px;
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
    </style>

</div>