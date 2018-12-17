<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Sistema de información turística del Atlántico y de Barranquilla - SITUR Atlántico.">
        <meta name="keywords" content="SITUR Atlantico, visita al atlántico, visit to Atlantico, SITUR, Estadisticas Atlantico, Turismo Atlántico" />
        <meta name="author" content="Softsimulation S.A.S, Jorge Luis Pineda Montagut" />
        <meta name="copyright" content="Softsimulation S.A.S, SITUR Atlántico" />
        <meta property="og:title" content="SITUR Atlántico" />
        <meta property="og:type" content="website" />
        
        @yield('meta_og')
        <title>@yield('Title') SITUR Atlantico</title>
        <meta name='mobile-web-app-capable' content='yes'>
        <meta name='apple-mobile-web-app-capable' content='yes'>
        <meta name='application-name' content='SITUR Atlántico'>
        <meta name='apple-mobile-web-app-status-bar-style' content='black'>
        <meta name='apple-mobile-web-app-title' content='SITUR Atlántico'>
        <link rel='icon' sizes='192x192' href='res/logo/192.png'>
        <link rel='apple-touch-icon' href='res/logo/144.png'>
        <meta name='msapplication-TileImage' content='res/logo/144.png'>
        <meta name='msapplication-TileColor' content='#333'>
        <meta name="theme-color" content="#000000" />
        <!-- Bootstrap -->
        <!--<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Roboto|Pacifico|Fredoka+One" rel="stylesheet">-->
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" type="text/css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.css">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{asset('/css/public/style.css')}}" rel="stylesheet">
        <link href="{{asset('/css/public/main.css')}}" rel="stylesheet">
        <link href="{{asset('/css/public/style_768.css')}}" rel="stylesheet" media="(min-width: 768px)">
        <link href="{{asset('/css/public/style_992.css')}}" rel="stylesheet" media="(min-width: 992px)">
        <link href="{{asset('/css/public/style_1200.css')}}" rel="stylesheet" media="(min-width: 1200px)">
        <link rel="stylesheet" href="{{asset('/css/public/print.css')}}" media="print"/>
        @yield('estilos')
        <style>
            .bannerSitur img{
                height: 90px;
                margin: 0 5px;
            }
            .recomendaciones{
                padding: 1rem .5rem;
            }
            .row{
                margin-left: 0;
                margin-right: 0;
            }
            .title-section{
                font-weight: 700;
                text-transform: uppercase;
            }
            .btn.btn-xs{
                font-size: .85rem;
            }
            /*Google traductor*/
            .goog-te-gadget img {
                display: none!important;
            }
            .goog-te-gadget-simple {
                background: transparent!important;
                color: white!important;
                border: 0!important;
            }
            .goog-te-gadget-simple .goog-te-menu-value span {
                color: white!important;
                font-size: 1rem!important;
                padding-right: .5rem!important;
                font-family: Futura, sans-serif!important;
            }
            .goog-te-banner {
                background: black!important;
                color: white!important;
            }
            .goog-te-button div {
                background: transparent!important;
                border: 0!important;
            }
            .goog-te-button button {
                color: white!important;
                border: 0!important;
                background-color: transparent!important;
                font-family: Futura, sans-serif!important;
            }
            .goog-te-button {
                border: 0!important;
            }
            .goog-te-menu-value span {
                color: white!important;
                font-family: Futura, sans-serif!important;
            }
        </style>
    </head>
    <body>
        @include('layout.partial._headerPublicPartial')
        <main id="content-main">
            @yield('content')
        </main>
        
        @include('layout.partial._footerPublicPartial')
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
         <script>
         var slider = null;
            $(document).ready(function(){
                slider = $('#slider-logos').bxSlider({
                    auto: true,
                    autoControls: false,
                    maxSlides: 6,
                    //slideWidth: 250,
                    controls: false,
                    // autoHover: true,
                    pager: false,
                    responsive: true,
                    wrapperClass: 'bx-indicadores',
                    pause: 3000,
                    ariaLive: false
                });
            });
            $(window).resize(function(){
                slider.reloadSlider();
            });
        </script>
        <script src="{{asset('/js/public/main.js')}}" async></script>
        @yield("javascript")
        <script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function (event) {
                
                $('.loadingContent').delay(500).fadeOut("fast");
                $('.carousel').carousel({
                  pause: null
                });
            
            });
            
        </script>
       
    <!-- Global site tag (gtag.js) -Código de seguimiento Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-106392208-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-106392208-1');
</script>
 <!-- fin de código de seguimiento-->
    </body>
</html>