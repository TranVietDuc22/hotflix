<!DOCTYPE html>
<html lang="en">

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
    <link rel="stylesheet" href="{{ asset('webfont/tabler-icons.min.css')}}">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{asset('favicon.ico')}}" sizes="32x32">
    <link rel="apple-touch-icon" href="{{asset('favicon.ico')}}">

    <meta name="description"
          content="PhimHay là trang web xem phim trực tuyến miễn phí với chất lượng cao, cập nhật nhanh chóng các bộ phim mới nhất, đa dạng thể loại cho người xem thỏa sức lựa chọn.">
    <meta name="keywords" content="">
    <meta name="author" content="Dmitry Volkov">
    <title>{{ $title }}</title>
</head>

<body>
<div class="sign section--bg" data-bg="{{asset('img/bg/section__bg.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="sign__content">

                    {{$slot}}

                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS -->
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/splide.min.js')}}"></script>
<script src="{{asset('js/slimselect.min.js')}}"></script>
<script src="{{asset('js/smooth-scrollbar.js')}}"></script>
<script src="{{asset('js/plyr.min.js')}}"></script>
<script src="{{asset('js/photoswipe.min.js')}}"></script>
<script src="{{asset('js/photoswipe-ui-default.min.js')}}"></script>
<script src="{{asset('js/main.js')}}"></script>
</body>

</html>
