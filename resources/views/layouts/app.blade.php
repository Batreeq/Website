<!DOCTYPE html>
<html lang="ar">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Jara</title>
        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('white') }}/img/apple-icon.png">
        <link rel="icon" type="image/png" href="{{ asset('white') }}/img/Jara_logo.png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('white') }}/css/nucleo-icons.css" rel="stylesheet" />
        <!-- CSS -->
        <link href="{{ asset('white') }}/css/white-dashboard.css?v=1.0.1" rel="stylesheet" />
        <link href="{{ asset('white') }}/css/resp-style.css" rel="stylesheet" />

        <!-- Standalone -->
        <link href="{{ asset('white') }}/css/datepicker/datepicker.min.css" rel="stylesheet" />
        <!-- For Bootstrap 4 -->
        <link href="{{ asset('white') }}/css/datepicker/datepicker-bs4.min.css" rel="stylesheet" />
        <!-- For Bulma -->
        <link href="{{ asset('white') }}/css/datepicker/datepicker-bulma.min.css" rel="stylesheet" />
        <!-- For Foundation -->
        <link href="{{ asset('white') }}/css/datepicker/datepicker-foundation.min.css" rel="stylesheet" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

         <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css" rel="stylesheet" />
        <link href="{{ asset('white') }}/css/theme.css" rel="stylesheet" />

        {{-- data table  --}}

        {{-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> --}}
        {{-- <script src="cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> --}}
        <script src="https://code.jquery.com/jquery-3.4.1.js" ></script>
        <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" defer></script>
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


    </head>
    <body class=" white-content {{ $class ?? 'home-page' }}">
        @auth()
            <div class="wrapper">
                    @if ($pageSlug != 'homepage')
                      @include('layouts.navbars.sidebar')
                    @endif
                <div @if ($pageSlug != 'homepage') class="main-panel" @else class="home-page-panel height-all-page" @endif>
                    @if ($pageSlug != 'homepage')
                      @include('layouts.navbars.navbar')
                    @endif

                    <div class="content height-all-page">
                        @yield('content')
                    </div>

                    <!-- @include('layouts.footer') -->
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            @include('layouts.navbars.navbar')
            <div class="wrapper wrapper-full-page">
                <div class="full-page {{ $contentClass ?? 'home-page' }}">
                    <div class="content">
                        <div class="container">
                            @yield('content')
                        </div>
                    </div>
                    <!-- @include('layouts.footer') -->
                </div>
            </div>
        @endauth

        <script src="{{ asset('white') }}/js/core/jquery.min.js"></script>
        <script src="{{ asset('white') }}/js/core/popper.min.js"></script>
        <script src="{{ asset('white') }}/js/core/bootstrap.min.js"></script>
        <script src="{{ asset('white') }}/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <!--  Google Maps Plugin    -->
        <!-- Place this tag in your head or just before your close body tag. -->
        {{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}
        <!-- Chart JS -->
        {{-- <script src="{{ asset('white') }}/js/plugins/chartjs.min.js"></script> --}}
        <!--  Notifications Plugin    -->
        <script src="{{ asset('white') }}/js/plugins/bootstrap-notify.js"></script>

        <script src="{{ asset('white') }}/js/white-dashboard.min.js?v=1.0.0"></script>
        <script src="{{ asset('white') }}/js/theme.js"></script>





        @stack('js')

        <script>
            $(document).ready(function() {
                function getVals(){
                    // Get slider values
                    var parent = this.parentNode;
                    var slides = parent.getElementsByTagName("input");
                    var slide1 = parseFloat( slides[0].value );
                    var slide2 = parseFloat( slides[1].value );
                    // Neither slider will clip the other, so make sure we determine which is larger
                    if( slide1 > slide2 ){ var tmp = slide2; slide2 = slide1; slide1 = tmp; }

                    var displayElement = parent.getElementsByClassName("rangeValues")[0];
                    displayElement.innerHTML = slide1 + " - " + slide2;
                }

                $(".list-lang").change(function(){
                   $('html')[0].lang=$(this).val()
                   $('form')[0].reset();
                   $(':input[type=search]').val('');
                   
                   var sliderSections = document.getElementsByClassName("range-slider");
                    for( var x = 0; x < sliderSections.length; x++ ){
                      var sliders = sliderSections[x].getElementsByTagName("input");
                      for( var y = 0; y < sliders.length; y++ ){
                        if( sliders[y].type ==="range" ){
                          sliders[y].oninput = getVals;
                          // Manually trigger event first time to display values
                          sliders[y].oninput();
                        }
                      }
                    }
                   // for reset all input until in edit on product 
                   // $(':input').val('');
                })

               //  $("input").keypress(function(event){
               //      var ew = event.which;
               //      if($('html')[0].lang=="en"){
                       
               //          if(ew == 32)
               //              return true;
               //          if(48 <= ew && ew <= 57)
               //              return true;
               //          if(65 <= ew && ew <= 90)
               //              return true;
               //          if(97 <= ew && ew <= 122)
               //              return true;
               //          alert("من فضلك ادخل باللغة الانكليزية")
               //          return false;
               //      }else{
               //          if(ew < 0x0600 || ew > 0x06FF){ //if not an arabic letter
               //              alert("من فضلك ادخل باللغة العربية")
               //              return false;
               //          } 
               //      }
               // })


                $().ready(function() {
                    $sidebar = $('.sidebar');
                    $navbar = $('.navbar');
                    $main_panel = $('.main-panel');
                    $full_page = $('.full-page');
                    $sidebar_responsive = $('body > .navbar-collapse');
                    sidebar_mini_active = true;
                    white_color = false;
                    window_width = $(window).width();
                    fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();
                    $('.fixed-plugin a').click(function(event) {
                        if ($(this).hasClass('switch-trigger')) {
                            if (event.stopPropagation) {
                                event.stopPropagation();
                            } else if (window.event) {
                                window.event.cancelBubble = true;
                            }
                        }
                    });
                    $(document).on('click', '.products-categories-container .btn-chat', function() {
                           $('.product-block').addClass('active');
                           $('.products-categories-container').removeClass('active')
                    })

                    $(".special-section input").change(function(){
                        if($(this).val().length >0){
                            $("select option[value=1]").attr('selected', 'selected');
                        }
                    });

                    $('.fixed-plugin .background-color span').click(function() {
                        $(this).siblings().removeClass('active');
                        $(this).addClass('active');
                        var new_color = $(this).data('color');
                        if ($sidebar.length != 0) {
                            $sidebar.attr('data', new_color);
                        }
                        if ($main_panel.length != 0) {
                            $main_panel.attr('data', new_color);
                        }
                        if ($full_page.length != 0) {
                            $full_page.attr('filter-color', new_color);
                        }
                        if ($sidebar_responsive.length != 0) {
                            $sidebar_responsive.attr('data', new_color);
                        }
                    });
                    $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
                        var $btn = $(this);
                        if (sidebar_mini_active == true) {
                            $('body').removeClass('sidebar-mini');
                            sidebar_mini_active = false;
                            whiteDashboard.showSidebarMessage('Sidebar mini deactivated...');
                        } else {
                            $('body').addClass('sidebar-mini');
                            sidebar_mini_active = true;
                            whiteDashboard.showSidebarMessage('Sidebar mini activated...');
                        }
                        // we simulate the window Resize so the charts will get updated in realtime.
                        var simulateWindowResize = setInterval(function() {
                            window.dispatchEvent(new Event('resize'));
                        }, 180);
                        // we stop the simulation of Window Resize after the animations are completed
                        setTimeout(function() {
                            clearInterval(simulateWindowResize);
                        }, 1000);
                    });
                    $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
                            var $btn = $(this);
                            if (white_color == true) {
                                $('body').addClass('change-background');
                                setTimeout(function() {
                                    $('body').removeClass('change-background');
                                    $('body').removeClass('white-content');
                                }, 900);
                                white_color = false;
                            } else {
                                $('body').addClass('change-background');
                                setTimeout(function() {
                                    $('body').removeClass('change-background');
                                    $('body').addClass('white-content');
                                }, 900);
                                white_color = true;
                            }
                    });
                    $('.light-badge').click(function() {
                        $('body').addClass('white-content');
                    });
                    $('.dark-badge').click(function() {
                        $('body').removeClass('white-content');
                    });
                });
            });
        </script>
        @stack('js')
    </body>
</html>
