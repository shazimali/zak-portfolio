<div class="dj-editable-wrapper" style="position: relative; display: inline-block;">
    <img
        loading="lazy"
        src="{{ asset($logoPath) }}"
        alt="Logo"
        class="image-23"
        style="display: block; transition: outline 0.2s; border-radius: 2px;"
    />

    @auth
        @if(auth()->user()->is_admin)

            <label class="dj-edit-overlay" title="Edit Logo">
                <input
                    type="file"
                    accept="image/*"
                    wire:model="newLogo"
                    style="
                        position: absolute;
                        inset: 0;
                        width: 100%;
                        height: 100%;
                        opacity: 0;
                        cursor: pointer;
                        z-index: 1;
                    "
                />
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                     viewBox="0 0 24 24" fill="none" stroke="white"
                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                     style="position: relative; z-index: 2; pointer-events: none; display: block;">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
            </label>

            <div wire:loading wire:target="newLogo" class="dj-loading-overlay">
                <div class="dj-spinner"></div>
            </div>

            @if(session()->has('logo_updated'))
                <div class="dj-toast">✓ Logo updated</div>
            @endif

            @error('newLogo')
                <div class="dj-error-tip">{{ $message }}</div>
            @enderror

            {{-- Outline only renders for admins --}}
            <style>
                .dj-editable-wrapper:hover > img {
                    outline: 2px solid #3b82f6;
                    outline-offset: 4px;
                }
            </style>

        @endif
    @endauth
</div>

<style>
    .dj-edit-overlay {
        position: absolute;
        top: -12px;
        right: -12px;
        background-color: #3b82f6;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.2s ease;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        z-index: 9999;
        padding: 0;
        overflow: hidden;
    }
    .dj-editable-wrapper:hover .dj-edit-overlay {
        opacity: 1;
        transform: scale(1);
    }
    .dj-edit-overlay:hover {
        background-color: #2563eb;
        transform: scale(1.1) !important;
    }
    .dj-loading-overlay {
        position: absolute;
        inset: -4px;
        background: rgba(255,255,255,0.85);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        z-index: 9999;
        backdrop-filter: blur(2px);
    }
    .dj-spinner {
        width: 20px;
        height: 20px;
        border: 3px solid rgba(59,130,246,0.3);
        border-radius: 50%;
        border-top-color: #3b82f6;
        animation: dj-spin 0.8s linear infinite;
    }
    @keyframes dj-spin { to { transform: rotate(360deg); } }
    .dj-toast {
        position: absolute;
        top: -36px;
        left: 50%;
        transform: translateX(-50%);
        background: #22c55e;
        color: white;
        padding: 4px 10px;
        border-radius: 4px;
        font-size: 12px;
        white-space: nowrap;
        z-index: 9999;
        animation: dj-fade-out 2.5s ease forwards;
    }
    .dj-error-tip {
        position: absolute;
        top: -36px;
        left: 0;
        background: #ef4444;
        color: white;
        padding: 4px 8px;
        border-radius: 4px;
        font-size: 12px;
        white-space: nowrap;
        z-index: 9999;
    }
    @keyframes dj-fade-out { 0%,60% { opacity:1; } 100% { opacity:0; } }
</style>