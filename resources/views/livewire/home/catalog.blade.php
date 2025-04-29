<ul class="header__nav">
    <!-- dropdown -->

    <li class="header__nav-item">
        <a href="{{route('home')}}" class="header__nav-link">Trang chủ</a>
    </li>
    @foreach ($categories as $categorie)
        <li class="header__nav-item">
            <a href="#" class="header__nav-link" wire:click.prevent="browserByType('{{ $categorie['uuid'] }}', '1')">
                {{ $categorie['title'] }}
            </a>
        </li>
    @endforeach

    <!-- Quốc gia -->
    <li class="header__nav-item">
        <a class="header__nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Quốc gia <i class="ti ti-chevron-down"></i>
        </a>
        <ul class="dropdown-menu header__dropdown-menu custom-scroll">
            @foreach ($countries as $country)
                <li>
                    <a href="#" wire:click.prevent="browserByType('{{ $country['uuid'] }}', '2')">
                        {{ $country['name'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </li>

    <!-- Thể loại -->
    <li class="header__nav-item">
        <a class="header__nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Thể loại <i class="ti ti-chevron-down"></i>
        </a>
        <ul class="dropdown-menu header__dropdown-menu custom-scroll">
            @foreach ($genres as $genre)
                <li>
                    <a href="#" wire:click.prevent="browserByType('{{ $genre['uuid'] }}', '3')">
                        {{ $genre['title'] }}
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
    <!-- end dropdown -->
</ul>
