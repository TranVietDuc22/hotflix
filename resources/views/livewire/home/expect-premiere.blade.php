<div class="splide__track" wire:ignore>
    <ul class="splide__list">
        @foreach($films as $film)
            @php
                $isFavorite = in_array($film['id'], $favoriteFilms);
            @endphp
            <li class="splide__slide">
                <div class="item item--carousel">
                    <div class="item__cover">
                        <img src="{{ $film['poster'] }}" class="custom-img" alt="">
                        <a wire:click.prevent="detailFilm('{{ $film['uuid'] }}')" href="details.html"
                           class="item__play">
                            <i class="ti ti-player-play-filled"></i>
                        </a>
                        <button class="item__favorite" type="button"
                                wire:click="saveFavorite({{ $film['id'] }})"
                                wire:loading.attr="disabled"
                                wire:key="favorite-premiere-{{ $film['id'] }}"
                                :class="{'item__favorite--active': {{ $isFavorite ? 'true' : 'false' }} }">
                            <i class="ti ti-bookmark"></i>
                        </button>
                    </div>
                    <div class="item__content">
                        <h3 class="item__title"><a wire:click.prevent="detailFilm('{{$film['uuid']}}')" href="">{{ $film['title'] }}</a></h3>
                        <span class="item__category">
{{--                             <a href="#">{{$film['language']}}</a>--}}
                        </span>
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
</div>
