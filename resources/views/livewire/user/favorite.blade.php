<div>
    <!-- page title -->
    <section class="section section--first">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section__wrap">
                        <!-- section title -->
                        <h1 class="section__title section__title--head">Tài khoản</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end page title -->

    <!-- content -->
    <div class="content">
        <!-- profile -->
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="profile__content">
                            <div class="profile__user">
                                <div class="profile__avatar">
                                    <img src="img/user.svg" alt="">
                                </div>
                                <div class="profile__meta">
                                    <h3>{{ Auth::user()->name }}</h3>
                                    <span>PHIMHAY ID: 78123</span>
                                </div>
                            </div>

                            <!-- content tabs nav -->
                            <ul class="nav nav-tabs content__tabs content__tabs--profile" id="content__tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button id="4-tab" wire:click.prevent="profile" data-bs-toggle="tab" data-bs-target="#tab-4" type="button" role="tab" aria-controls="tab-4" aria-selected="false">Tài khoản</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button id="3-tab"  class="active" data-bs-toggle="tab" data-bs-target="#tab-3" type="button" role="tab" aria-controls="tab-3" aria-selected="true">Yêu thích</button>
                                </li>

                            </ul>
                            <!-- end content tabs nav -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end profile -->

        <div class="container">
            <!-- Content Tabs -->
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-3" role="tabpanel" aria-labelledby="3-tab" tabindex="0">
                    <div class="row">
                        @foreach($data as $film)
                            @php
                                $isFavorite = in_array($film->id, $favoriteFilms);
                            @endphp
                                <!-- Item -->
                            <div class="col-6 col-sm-4 col-lg-3 col-xl-2">
                                <div class="item">
                                    <div class="item__cover">
                                        <img src="{{ $film->poster }}" class="custom-img" alt="">
                                        <a   wire:click.prevent="detailFilm('{{ $film->uuid }}')" href="details.html" class="item__play">
                                            <i class="ti ti-player-play-filled"></i>
                                        </a>
                                        <button
                                            wire:click="saveFavorite({{ $film->id }})"
                                            class="item__favorite {{ $isFavorite ? 'item__favorite--active' : '' }}"
                                            type="button">
                                            <i class="ti ti-bookmark"></i>
                                        </button>
                                    </div>
                                    <div class="item__content">
                                        <h3 class="item__title">
                                            <a wire:click.prevent="detailFilm('{{ $film->uuid }}')" href="">{{ $film->title }}</a>
                                        </h3>
                                        <span class="item__category text-warning">{{ $film->genre_title }}</span>
                                    </div>
                                </div>
                            </div>
                            <!-- End Item -->
                        @endforeach
                    </div>

                    <div class="row">
                        <div class="col-12">
                            {{ $data->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end content -->

</div>
