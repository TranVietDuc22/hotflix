<div>
    <form class="sign__form" wire:submit="resetPassword">
        <a href="index.html" class="sign__logo">
            <img src="{{asset('img/logo_2.png')}}" style="transform: scale(1.5);" alt="">
        </a>

        <div class="sign__group">
            <input type="password" class="sign__input" placeholder="Mật khẩu" wire:model="password">
            <div>@error('password')<span class="text-danger"> {{ $message }} @enderror</div>
        </div>
        <div class="sign__group">
            <input type="password" class="sign__input" placeholder="Nhập lại mật khẩu" wire:model="password_confirmation">
            <div>@error('password_confirmation')<span class="text-danger"> {{ $message }} @enderror</div>
        </div>

        <span class="sign__text"><a wire:click.prevent="login" href="">Đăng nhập</a></span>

        <button class="sign__btn" >Đặt lại mật khẩu</button>

    </form>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('show-alert', event => {
                Swal.fire({
                    icon: event.type,
                    title: event.message,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 5000
                });
            });
        });
    </script>

</div>
