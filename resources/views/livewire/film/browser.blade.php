<div >
    <!-- page title -->
    <section class="section section--first">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h1 class="section__title section__title--head">{{$browser}}</h1>
                        <!-- end section title -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <!-- fixed filter wrap -->
    <div>
        <!-- catalog -->
        <div class="section section--catalog">
            <div class="container">
                <div class="row">
                    @foreach($films as $film)
                        @php
                            $isFavorite = in_array($film['id'], $favoriteFilms);
                        @endphp
                            <!-- item -->
                        <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                            <div class="item">
                                <div class="item__cover">
                                    <img src="{{ $film['poster'] }}" class="custom-img" alt="">
                                    <a wire:click.prevent="detailFilm('{{$film['movie_uuid']}}')" href="details.html"
                                       class="item__play">
                                        <i class="ti ti-player-play-filled"></i>
                                    </a>
                                    <button class="item__favorite" type="button"
                                            wire:click="saveFavorite({{ $film['id'] }})"
                                            wire:loading.attr="disabled"
                                            wire:key="favorite-browser-{{ $film['id'] }}"
                                            :class="{'item__favorite--active': {{ $isFavorite ? 'true' : 'false' }} }">
                                        <i class="ti ti-bookmark"></i>
                                    </button>
                                </div>
                                <div class="item__content">
                                    <h3 class="item__title"><a wire:click.prevent="detailFilm('{{$film['movie_uuid']}}')" href="details.html">{{$film['title']}}</a></h3>
                                    <span class="text-warning item__category">{{$film['genre_title']}}</span>
                                </div>
                            </div>
                        </div>
                        <!-- end item -->
                    @endforeach
                <div class="row">
                    <div class="col-12">
                        {{ $films->links() }}
                    </div>
                </div>
                </div>
            </div>
        </div>
        <!-- end catalog -->
    </div>
    <!-- end fixed filter wrap -->
</div>
