<div>
    <form action="#" class="header__search" wire:submit="search">
        <input class="header__search-input" type="text" placeholder="Nhập từ khóa..." wire:model="slug">
        <button class="header__search-button" type="submit">
            <i class="ti ti-search"></i>
        </button>
        <button class="header__search-close" type="button">
            <i class="ti ti-x"></i>
        </button>
    </form>

    <button class="header__search-btn" type="button">
        <i class="ti ti-search"></i>
    </button>
</div>
