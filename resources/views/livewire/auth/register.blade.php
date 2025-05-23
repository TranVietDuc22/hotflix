<div>
    <form class="sign__form" wire:submit="register">
        <a href="index.html" class="sign__logo">
            <img src="{{asset('img/logo_2.png')}}" style="transform: scale(1.5);" alt="">
        </a>

        <div class="sign__group">
            <input type="text" class="sign__input" placeholder="Tên" wire:model="name">
            <div>@error('name')<span class="text-danger"> {{ $message }} @enderror</div>
        </div>

        <div class="sign__group">
            <input type="text" class="sign__input" placeholder="Email" wire:model="email">
            <div>@error('email')<span class="text-danger"> {{ $message }} @enderror</div>
        </div>

        <div class="sign__group">
            <input type="password" class="sign__input" placeholder="Mật khẩu" wire:model="password">
            <div>@error('password')<span class="text-danger"> {{ $message }} @enderror</div>
        </div>

        <div class="sign__group">
            <input type="password" class="sign__input" placeholder="Nhập lại mật khẩu" wire:model="password_confirmation">
            <div>@error('password_confirmation')<span class="text-danger"> {{ $message }} @enderror</div>
        </div>
        @if (session('successRegister'))
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
            </svg>
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                    Kiểm tra email của bạn!
                </div>
            </div>
            <button wire:click.prevent="resendEmail" class="btn btn-primary mb-3">Gửi lại</button>
        @endif
        @if (session('resendEmail'))
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
            </svg>
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <div>
                    Email đã được gửi lại!
                </div>
            </div>
            <button wire:click.prevent="resendEmail" class="btn btn-primary mb-3">Gửi lại</button>
        @endif
        @if (session('errorRegister'))
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </symbol>
            </svg>
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                <div>
                    Có lỗi!!
                </div>
            </div>
            <button wire:click.prevent="resendEmail" class="btn btn-primary mb-3">Gửi lại</button>
        @endif
        <button class="sign__btn">Đăng ký</button>

        <span class="sign__text">Đã có tài khoản? <a wire:click.prevent="login" href="">Đăng nhập!</a></span>
    </form>
</div>
