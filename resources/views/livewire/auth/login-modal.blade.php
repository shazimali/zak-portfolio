<div>
    @if($showModal)
    <div style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; background: rgba(0,0,0,0.6); z-index: 99999; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
        <div style="background: white; padding: 40px; border-radius: 12px; width: 100%; max-width: 400px; box-shadow: 0 10px 25px rgba(0,0,0,0.2); position: relative; font-family: sans-serif;">
            
            <button wire:click="closeModal" style="position: absolute; top: 15px; right: 15px; background: transparent; border: none; cursor: pointer; font-size: 24px; color: #999; line-height: 1;">&times;</button>
            
            <h2 style="margin-top: 0; margin-bottom: 25px; text-align: center; color: #111; font-size: 24px; font-weight: bold;">Admin Login</h2>
            
            <form wire:submit="login">
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-size: 14px; color: #555; font-weight: 500;">Email</label>
                    <input type="email" wire:model="email" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 16px; color: #333;" placeholder="admin@example.com">
                    @error('email') <div style="color: #e53e3e; font-size: 13px; margin-top: 6px; font-weight: 500;">{{ $message }}</div> @enderror
                </div>
                
                <div style="margin-bottom: 30px;">
                    <label style="display: block; margin-bottom: 8px; font-size: 14px; color: #555; font-weight: 500;">Password</label>
                    <input type="password" wire:model="password" style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; box-sizing: border-box; font-size: 16px; color: #333;" placeholder="••••••••">
                </div>
                
                <button type="submit" style="width: 100%; padding: 14px; background: #097fff; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background 0.2s;">
                    Login
                </button>
            </form>
        </div>
    </div>
    @endif
</div>
