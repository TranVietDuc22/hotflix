<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/splide.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/slimselect.css')}}">
    <link rel="stylesheet" href="{{asset('css/plyr.css')}}">
    <link rel="stylesheet" href="{{asset('css/photoswipe.css')}}">
    <link rel="stylesheet" href="{{asset('css/default-skin.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Icon font -->
    <link rel="stylesheet" href="{{asset('webfont/tabler-icons.min.css')}}">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{asset('favicon.ico')}}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{asset('favicon.ico')}}">

    <meta name="description" content="PhimHay là trang web xem phim trực tuyến miễn phí với chất lượng cao, cập nhật nhanh chóng các bộ phim mới nhất, đa dạng thể loại cho người xem lựa chọn.">
    <meta name="keywords" content="">
    <meta name="author" content="Dmitry Volkov">
    <title>{{ $title }}</title>
</head>

<body>
<!-- header -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="header__content">
                    <!-- header logo -->
                    <a href="/" class="header__logo" >
                        <img src="{{asset('img/logo_2.png')}}" style="width: 170px; height: auto; margin-right: 35px;" alt="">
                    </a>
                    <!-- end header logo -->

                    <!-- header nav -->
                    <livewire:home.catalog />
                    <!-- end header nav -->

                    <!-- header auth -->
                    <div class="header__auth" style="margin-left: 30px">
                        <livewire:home.search />
                        <div x-data="{ open: false, message: '' }"
                             x-on:notify.window="open = true; message = $event.detail; setTimeout(() => open = false, 5000)"
                             x-show="open"
                             x-transition
                             class="notification">
                            <span x-text="message"></span>
                        </div>
                        @auth
                            <livewire:user.dropdown />
                        @else
                            <button class="filter__btn" type="button"><a class="text-warning" href="/login">Đăng nhập</a></button>
                        @endauth
                    </div>

                    <!-- end header auth -->

                    <!-- header menu btn -->
                    <button class="header__btn" type="button">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <!-- end header menu btn -->
                </div>
            </div>
        </div>
    </div>
</header>
<!-- end header -->
    {{ $slot }}
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer__content">
                    <a href="index.html" class="footer__logo">
                        <img src="{{asset('img/logo_2.png')}}" style="width: 170px; height: auto;" alt="">
                    </a>

                    <span style="margin: 0" class="footer__copyright">© PHIMHAY, 2019—2024 <br> Create by <a href="#" target="_blank">Dmitry Volkov</a></span>

                    <button class="footer__back" type="button">
                        <i class="ti ti-arrow-narrow-up"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end footer -->
<!-- JS -->
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/splide.min.js') }}"></script>
<script src="{{ asset('js/slimselect.min.js') }}"></script>
<script src="{{ asset('js/smooth-scrollbar.js') }}"></script>
<script src="{{ asset('js/plyr.min.js') }}"></script>
<script src="{{ asset('js/photoswipe.min.js') }}"></script>
<script src="{{ asset('js/photoswipe-ui-default.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('show-alert', event => {
            Swal.fire({
                icon: event.type,
                title: event.message,
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000
            });
        });
    });
</script>
</body>
</html>
