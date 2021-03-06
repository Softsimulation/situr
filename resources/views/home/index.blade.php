<?php 
function getItemType($type){
    $path = ""; $name = "";
    switch($type){
        case(1):
            $name = trans('resources.entidad.actividades');
            $path = "/actividades/ver/";
            break;
        case(2):
            $name = trans('resources.entidad.atracciones');
            $path = "/atracciones/ver/";
            break;
        case(3):
            $name = trans('resources.entidad.destinos');
            $path = "/destinos/ver/";
            break;
        case(4):
            $name = trans('resources.entidad.eventos');
            $path = "/eventos/ver/";
            break; 
        case(5):
            $name = trans('resources.entidad.rutasTuristicas');
            $path = "/rutas/ver/";
            break;
    }
    return (object)array('name'=>$name, 'path'=>$path);
}
$colorTipo = ['primary','success','danger', 'info', 'warning'];
?>
@extends('layout._publicLayout')

@section('Title','')
@section ('content')
@section('meta_og')
<meta property="og:url" content="https://situratlantico.com" />
<meta property="og:image" content="{{asset('/res/logo/black/192.png')}}" />
<meta property="og:description" content="Sistema de información turística del Atlántico y de Barranquilla - SITUR Atlántico."/>
@endsection

@section('estilos')
<style>
    .tile-date {
        font-style: italic;
        font-size: 0.875rem;
        color: grey;
    }
    .invert-img{
        -moz-transform: scaleX(-1);
        -o-transform: scaleX(-1);
        -webkit-transform: scaleX(-1);
        transform: scaleX(-1);
        filter: FlipH;
        -ms-filter: "FlipH";
    }
    .tile .tile-img .text-overlap h3 small {
        font-size: 0.875rem;
        color: white;
    }
    
    .tile .tile-img .text-overlap h3 {
        line-height: 2;
        font-size: 1rem;
    }
    .tiles .tile .tile-img {
        height: 220px;
    }
    .carousel-inner > .item > video{
        position: absolute;
        left: 50%;
        top: 50%;
        -webkit-transform: translateY(-50%) translateX(-50%);
        transform: translateY(-50%) translateX(-50%);
        width: 100%;
    }
    
</style>
@endsection

