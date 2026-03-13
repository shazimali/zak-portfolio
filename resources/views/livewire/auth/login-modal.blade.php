<div>
    @if($showModal)
    <div style="position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 2147483647; display: flex; align-items: center; justify-content: center; padding: 20px; backdrop-filter: blur(3px);">
        <div style="background: white; border-radius: 16px; width: 100%; max-width: 460px; box-shadow: 0 20px 60px rgba(0,0,0,0.25); display: flex; flex-direction: column; overflow: hidden; font-family: inherit;">

            {{-- Header --}}
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 16px 20px; border-bottom: 1px solid #e2e8f0;">
                <span style="font-size: 15px; font-weight: 700; color: #1e293b;">Admin Login</span>
                <button wire:click="closeModal" style="background: #f1f5f9; border: none; border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #64748b; transition: all 0.15s; font-size: 18px; line-height: 1;"
                    onmouseover="this.style.background='#e2e8f0';this.style.color='#1e293b'"
                    onmouseout="this.style.background='#f1f5f9';this.style.color='#64748b'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
            </div>

            {{-- Form --}}
            <form wire:submit="login" style="display: flex; flex-direction: column; gap: 12px; padding: 16px 20px 20px;">

                <label style="display: flex; flex-direction: column; gap: 4px; font-size: 11px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.04em;">
                    Email
                    <input type="email" wire:model="email"
                        placeholder="admin@example.com"
                        style="width: 100%; padding: 8px 12px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; color: #1e293b; outline: none; box-sizing: border-box; font-family: inherit; transition: border-color 0.15s;"
                        onfocus="this.style.borderColor='#3b82f6'"
                        onblur="this.style.borderColor='#e2e8f0'">
                    @error('email') <span style="font-size: 11px; color: #ef4444;">{{ $message }}</span> @enderror
                </label>

                <label style="display: flex; flex-direction: column; gap: 4px; font-size: 11px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: 0.04em;">
                    Password
                    <input type="password" wire:model="password"
                        placeholder="••••••••"
                        style="width: 100%; padding: 8px 12px; border: 1.5px solid #e2e8f0; border-radius: 8px; font-size: 14px; color: #1e293b; outline: none; box-sizing: border-box; font-family: inherit; transition: border-color 0.15s;"
                        onfocus="this.style.borderColor='#3b82f6'"
                        onblur="this.style.borderColor='#e2e8f0'">
                    @error('password') <span style="font-size: 11px; color: #ef4444;">{{ $message }}</span> @enderror
                </label>

                {{-- Actions --}}
                <div style="display: flex; gap: 8px; margin-top: 4px;">
                    <button type="submit"
    class="button-filled w-inline-block"
    style="flex: 1; border: none; cursor: pointer; text-align: center;"
    onmouseover="this.style.opacity='0.85'"
    onmouseout="this.style.opacity='1'">
    <div>
        <span wire:loading.remove wire:target="login">Login</span>
        <span wire:loading wire:target="login">Signing in…</span>
    </div>
</button>
                    <button type="button" wire:click="closeModal"
                        style="flex: 1; padding: 9px 0; background: #f1f5f9; color: #64748b; border: none; border-radius: 8px; font-size: 14px; font-weight: 600; cursor: pointer; transition: background 0.15s;"
                        onmouseover="this.style.background='#e2e8f0'"
                        onmouseout="this.style.background='#f1f5f9'">
                        Cancel
                    </button>
                </div>

            </form>
        </div>
    </div>
    @endif
</div>