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
                    <input type="text" placeholder="{{trans('resources.listado.queDeseaBuscar')}}" name="searchBoxMain" id="searchBoxMain" required maxlength="255"/>
                    <button type="submit" class="btn btn-link" title="Buscar"><span class="ion-android-search" aria-hidden="true"></span><span class="sr-only">{{trans('resources.common.buscar')}}</span></button>
                </form>
                <label class="sr-only" for="selectLangGlobal">{{trans('resources.common.seleccionarIdioma')}}</label>
                <select aria-label="{{trans('resources.common.seleccionarIdioma')}}" id="selectLangGlobal" title="{{trans('resources.common.seleccionarIdioma')}}" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                    <option value="" selected>{{Session::get('lang')}}</option>
                    
                    <option value="/lang/es" @if(Config::get('app.locale') == 'es') selected @endif>ES</option>
                    <option value="/lang/en" @if(Config::get('app.locale') == 'en') selected @endif>EN</option>
                </select>
                <div id="google_translate_element"></div><script type="text/javascript">
                function googleTranslateElementInit() {
                  new google.translate.TranslateElement({pageLanguage: 'es', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                }
                </script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                        
                @if(Auth::check())
                <a href="/login/cerrarsesion" title="Cerrar sesión"><i class="ion-log-out"></i><span class="sr-only">Cerrar sesión</span></a>
                <a href="/visitante/misfavoritos" title="Mis favoritos"><span class="ion-heart" aria-hidden="true"></span><span class="sr-only">Mis favoritos</span></a>
                
                @else
                <a href="/login/login" title="{{trans('resources.common.iniciarSesion')}}"><span class="ion-person" aria-hidden="true"></span><span class="sr-only">{{trans('resources.common.iniciarSesion')}}</span></a>
                @endif
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
                        <!--<li role="none">-->
                        <!--    <a role="menuitem" href="#">{{trans('resources.entidad.guias')}}</a>-->
                        <!--</li>-->
                        <li role="none">
                            <a role="menuitem" href="/proveedor/index?tipo=1">{{trans('resources.entidad.alojamientos')}}</a>
                        </li>
                        <li role="none">
                            <a role="menuitem" href="/proveedor/index?tipo=2">{{trans('resources.entidad.restaurantes')}}</a>
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
                            <a role="menuitem" href="/indicadores/receptor">{{trans('resources.estadisticas.receptor')}}</a>
                        </li>
                        <li role="none">
                            <a role="menuitem" href="/indicadores/interno">{{trans('resources.estadisticas.interno')}}</a>
                        </li>
                        <li role="none">
                            <a role="menuitem" href="/indicadores/emisor">{{trans('resources.estadisticas.emisor')}}</a>
                        </li>
                        <li role="none">
                            <a role="menuitem" href="/indicadores/empleo">{{trans('resources.estadisticas.empleo')}}</a>
                        </li>
                        <li role="none">
                            <a role="menuitem" href="/indicadores/oferta">{{trans('resources.estadisticas.oferta')}}</a>
                        </li>
                        <li role="none">
                            <a role="menuitem" href="#">{{trans('resources.estadisticas.sostenibilidad')}}</a>
                        </li>
                        <li role="none">
                            <a role="menuitem" href="/indicadores/secundarios">{{trans('resources.estadisticas.secundarias')}}</a>
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
                <!--<li>-->
                <!--    <a role="menuitem" href="#">{{trans('resources.menu.contactanos')}}</a>-->
                <!--</li>-->
            </ul>
        </nav>    
    </div>
    
</header>