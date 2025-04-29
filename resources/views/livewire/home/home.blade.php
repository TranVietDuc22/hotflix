<div>
    <livewire:home.banner/>

    <!-- fixed filter wrap -->
    <div>
        <!-- catalog -->
        <div class="section section--catalog">
            <livewire:home.film-list/>
        </div>
        <!-- end catalog -->
    </div>
    <!-- end fixed filter wrap -->

    <!-- section -->
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

    <script>
        Livewire.on('favorite-updated', event => {
            document.querySelectorAll(`button[data-id="${event.id}"]`).forEach(button => {
                if (event.status) {
                    button.classList.add('item__favorite--active');
                    button.querySelector('i').classList.replace('ti-bookmark', 'ti-bookmark-filled');
                } else {
                    button.classList.remove('item__favorite--active');
                    button.querySelector('i').classList.replace('ti-bookmark-filled', 'ti-bookmark');
                }
            });
        });
    </script>

</div>
