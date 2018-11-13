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
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{asset('/css/public/style.css')}}" rel="stylesheet">
        <link href="{{asset('/css/public/main.css')}}" rel="stylesheet">
        <link href="{{asset('/css/public/style_768.css')}}" rel="stylesheet" media="(min-width: 768px)">
        <link href="{{asset('/css/public/style_992.css')}}" rel="stylesheet" media="(min-width: 992px)">
        <link href="{{asset('/css/public/style_1200.css')}}" rel="stylesheet" media="(min-width: 1200px)">
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
        </style>
    </head>
    <body>
        <div class="loadingContent" aria-hidden="true">
            <div class="loader">
                <img src="/res/loading.gif" alt="" role="presentation">
            </div>
            
            <span>{{trans('resources.common.cargando')}}</span>
        </div>
        <header>
            
            <div class="nav-bar">
                <div class="brand">
                    <a href="/">
                        <img src="/res/logo/white/96.png" alt="Logo SITUR">
                        <h1 class="sr-only">Sistema de información turística del Atlántico y Barranquilla.</h1>
                    </a>
                    
                </div>
                <div id="navbar-mobile" class="text-center">
                    <button type="button" class="btn btn-block btn-primary" title="{{trans('resources.common.menuDeNavegacion')}}"><span aria-hidden="true" class="ion-navicon-round"></span><span class="sr-only">{{trans('resources.common.menuDeNavegacion')}}</span></button>
                </div>
                <nav id="nav-main" role="navigation">
                    <div class="toolbar">
                        <a href="#content-main" class="sr-only">{{trans('resources.common.irAlContenido')}}</a>
                        <div id="socialNetworks" class="fix-right">
                            <a href="https://www.facebook.com/CotelcoAtlantico/" target="_blank" rel="noopener noreferrer" title="Facebook"><span class="ion-social-facebook" aria-hidden="true"></span><span class="sr-only">Facebook</span></a>
                            <a href="https://twitter.com/Situratlantico?lang=es" target="_blank" rel="noopener noreferrer" title="Twitter"><span class="ion-social-twitter" aria-hidden="true"></span><span class="sr-only">Twitter</span></a>
                            <a href="https://www.instagram.com/situratlantico/" target="_blank" rel="noopener noreferrer" title="Instagram"><span class="ion-social-instagram" aria-hidden="true"></span><span class="sr-only">Instagram</span></a>    
                        </div>
                        
                        <form>
                            <label class="sr-only" for="searchBoxMain">{{trans('resources.common.busqueda')}}</label>
                            <input type="text" placeholder="Buscar..." name="searchBoxMain" id="searchBoxMain" required maxlength="255"/>
                            <button type="submit" class="btn btn-link" title="Buscar"><span class="ion-android-search" aria-hidden="true"></span><span class="sr-only">{{trans('resources.common.buscar')}}</span></button>
                        </form>
                        <select aria-label="{{trans('resources.common.seleccionarIdioma')}}" title="{{trans('resources.common.seleccionarIdioma')}}">
                            <option value="es" selected>ES</option>
                            <option value="en">EN</option>
                        </select>
                        <a href="/login/login" title="{{trans('resources.common.iniciarSesion')}}"><span class="ion-person" aria-hidden="true"></span><span class="sr-only">{{trans('resources.common.iniciarSesion')}}</span></a>
                        
                    </div>
                    <ul role="menubar">
                        <li>
                            <a role="menuitem" href="/">{{trans('resources.menu.inicio')}}</a>
                            
                        </li>
                        <li>
                            <a role="menuitem" aria-haspopup="true" aria-expanded="false" href="#menuSitur">SITUR</a>
                            <ul role="menu" id="menuSitur">
                                 <li role="none">
                                    <a role="menuitem" href="/Departamento/AcercaDe">{{trans('resources.menu.acercaDe')}}</a>
                                </li>  
                                 <li role="none">
                                    <a role="menuitem" href="/Departamento/Requisitos">{{trans('resources.menu.requisitos')}}</a>
                                </li>  
                                <li role="none">
                                    <a role="menuitem" href="/quienesSomos">{{trans('resources.menu.quienesSomos')}}</a>
                                </li>
                                <!--<li role="none">-->
                                <!--    <a role="menuitem" href="/historia">Historia</a>-->
                                <!--</li>-->
                                <!--<li role="none">-->
                                <!--    <a role="menuitem" href="/vision">Visión</a>-->
                                <!--</li>-->
                                <li role="none">
                                    <a role="menuitem" href="/equipo">{{trans('resources.menu.equipoSITUR')}}</a>
                                </li>
                                <!--<li role="none">-->
                                <!--    <a role="menuitem" href="/queHacemos">¿Qué hacemos?</a>-->
                                <!--</li>-->
                                <!--<li role="none">-->
                                <!--    <a role="menuitem" href="/entidadesAsociadas">Entidades asociadas</a>-->
                                <!--</li>-->
                            </ul>  
                            
                            
                        </li>
                        <li>
                            <a role="menuitem" aria-haspopup="true" aria-expanded="false" href="#menuViveAtlantico">{{trans('resources.menu.viveElAtlantico')}}</a>
                            <ul role="menu" id="menuViveAtlantico">
                                <li role="none">
                                    <a role="menuitem" href="/quehacer/?tipo=3">{{trans('resources.entidad.destinos')}}</a>
                                </li>
                                <li role="none">
                                    <a role="menuitem" href="/quehacer/?tipo=4">{{trans('resources.entidad.eventos')}}</a>
                                </li>
                                <li role="none">
                                    <a role="menuitem" href="/quehacer/?tipo=1">{{trans('resources.entidad.actividades')}}</a>
                                </li>
                                <li role="none">
                                    <a role="menuitem" href="/quehacer/?tipo=2">{{trans('resources.entidad.atracciones')}}</a>
                                </li>
                                <li role="none">
                                    <a role="menuitem" href="/quehacer/?tipo=5">{{trans('resources.entidad.rutasTuristicas')}}</a>
                                </li>
                                <li role="none">
                                    <a role="menuitem" href="#">{{trans('resources.entidad.guias')}}</a>
                                </li>
                                <li role="none">
                                    <a role="menuitem" href="#">{{trans('resources.entidad.alojamientos')}}</a>
                                </li>
                                <li role="none">
                                    <a role="menuitem" href="#">{{trans('resources.entidad.restaurantes')}}</a>
                                </li>
                                <li role="none">
                                    <a role="menuitem" href="/Mapa">{{trans('resources.menu.mapa')}}</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a role="menuitem" aria-haspopup="true" aria-expanded="false" href="#menuEstadisticas">{{trans('resources.menu.estadisticas')}}</a>
                            <ul role="menu" id="menuEstadisticas">
                                        
                                <li role="none">
                                    <a role="menuitem" href="#">{{trans('resources.estadisticas.receptor')}}</a>
                                </li>
                                <li role="none">
                                    <a role="menuitem" href="#">{{trans('resources.estadisticas.interno')}}</a>
                                </li>
                                <li role="none">
                                    <a role="menuitem" href="#">{{trans('resources.estadisticas.empleo')}}</a>
                                </li>
                                <li role="none">
                                    <a role="menuitem" href="#">{{trans('resources.estadisticas.oferta')}}</a>
                                </li>
                                <li role="none">
                                    <a role="menuitem" href="#">{{trans('resources.estadisticas.sostenibilidad')}}</a>
                                </li>
                                <li role="none">
                                    <a role="menuitem" href="/indicadores/secundarios">{{trans('resources.estadisticas.secundarios')}}</a>
                                </li>
                            </ul> 
                            
                        </li>
                        <li>
                            <a role="menuitem" aria-haspopup="true" aria-expanded="false" href="#menuPublicaciones">{{trans('resources.menu.publicaciones')}}</a>
                            <ul role="menu" id="menuPublicaciones">
                                        
                                <li role="none">
                                    <a role="menuitem" href="/promocionInforme/listado">{{trans('resources.publicaciones.informes')}}</a>
                                </li>
                                <li role="none">
                                    <a role="menuitem" href="/promocionNoticia/listado">{{trans('resources.publicaciones.noticias')}}</a>
                                </li>
                                 <li role="none">
                                    <a role="menuitem" href="/promocionPublicacion/listado">{{trans('resources.publicaciones.bibliotecaDigital')}}</a>
                                </li>
                                  <li role="none">
                                    <a role="menuitem" href="/promocionBolsaEmpleo/vacantes">{{trans('resources.publicaciones.bolsaDeEmpleo')}}</a>
                                </li>
                            </ul>    
                            
                        </li>
                        <li>
                            <a role="menuitem" href="#">{{trans('resources.menu.contactanos')}}</a>
                        </li>
                    </ul>
                </nav>    
            </div>
            
        </header>
        <main id="content-main">
            @yield('content')
        </main>
        
        <footer>
            <div id="logos">
                <div id="slider-logos" class="container">
                    <img src="/res/logo_mincit.png" alt="{{trans('resources.common.logoDe', ['logo' => 'Ministerio de Industria, Comercio y Turísmo'])}}" class="img-responsive">
                    <img src="/res/logo_fontur.png" alt="{{trans('resources.common.logoDe', ['logo' => 'Fontur'])}}" class="img-responsive">
                    <img src="/res/logo_gobierno.png" alt="{{trans('resources.common.logoDe', ['logo' => 'Gobierno de Colombia'])}}" class="img-responsive">
                    <img src="/res/gobernacion.png" alt="{{trans('resources.common.logoDe', ['logo' => 'Gobernación del Atlántico'])}}" class="img-responsive">
                    <img src="/res/alcaldia.png" alt="{{trans('resources.common.logoDe', ['logo' => 'alcaldía de Barranquilla'])}}" class="img-responsive">
                    <img src="/res/logo_cotelco.png" alt="{{trans('resources.common.logoDe', ['logo' => 'Cotelco Atlántico'])}}" class="img-responsive">    
                </div>
                
            </div>
            <div id="informacionFooter" class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-4 text-center" style="align-self:center;">
                        <img src="/res/logoCircularSiturAtlantico.jpg" alt="" class="img-circle" role="presentation">
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <h3>{{trans('resources.common.contacto')}}</h3>
                        <ul>
                            <li><span class="ion-map" aria-hidden="true"></span> Cra 49·72-19</li>
                            <li><span class="ion-android-call" aria-hidden="true"></span> {{trans('resources.common.telefono')}}: (57-7) 3059130</li>
                            <li><span class="ion-at" aria-hidden="true"></span> Email: info@situratlantico.com</li>
                            <li><span class="ion-android-pin" aria-hidden="true"></span> Barranquilla, Atlántico</li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <h3>{{trans('resources.common.enlacesDeInteres')}}</h3>
                        <ul>
                            <li>
                                <a href="http://www.citur.gov.co/" target="_blank">Centro de Información Turística CITUR</a>
                            </li>
                            <li>
                                <a href="http://www.cotelcoatlantico.org/" target="_blank">Cotelco Capítulo Atlántico</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="sign">
                <div class="container text-center">
                    <p>SITUR Atlántico &copy; 2018. Desarrollado por <a href="http://www.softsimulation.com">Softsimulation S.A.S</a></p>
                </div>
            </div>
        </footer>
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js"></script>
        <script src="{{asset('/js/public/main.js')}}" async></script>
        @yield("javascript")
        <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function (event) {
            
            $('.loadingContent').delay(500).fadeOut("fast");
            $('.carousel').carousel({
              pause: null
            });
            
            $('#slider-logos').bxSlider({
                auto: true,
                autoControls: false,
                maxSlides: 4,
                slideWidth: 250,
                controls: false,
                autoHover: true,
                pager: false,
                responsive: false,
                wrapperClass: 'bx-indicadores',
                pause: 5000,
                ariaLive: false
            });
        
        });
        
    </script>
    </body>
</html>