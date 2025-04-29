<div wire:ignore>
    <section class="section section--details">
        <!-- details content -->
        <div class="container">
            <div class="row">
                <!-- title -->
                <div class="col-12">
                    <h1 class="section__title section__title--head">{{$film['title']}}</h1>
                </div>
                <!-- end title -->
                @php
                    $isFavorite = in_array($film['id'], $favoriteFilms);
                @endphp
                <!-- content -->
                <div class="col-12 col-xl-6">
                    <div class="item item--details">
                        <div class="row">
                            <!-- card cover -->
                            <div class="col-12 col-sm-5 col-md-5 col-lg-4 col-xl-6 col-xxl-5">
                                <div class="item__cover">
                                    <img src="{{$film['poster']}}" alt="">
                                    <button class="item__favorite" type="button"
                                            wire:click="saveFavorite({{ $film['id'] }})"
                                            wire:loading.attr="disabled"
                                            :class="{'item__favorite--active': {{ $isFavorite ? 'true' : 'false' }} }">
                                        <i class="ti ti-bookmark"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- end card cover -->

                            <!-- card content -->
                            <div class="col-12 col-md-7 col-lg-8 col-xl-6 col-xxl-7">
                                <div class="item__content">
                                    <ul class="item__meta">
                                        @if($film['director'] === null)
                                        <li></li>
                                        @else
                                        <li class="text-warning"><span>Đạo diễn:</span>{{$film['director']}}</li>
                                        @endif
                                        <li class="text-warning"><span>Diễn viên:</span>{{$film['cast']}}</li>
                                        <li class="text-warning"><span>Thể loại:</span>
                                            {{$film['genre_title']}}
                                        </li>
                                        <li class="text-warning"><span>Số tập:</span>{{$film['total_episodes']}}</li>
                                        <li class="text-warning"><span>Năm:</span>{{$film['year']}}</li>
                                        <li class="text-warning">
                                             <span>Quốc gia:</span>{{$film['country']}}
                                        </li>
                                    </ul>

                                    <div class="item__description">
                                        <div class="overflow-auto custom-scroll" style="max-height: 150px;">
                                            <p>{{$film['description']}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end card content -->
                        </div>
                    </div>
                </div>
                <!-- end content -->

                <livewire:film.episodes :uuid='$film->uuid'/>
            </div>
        </div>
        <!-- end details content -->
    </section>
    <section class="section section--border">
        <div class="container">
            <div class="row">
                <div>
                    <div class="col-12">
                        <div class="section__title-wrap">
                            <h2 class="section__title">Có thể bạn sẽ thích</h2>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="section__carousel splide splide--content">
                            <div class="splide__arrows">
                                <button class="splide__arrow splide__arrow--prev" type="button">
                                    <i class="ti ti-chevron-left"></i>
                                </button>
                                <button class="splide__arrow splide__arrow--next" type="button">
                                    <i class="ti ti-chevron-right"></i>
                                </button>
                            </div>
                            <livewire:home.expect-premiere/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
