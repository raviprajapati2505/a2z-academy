<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <title>GORD ACADEMY</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="" />

    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="{{ asset('public/frontend/favicon/apple-touch-icon-57x57.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('public/frontend/favicon/apple-touch-icon-114x114.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('public/frontend/favicon/apple-touch-icon-72x72.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('public/frontend/favicon/apple-touch-icon-144x144.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="60x60" href="{{ asset('public/frontend/favicon/apple-touch-icon-60x60.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="{{ asset('public/frontend/favicon/apple-touch-icon-120x120.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="76x76" href="{{ asset('public/frontend/favicon/apple-touch-icon-76x76.png') }}" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="{{ asset('public/frontend/favicon/apple-touch-icon-152x152.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('public/frontend/favicon/favicon-196x196.png') }}" sizes="196x196" />
    <link rel="icon" type="image/png" href="{{ asset('public/frontend/favicon/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/png" href="{{ asset('public/frontend/favicon/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ asset('public/frontend/favicon/favicon-16x16.png') }}" sizes="16x16" />
    <link rel="icon" type="image/png" href="{{ asset('public/frontend/favicon/favicon-128.png') }}" sizes="128x128" />
    <meta name="application-name" content="&nbsp;" />
    <meta name="msapplication-TileColor" content="#FFFFFF" />
    <meta name="msapplication-TileImage" content="mstile-144x144.png" />
    <meta name="msapplication-square70x70logo" content="mstile-70x70.png" />
    <meta name="msapplication-square150x150logo" content="mstile-150x150.png" />
    <meta name="msapplication-wide310x150logo" content="mstile-310x150.png" />
    <meta name="msapplication-square310x310logo" content="mstile-310x310.png" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="{{ asset('public/frontend/css/bootstrap.min.css') }}">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('public/frontend/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/progress-bar.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('public/frontend/css/custom.css') }}" />


    <script src="{{ asset('public/frontend/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/popper.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/owl.carousel.min.js') }}"></script>
    <script src="https://huynhhuynh.github.io/owlcarousel2-filter/dist/owlcarousel2-filter.min.js"></script>
    <script src="{{ asset('public/frontend/js/select2.min.js') }}"></script>



    <!-- common in both front and back -->
    <link rel="stylesheet" href="{{ asset('public/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/additional/intlTelInput.css') }}" />
    <script src="{{ asset('public/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('public/js/additional/jquery.validate.js') }}"></script>
    <script src="{{ asset('public/js/additional/additional-methods.js') }}"></script>
    <script src="{{ asset('public/js/additional/intlTelInput.js') }}"></script>
    <script src="{{ asset('public/js/additional/utils.js') }}"></script>
    <script src="{{ asset('public/js/additional/moment.min.js') }}"></script>
    <script src="{{ asset('public/js/additional/fullcalendar.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('public/css/additional/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/additional/fullcalendar.print.css') }}" media='print' />

</head>

<body>

    @include('common.frontend.header')
    @yield('content')

    @include('common.frontend.email_subscribe')
    @include('common.frontend.footer')

    <script>
        $(document).ready(function() {
            if ($(window).width() > 320) {
                $('.navbar-light .d-menu').hover(function() {
                    $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
                }, function() {
                    $(this).find('.sm-menu').first().stop(true, true).delay(120).slideUp(100);
                });
            }
        });

        /* Jquery */
        var iSelectDropDown = (function() {
            var $el = $(".iSelect");
            var $elListItem = $(".iSelect").find("ul li");
            var $selectedText = $(".iSelect").find(".select-label");

            function iSelect() {
                $elListItem.on("click", function() {
                    $selectedText.text($(this).text()).attr('title', $(this).text());
                });
            }
            return iSelect;
        })();

        $('.js-example-basic-single').select2({
            minimumResultsForSearch: -1
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });

        var iselect = new iSelectDropDown();

        $(function() {
            var owl = $("#ourmostslider");
            owl.owlCarousel({
                margin: 10,
                loop: true,
                nav: true,
                items: 3,
                responsive: {
                    0: {
                        items: 1,
                    },
                    390: {
                        items: 1,
                    },
                    420: {
                        items: 1,
                    },
                    550: {
                        items: 2
                    },
                    768: {
                        items: 3
                    }
                }
            });
        });
        $(function() {
            var owl = $("#myclassslider");
            owl.owlCarousel({
                margin: 10,
                loop: true,
                nav: true,
                items: 3,
                responsive: {
                    0: {
                        items: 1,
                    },
                    390: {
                        items: 1,
                    },
                    420: {
                        items: 1,
                    },
                    550: {
                        items: 2
                    },
                    768: {
                        items: 3
                    }
                }
            });
        });
        $(function() {
            var owl = $("#stackholderslider");
            owl.owlCarousel({
                margin: 0,
                loop: true,
                nav: true,
                items: 3, // Default number of items to show
                autoplay: true,
                autoplayTimeout: 2000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 1, // 1 item for small screens
                    },
                    390: {
                        items: 1, // 1 item for slightly larger screens
                    },
                    420: {
                        items: 1, // 1 item
                    },
                    550: {
                        items: 2 // 2 items for medium-small screens
                    },
                    768: {
                        items: 3 // Show 5 items for larger screens
                    }
                }
            });
        });
        $(function() {
            var owl = $("#feedbackslider");
            owl.owlCarousel({
                margin: 10,
                loop: true,
                nav: true,
                items: 3,
                responsive: {
                    0: {
                        items: 1,
                    },
                    390: {
                        items: 1,
                    },
                    420: {
                        items: 1,
                    },
                    520: {
                        items: 1
                    },
                    768: {
                        items: 2
                    }
                }
            });
        });
        (function($) {
            $('.selector').click(function() {
                $(this).toggleClass('active');
                $('.menu-items').toggleClass('show');
            });
        })(jQuery);
    </script>
</body>

</html>