<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
(function(){ var widget_id = '3HNHEawOTn';var d=document;var w=window;function l(){var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
</script>
<!-- {/literal} END JIVOSITE CODE -->
<!--<div id="bg-video">-->
            <!--    <video autoplay muted loop aria-hidden="true">-->
            <!--      <source src="res/juegos_centroamericanos_2018_web.mp4" type="video/mp4">-->
            <!--      <source src="res/juegos_centroamericanos_2018_web.webm" type="video/webm">-->
            <!--      Your browser does not support HTML5 video.-->
            <!--    </video>    -->
            <!--</div>-->
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
              
            
              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                 <div class="item active">
                     <video loop autoplay muted id="video">
                      <source src="/res/Conoce y Disfruta de Barranquilla.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                    </video>
                     <!--<iframe style="position:absolute;top:0;left:0;width:100%;height:100%;" src="https://www.youtube.com/embed/-a9zXm9prmI?autoplay=1&loop=1&controls=0&mute=1&showinfo=0" frameborder="0"></iframe>-->
                  <!--<img src="res/slider/slide1.jpeg" alt="" role="presentation">-->
                </div>
                <!--<div class="item active">-->
                <!--  <img src="res/slider/slide1.jpeg" alt="" role="presentation">-->
                <!--  <div class="carousel-caption">-->
                <!--    ...-->
                <!--  </div>-->
                <!--</div>-->
                <!--<div class="item">-->
                <!--  <img src="res/slider/slide2.jpeg" alt="" role="presentation">-->
                <!--  <div class="carousel-caption">-->
                <!--    ...-->
                <!--  </div>-->
                <!--</div>-->
                <!--<div class="item">-->
                <!--  <img src="res/slider/slide3.jpeg" alt="" role="presentation">-->
                <!--  <div class="carousel-caption">-->
                <!--    ...-->
                <!--  </div>-->
                <!--</div>-->
              </div>
              <section id="indicadores">
                <div class="indicador">
                    <h2>Visitar familiaes y/o amigos</h2>
                    <p>fue el Motivo principal de viaje para visitar el Atlántico en septiembre de 2018</p>
                </div>
                <div class="indicador">
                    <h2>Transporte terrestre de pasajeros</h2>
                    <p>Fue el medio de transporte más utilizado por los visitantes en el Atlántico en septiembre de 2018</p>
                </div>
                <div class="indicador">
                    <h2>Casa de familiares o amigos</h2>
                    <p>fue el tipo de alojamiento más utilizado por los visitantes en el Atlántico en septiembre de 2018</p>
                </div>
            </section>
            </div>
            
            <div id="estadisticas" class="estadisticas">
                <ul>
                    <li id="turismoReceptor">
                        <a role="button" href="/indicadores/receptor"><span class="sprite estadisticas-receptor invert" aria-hidden="true"></span> {{trans('resources.estadisticas.receptor')}}</a>
                    </li>
                    <li id="turismoInternoInterno">
                        <a role="button" href="/indicadores/interno"><span class="sprite estadisticas-emisor invert invert-img" aria-hidden="true"></span> {{trans('resources.estadisticas.interno')}}</a>
                    </li>
                    <li id="turismoInternoEmisor">
                        <a role="button" href="/indicadores/emisor"><span class="sprite estadisticas-emisor invert" aria-hidden="true"></span> {{trans('resources.estadisticas.emisor')}}</a>
                    </li>
                    <li id="turismoEmpleo">
                        <a role="button" href="/indicadores/empleo"><span class="sprite estadisticas-empleo invert" aria-hidden="true"></span> {{trans('resources.estadisticas.empleo')}}</a>
                    </li>
                    <li id="turismoOferta">
                        <a role="button" href="/indicadores/oferta"> <span class="sprite estadisticas-oferta invert" aria-hidden="true"></span> {{trans('resources.estadisticas.oferta')}}</a>
                    </li>
                    <li id="turismoSostenibilidad">
                        <a role="button" href="#"> <span class="sprite estadisticas-sostenibilidad invert" aria-hidden="true"></span>{{trans('resources.estadisticas.sostenible')}}</a>
                    </li>
                </ul>
            </div>
            
            <section id="widgets">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            
                            <a class="weatherwidget-io" href="https://forecast7.com/{{Config::get('app.locale')}}/11d00n74d81/barranquilla/" data-label_1="BARRANQUILLA" data-label_2="{{trans('resources.home.clima')}}" data-theme="original" >BARRANQUILLA {{trans('resources.home.clima')}}</a>
<script>
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
</script>
                        </div>
                    </div>
                </div>
                
            </section>
            <section id="descripcion">
                <div class="container text-center">
                    <h2>SITUR ATLÁNTICO</h2>

                    <p>
                {{trans('resources.home.descripcion')}}

                        
                        </p>

                </div>
                
            </section>
            @if(count($sugeridos))
            
            <div class="container">
                <h2 class="text-uppercase text-center">Sugerencias</h2>
                <div class="tiles">
                    @foreach($sugeridos as $sugerido)
                    <div class="tile">
                        <div class="tile-img">
                            <img src="{{$sugerido->portada}}" alt="" role="presentation">
                            <div class="text-overlap">
                                <span class="label label-{{$colorTipo[$sugerido->tipo - 1]}}">{{getItemType($sugerido->tipo)->name}}</span>
                                <h3>
                                    <a href="{{getItemType($sugerido->tipo)->path}}{{$sugerido->id}}">{{$sugerido->nombre}}</a>
                                    @if($sugerido->tipo == 4)
                                    <small>{{trans('resources.listado.fechaEvento', ['fechaInicio' => date('d/m/Y', strtotime($sugerido->fecha_inicio)), 'fechaFin' => date('d/m/Y', strtotime($sugerido->fecha_fin))])}}</small>
                                    @endif
                                </h3>
                                
                            </div>
                            
                        </div>
                        <!--<div class="tile-body">-->
                        <!--    <div class="tile-caption">-->
                        <!--        <h3><a href="#">{{$sugerido->nombre}}</a></h3>-->
                                
                        <!--    </div>-->
                        <!--</div>-->
                    </div>
                    @endforeach
                </div>
            </div>
            
            @endif
            
            @if(count($noticias) > 0)
            <section id="noticias">
                <div class="container">
                    <h2 class="text-uppercase text-center">{{trans('resources.publicaciones.noticias')}}</h2>
                    <hr>
                    <div class="tiles">
                        @foreach($noticias as $noticia)
                        <div class="tile inline-tile">
                            <div class="tile-body">
                                <div class="tile-caption">
                                    <h3><a href="/promocionNoticia/ver/{{$noticia->idNoticia}}">{{$noticia->tituloNoticia}}</a></h3>
                                </div>
                                <p class="tile-date"><span class="ion-calendar" aria-hidden="true"></span> {{date("d/m/Y h:i A", strtotime($noticia->fecha))}}</p>
                                <p class="text-muted">{{$noticia->resumen}}</p>
                                <div class="text-right">
                                    <a href="/promocionNoticia/ver/{{$noticia->idNoticia}}" class="btn btn-xs btn-success">{{trans('resources.common.verMas')}}</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        <a href="/promocionNoticia/listado" class="btn btn-success">{{trans('resources.common.verTodo')}}</a>
                    </div>
                </div>
                
            </section>
            @endif
@endsection
@section('javascript')
<script>
$(document).ready(function(){
    document.getElementById('video').play();
})
    
</script>
@endsection
