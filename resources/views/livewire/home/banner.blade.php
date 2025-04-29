<!-- home -->
<section class="home home--hero">
    <div class="container">
        <div class="row">
            <!-- hero carousel -->
            <div class="col-12">
                <div class="hero splide splide--hero">
                    <div class="splide__arrows">
                        <button class="splide__arrow splide__arrow--prev" type="button">
                            <i class="ti ti-chevron-left"></i>
                        </button>
                        <button class="splide__arrow splide__arrow--next" type="button">
                            <i class="ti ti-chevron-right"></i>
                        </button>
                    </div>
                    <div class="splide__track">
                        <ul class="splide__list">
                        @foreach($films as $film)
                            <li class="splide__slide">
                                <div class="hero__slide" data-bg="{{$film['banner']}}">
                                    <div class="hero__content">
                                        <h2 class="hero__title">{{$film['title']}}</h2>
                                        <p class="hero__text">{{$film['description']}}</p>
                                        <p class="hero__category">
                                            <a href="#">{{$film['language']}}</a>
                                        </p>
                                        <div class="hero__actions">
                                            <a wire:click.prevent="detailFilm('{{$film['uuid']}}')" href="details.html" class="hero__btn">
                                                <span>Xem</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <!-- hero carousel -->
        </div>
    </div>
</section>
<!-- end home -->
