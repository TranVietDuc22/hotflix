<div class="container">
    <div class="row">
        @foreach($films as $film)
            @php
                $isFavorite = in_array($film['id'], $favoriteFilms);
            @endphp
        <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
            <div class="item">
                <div class="item__cover">
                    <img src="{{ $film['poster'] }}" class="custom-img">
                    <a wire:click.prevent="detailFilm('{{ $film['uuid'] }}')" href="#" class="item__play">
                        <i class="ti ti-player-play-filled"></i>
                    </a>
                    {{-- <span class="item__rate item__rate--green">8.4</span>--}}
                    <button class="item__favorite" type="button"
                            wire:click="saveFavorite({{ $film['id'] }})"
                            wire:loading.attr="disabled"
                            wire:key="favorite-list-{{ $film['id'] }}"
                            :class="{'item__favorite--active': {{ $isFavorite ? 'true' : 'false' }} }">
                        <i class="ti ti-bookmark"></i>
                    </button>
                </div>
                <div class="item__content">
                    <h3 class="item__title"><a wire:click.prevent="detailFilm('{{ $film['uuid'] }}')" href="details.html">{{ $film ['title'] }}</a></h3>
                    <span class="item__category">
{{--                        <a href="#">{{ $film['language'] }}</a>--}}
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-12">
            <button class="section__more" type="button" wire:click.prevent="loadMore">Hiển thị thêm</button>
        </div>
    </div>

</div>
