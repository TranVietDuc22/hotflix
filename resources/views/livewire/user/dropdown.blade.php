<div class="header__profile">
    <a class="header__sign-in header__sign-in--user" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="ti ti-user"></i>
            <span>{{Auth::user()->name}}</span>
    </a>

    <ul class="dropdown-menu dropdown-menu-end header__dropdown-menu header__dropdown-menu--user">
        <li><a wire:click.prevent="profile" href=""><i class="ti ti-ghost"></i>Tài khoản</a></li>
        <li><a wire:click.prevent="favorite" href=""><i class="ti ti-bookmark"></i>Yêu thích</a></li>
        <li><a wire:click.prevent="logout" href=""><i class="ti ti-logout"></i>Đăng xuất</a></li>
    </ul>
</div>
