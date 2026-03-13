<div class="dj-sub-img-wrapper">

    <img
        style="opacity: 0"
        data-w-id="4bf06ab7-87fa-09aa-0827-163070733ecc"
        alt=""
        src="{{ asset($imagePath) }}"
        loading="lazy"
        class="image-3"
    />

    @auth
        @if(auth()->user()->is_admin)
            <label class="dj-sub-img-edit-btn" title="Edit image" data-wf-ignore>
                <input
                    type="file"
                    accept="image/*"
                    wire:model="newImage"
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
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13"
                     viewBox="0 0 24 24" fill="none" stroke="currentColor"
                     stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"
                     style="position: relative; z-index: 2; pointer-events: none; display: block;">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                </svg>
            </label>

            {{-- Override Webflow hijacking the file input --}}
            <style>
                .dj-sub-img-edit-btn input[type="file"],
                .dj-sub-img-edit-btn input[type="file"].w-file-upload-input {
                    position: absolute !important;
                    inset: 0 !important;
                    width: 100% !important;
                    height: 100% !important;
                    opacity: 0 !important;
                    z-index: 10 !important;
                    overflow: visible !important;
                }
            </style>

            <div wire:loading wire:target="newImage" class="dj-sub-img-loading">
                <div class="dj-sub-img-spinner"></div>
            </div>

            @if(session()->has('image_updated'))
                <div class="dj-sub-img-toast">✓ Image updated</div>
            @endif

            @error('newImage')
                <div class="dj-sub-img-error">{{ $message }}</div>
            @enderror

        @endif
    @endauth

</div>

<style>
    .dj-sub-img-wrapper {
        position: relative;
        display: inline-block;
    }

    /* Outline only for admins */
    @auth
        @if(auth()->user()->is_admin)
            .dj-sub-img-wrapper:hover > img {
                outline: 2px solid #3b82f6;
                outline-offset: 4px;
                border-radius: 2px;
            }
        @endif
    @endauth

    .dj-sub-img-edit-btn {
        position: absolute;
        top: -12px;
        right: -12px;
        background: #3b82f6;
        border-radius: 50%;
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: white;
        opacity: 0;
        transform: scale(0.8);
        transition: all 0.2s ease;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        z-index: 9999;
        padding: 0;
        overflow: hidden;
    }
    .dj-sub-img-wrapper:hover .dj-sub-img-edit-btn {
        opacity: 1;
        transform: scale(1);
    }
    .dj-sub-img-edit-btn:hover {
        background: #2563eb;
        transform: scale(1.1) !important;
    }
    .dj-sub-img-loading {
        position: absolute;
        inset: 0;
        background: rgba(255,255,255,0.85);
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 4px;
        z-index: 9999;
        backdrop-filter: blur(2px);
    }
    .dj-sub-img-spinner {
        width: 20px;
        height: 20px;
        border: 3px solid rgba(59,130,246,0.3);
        border-radius: 50%;
        border-top-color: #3b82f6;
        animation: dj-sub-spin 0.8s linear infinite;
    }
    @keyframes dj-sub-spin { to { transform: rotate(360deg); } }
    .dj-sub-img-toast {
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
        animation: dj-sub-fade 2.5s ease forwards;
    }
    .dj-sub-img-error {
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
    @keyframes dj-sub-fade { 0%,60%{opacity:1} 100%{opacity:0} }
</style>