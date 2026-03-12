@php $isAdmin = auth()->check() && auth()->user()->is_admin; @endphp

<div class="dj-marquee-section" style="position: relative;">

    {{-- Single edit button — top right corner of section, admin only --}}
    @if($isAdmin)
        <div class="dj-mq-btn-row">
            <button wire:click="openEditor" class="dj-mq-open-btn" title="Edit marquee images">
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
                Edit images
            </button>
        </div>
    @endif

    {{-- The marquee (unchanged structure) --}}
    <div class="marquee">
        <div class="marquee-inner">
            @foreach ([false, true] as $isSecond)
            <div class="marquee-element">
                @foreach (range(1, 6) as $slot)
                    <img
                        src="{{ asset($images[$slot]) }}"
                        alt=""
                        loading="lazy"
                        class="image-26{{ $isSecond && $slot === 1 ? ' _3' : '' }}"
                    />
                @endforeach
            </div>
            @endforeach
        </div>
    </div>

    {{-- Editor modal --}}
    @if($isAdmin && $editing)
        <div class="dj-mq-modal-backdrop" wire:click.self="closeEditor">
            <div class="dj-mq-modal">

                <div class="dj-mq-modal-header">
                    <span>Edit Marquee Images</span>
                    <button wire:click="closeEditor" class="dj-mq-close-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"/>
                            <line x1="6" y1="6" x2="18" y2="18"/>
                        </svg>
                    </button>
                </div>

                <div class="dj-mq-grid">
                    @foreach (range(1, 6) as $slot)
                        <div class="dj-mq-card">
                            {{-- Current image preview --}}
                            <div class="dj-mq-preview">
                                <img src="{{ asset($images[$slot]) }}" alt="Image {{ $slot }}" />
                                <div wire:loading wire:target="upload{{ $slot }}" class="dj-mq-card-loading">
                                    <div class="dj-mq-spinner"></div>
                                </div>
                            </div>

                            <div class="dj-mq-card-label">Image {{ $slot }}</div>

                            <div class="dj-mq-card-actions">
                                {{-- Replace --}}
                                <label class="dj-mq-card-btn dj-mq-card-replace" data-wf-ignore>
                                    <input
                                        type="file"
                                        accept="image/*"
                                        wire:model="upload{{ $slot }}"
                                        data-wf-ignore
                                        style="display:none !important;"
                                    />
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                        <polyline points="17 8 12 3 7 8"/>
                                        <line x1="12" y1="3" x2="12" y2="15"/>
                                    </svg>
                                    Replace
                                </label>

                                {{-- Reset --}}
                                <button
                                    wire:click="resetImage({{ $slot }})"
                                    class="dj-mq-card-btn dj-mq-card-reset"
                                    title="Reset to default"
                                >
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                         viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                         stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="1 4 1 10 7 10"/>
                                        <path d="M3.51 15a9 9 0 1 0 .49-3.34"/>
                                    </svg>
                                    Reset
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="dj-mq-modal-footer">
                    <button wire:click="closeEditor" class="dj-btn-save">Done</button>
                </div>
            </div>
        </div>
    @endif

</div>

<style>
    .dj-marquee-section { position: relative; }

    /* Button row above marquee */
    .dj-mq-btn-row {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 8px;
    }

    /* Single floating edit button */
    .dj-mq-open-btn {
        position: relative;
        z-index: 2147483647;
        background: #3b82f6;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 5px 12px 5px 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 5px;
        box-shadow: 0 2px 10px rgba(59,130,246,0.4);
        transition: background 0.15s;
    }
    .dj-mq-open-btn:hover { background: #2563eb; }

    /* Modal backdrop */
    .dj-mq-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        backdrop-filter: blur(3px);
    }

    /* Modal box */
    .dj-mq-modal {
        background: white;
        border-radius: 16px;
        width: 100%;
        max-width: 680px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0,0,0,0.25);
        display: flex;
        flex-direction: column;
    }
    .dj-mq-modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 18px 20px;
        border-bottom: 1px solid #e2e8f0;
        font-size: 15px;
        font-weight: 700;
        color: #1e293b;
        position: sticky;
        top: 0;
        background: white;
        border-radius: 16px 16px 0 0;
    }
    .dj-mq-close-btn {
        background: #f1f5f9;
        border: none;
        border-radius: 50%;
        width: 32px; height: 32px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer; color: #64748b;
        transition: all 0.15s;
    }
    .dj-mq-close-btn:hover { background: #e2e8f0; color: #1e293b; }

    /* Image grid */
    .dj-mq-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px;
        padding: 20px;
    }

    /* Each image card */
    .dj-mq-card {
        border: 1.5px solid #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    .dj-mq-preview {
        position: relative;
        background: #f8fafc;
        padding: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 90px;
    }
    .dj-mq-preview img {
        max-width: 100%;
        max-height: 80px;
        object-fit: contain;
    }
    .dj-mq-card-loading {
        position: absolute; inset: 0;
        background: rgba(255,255,255,0.9);
        display: flex; align-items: center; justify-content: center;
        border-radius: 8px;
    }
    .dj-mq-spinner {
        width: 20px; height: 20px;
        border: 3px solid rgba(59,130,246,0.3);
        border-radius: 50%; border-top-color: #3b82f6;
        animation: dj-mq-spin 0.8s linear infinite;
    }
    @keyframes dj-mq-spin { to { transform: rotate(360deg); } }

    .dj-mq-card-label {
        padding: 6px 10px;
        font-size: 11px;
        font-weight: 600;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-top: 1px solid #e2e8f0;
    }
    .dj-mq-card-actions {
        display: flex;
        gap: 6px;
        padding: 8px 10px;
        border-top: 1px solid #f1f5f9;
    }
    .dj-mq-card-btn {
        flex: 1;
        padding: 6px 4px;
        border-radius: 6px;
        font-size: 11px;
        font-weight: 600;
        cursor: pointer;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 4px;
        transition: all 0.15s;
    }
    .dj-mq-card-replace {
        background: #eff6ff;
        color: #3b82f6;
    }
    .dj-mq-card-replace:hover { background: #dbeafe; }
    .dj-mq-card-reset {
        background: #f8fafc;
        color: #94a3b8;
    }
    .dj-mq-card-reset:hover { background: #fee2e2; color: #ef4444; }

    /* Footer */
    .dj-mq-modal-footer {
        padding: 16px 20px;
        border-top: 1px solid #e2e8f0;
        position: sticky;
        bottom: 0;
        background: white;
        border-radius: 0 0 16px 16px;
    }
    .dj-btn-save {
        width: 100%;
        padding: 10px 0;
        background: #3b82f6; color: white;
        border: none; border-radius: 8px;
        font-size: 14px; font-weight: 600;
        cursor: pointer; transition: background 0.15s;
    }
    .dj-btn-save:hover { background: #2563eb; }
</style>