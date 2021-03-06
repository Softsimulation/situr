<?php
header("Access-Control-Allow-Origin: *");
$paraTenerEnCuentaContieneAlgo = count($proveedor->actividadesProveedores) > 0;
function parse_yturl($url) 
{
    $pattern = '#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x';
    preg_match($pattern, $url, $matches);
    return (isset($matches[1])) ? $matches[1] : false;
}
?>
@extends('layout._publicLayout')

@section ('estilos')
    <link href="{{asset('/css/public/pages.css')}}" rel="stylesheet">
    @if(count($proveedor->multimediaProveedores) == 0)
        <style>
            header {
                position: relative;
                background: black;
                margin-bottom: 1rem;
            }
            .carousel-caption{
                position: static;
                padding: 0;
                color: #333;
            }
            .carousel-caption h2 {
                text-shadow: none;
                font-size: 2.325rem;
                color: #185a1e;
            }
            .carousel-caption h2 small, .carousel-caption .ion-android-star, .carousel-caption .ion-android-star-outline{
                color:darkorange;
            }
            .btn.btn-lg.btn-circled{
                font-size: 1.825rem;
                color: red;
                background: whitesmoke;
            }
            .nav-bar nav>ul li ul a, .submenu{
                background-color:white;
            }
        </style>
    @endif
@endsection

@section('Title',$proveedor->proveedorRnt->razon_social)

@section('TitleSection','Proveedores')

@section('meta_og')
<meta property="og:title" content="Conoce a {{$proveedor->proveedorRnt->razon_social}} en el departamento del Cesar" />
<meta property="og:image" content="{{asset('/res/img/brand/128.png')}}" />
<meta property="og:description" content="{{$proveedor->proveedorRnt->idiomas[0]->descripcion}}"/>
@endsection


@section('content')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    @if(isset($proveedor->multimediaProveedores) && count($proveedor->multimediaProveedores) > 0)
    <div id="carousel-main-page" class="carousel slide carousel-fade" data-ride="carousel">
      <ol class="carousel-indicators">
        @for($i = 0; $i < count($proveedor->multimediaProveedores); $i++)
            <li data-target="#carousel-main-page" data-slide-to="{{$i}}" {{  $i === 0 ? 'class=active' : '' }}></li>
        @endfor
      </ol>
      <div class="carousel-inner">
      
        @for($i = 0; $i < count($proveedor->multimediaProveedores); $i++)
        <div class="item {{  $i === 0 ? 'active' : '' }}">
          <img src="{{$proveedor->multimediaProveedores[$i]->ruta}}" alt="Imagen de presentación de">
          
        </div>
        @endfor
        
        <div class="carousel-caption">
		    <h2>{{$proveedor->proveedorRnt->razon_social}}
		        <small class="btn-block">
		            <span class="{{ ($proveedor->calificacion_legusto > 0.0) ? (($proveedor->calificacion_legusto <= 0.9) ? 'mdi mdi-star-half' : 'mdi mdi-star') : 'mdi mdi-star-outline'}}" aria-hidden="true"></span>
		            <span class="{{ ($proveedor->calificacion_legusto > 1.0) ? (($proveedor->calificacion_legusto <= 1.9) ? 'mdi mdi-star-half' : 'mdi mdi-star') : 'mdi mdi-star-outline'}}" aria-hidden="true"></span>
		            <span class="{{ ($proveedor->calificacion_legusto > 2.0) ? (($proveedor->calificacion_legusto <= 2.9) ? 'mdi mdi-star-half' : 'mdi mdi-star') : 'mdi mdi-star-outline'}}" aria-hidden="true"></span>
		            <span class="{{ ($proveedor->calificacion_legusto > 3.0) ? (($proveedor->calificacion_legusto <= 3.9) ? 'mdi mdi-star-half' : 'mdi mdi-star') : 'mdi mdi-star-outline'}}" aria-hidden="true"></span>
		            <span class="{{ ($proveedor->calificacion_legusto > 4.0) ? (($proveedor->calificacion_legusto <= 5.0) ? 'mdi mdi-star-half' : 'mdi mdi-star') : 'mdi mdi-star-outline'}}" aria-hidden="true"></span>
		            <span class="sr-only">Posee una calificación de {{$proveedor->calificacion_legusto}}</span>
		            
		        </small>
	        </h2>
		  </div>
      </div>
      
    </div>
    @else
    <div class="text-center">
        <img style="height: 96px;" src="/hotel.png" alt="" role="presentation" aria-hidden="true" class="img-responsive">
        <h2 class="text-center text-uppercase" style="margin-bottom: 1rem;">{{$proveedor->proveedorRnt->razon_social}}</h2>    
    </div>
    
    @endif
    <div id="menu-page">
    	<div class="container">
    		<ul id="menu-page-list">
                <li>
                    <a href="#informacionGeneral" class="toSection">
						<i class="ionicons ion-information-circled" aria-hidden="true"></i>
						<span class="hidden-xs">{{trans('resources.detalle.informacionGeneral')}}</span>
					</a>
                </li>
     <!--           <li>-->
     <!--               <a href="#caracteristicas" class="toSection">-->
					<!--	<i class="ionicons ionicons ion-android-pin" aria-hidden="true"></i>-->
					<!--	<span class="hidden-xs">{{trans('resources.detalle.ubicacion')}}</span>-->
					<!--</a>-->
     <!--           </li>-->
                @if($paraTenerEnCuentaContieneAlgo)
                <li>
                    <a href="#paraTenerEnCuenta" class="toSection">
						<i class="ionicons ion-help-circled" aria-hidden="true"></i>
						<span class="hidden-xs">{{trans('resources.detalle.queDeboTenerEnCuenta')}}</span>
					</a>
                </li>
                @endif
                <li>
                    <a href="#comentarios" class="toSection">
						<i class="ionicons ion-chatbubbles" aria-hidden="true"></i>
						<span class="hidden-xs">{{trans('resources.detalle.comentarios')}}</span>
					</a>
                </li>
            </ul>
    	</div>
    	
    </div>
    <section id="informacionGeneral">
        <div class="container">
            @if(isset($proveedor->multimediaProveedores) && count($proveedor->multimediaProveedores) > 0)
            <h3 class="title-section">{{$proveedor->proveedorRnt->razon_social}}</h3>
            @endif
            <div class="text-center">
            @if(Auth::check())
                <form role="form" action="/proveedor/favorito" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="proveedor_id" value="{{$proveedor->id}}" />
                    <button type="submit" class="btn btn-lg btn-circled btn-favorite">
                      <span class="ion-android-favorite" aria-hidden="true"></span><span class="sr-only">Marcar como favorito</span>
                    </button>    
                </form>
            @else
                <button type="button" class="btn btn-lg btn-circled" title="Marcar como favorito" data-toggle="modal" data-target="#modalIniciarSesion">
                  <span class="ion-android-favorite-outline" aria-hidden="true"></span><span class="sr-only">Marcar como favorito</span>
                </button>
            @endif
            @if(Session::has('message'))
                <div class="alert alert-info" role="alert" style="text-align: center;">{{Session::get('message')}}</div>
            @endif  
          </div>
            
            <!--<div class="text-center">-->
            <!--    <button type="button" class="btn btn-lg btn-link" id="btn-favorite">-->
            <!--        <span class="ionicons ion-android-favorite-outline" aria-hidden="true"></span>-->
            <!--    </button>-->
            <!--</div>-->
            
            <div class="row">
                <div class="col-xs-12">
                    @if(isset($video_promocional))
                    <iframe src="https://www.youtube.com/embed/<?php echo parse_yturl($video_promocional); ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen style="width: 100%; height: 350px;"></iframe>
                    @endif
                </div>
                <div class="col-xs-12 col-md-8">
                    <p style="white-space: pre-line;">{{$proveedor->proveedorRnt->idiomas[0]->descripcion}}</p>
                </div>
                <div class="col-xs-12 col-md-4">
                    <ul class="list">
                        @if(count($proveedor->proveedoresConIdiomas) > 0)
                        <li>
                            <div class="row align-items-center">
                                <div class="col-xs-2">
                                    <span class="ionicons ion-android-time" aria-hidden="true"></span> <span class="sr-only">Horario</span>
                                </div>
                                <div class="col-xs-10">
                                    <div class="form-group">
                                        <label>Horario</label>
                                        <p class="form-control-static">
                                            {{$proveedor->proveedoresConIdiomas[0]->horario}}
                                        </p>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </li>
                        @endif
                        <li>
                            <div class="row align-items-center">
                                <div class="col-xs-2">
                                    <span class="ionicons ion-cash" aria-hidden="true"></span> <span class="sr-only">Valor estimado</span>
                                </div>
                                <div class="col-xs-10">
                                    <div class="form-group">
                                        <label>Valor estimado</label>
                                        <p class="form-control-static">
                                            ${{number_format(intval($proveedor->valor_min))}} - ${{number_format(intval($proveedor->valor_max))}}
                                        </p>
                                    </div>
                                    
                                </div>
                                
                            </div>
                        </li>
                        @if($proveedor->telefono != null)
                        <li>
                            <div class="row align-items-center">
                                <div class="col-xs-2">
                                    <span class="ionicons ion-android-call" aria-hidden="true"></span> <span class="sr-only">Dirección</span>
                                </div>
                                <div class="col-xs-10">
                                    <div class="form-group">
                                        <label>Teléfono</label>
                                        <p class="form-control-static">$proveedor->telefono</p>
                                    </div>
                                    
                                </div>
                            </div>
                        </li>
                        @endif
                        @if($proveedor->sitio_web != null)
                        <li>
                            <div class="row align-items-center">
                                <div class="col-xs-2">
                                    <span class="ionicons ion-android-globe" aria-hidden="true"></span> <span class="sr-only">Sitio web</span>
                                </div>
                                <div class="col-xs-10">
                                    <div class="form-group">
                                        <label>Sitio web</label>
                                        <p class="form-control-static">
                                            <a href="{{$proveedor->sitio_web}}" target="_blank" rel="noopener noreferrer">Clic para ir al sitio web</a>
                                        </p>
                                    </div>
                                    
                                </div>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>
            
        </div>
        
    </section>
    <section id="comentarios">
        <div class="container">
            <h3 class="title-section">Comentarios <small>({{count($proveedor->comentariosProveedores)}})</small></h3>
            <p class="text-center">Te invitamos a que compartas tu opinión acerca de {{$proveedor->proveedorRnt->razon_social}}.</p>   
            <div class="text-center">
                <div class="text-center">
                <a id="btn-share-facebook" href="https://www.facebook.com/sharer/sharer.php?u={{\Request::url()}}" class="btn btn-primary" target="_blank" rel="noopener noreferrer"><span class="ion-social-facebook" aria-hidden="true"></span> Facebook</a>
                <a id="btn-share-twitter" href="https://twitter.com/home?status=Realiza {{$proveedor->proveedorRnt->razon_social}} en el departamento del Cesar. Conoce más en {{\Request::url()}}" class="btn btn-info" target="_blank" rel="noopener noreferrer"><span class="ion-social-twitter" aria-hidden="true"></span> Twitter</a>
                <a id="btn-share-googleplus" href="https://plus.google.com/share?url={{\Request::url()}}" class="btn btn-danger" target="_blank" rel="noopener noreferrer"><span class="ion-social-googleplus" aria-hidden="true"></span> Google +</a>
            </div>
            </div>
            <div class="row justify-content-center" id="puntajes">
                <div class="col-xs-12">
                    <p class="text-center">¿Le gustó?</p>
                    <small class="btn-block text-center">
    		            <span class="{{ ($proveedor->calificacion_legusto > 0.0) ? (($proveedor->calificacion_legusto <= 0.9) ? 'ionicons-inline ion-android-star-half' : 'ionicons-inline ion-android-star') : 'ionicons-inline ion-android-star-outline'}}" aria-hidden="true"></span>
    		            <span class="{{ ($proveedor->calificacion_legusto > 1.0) ? (($proveedor->calificacion_legusto <= 1.9) ? 'ionicons-inline ion-android-star-half' : 'ionicons-inline ion-android-star') : 'ionicons-inline ion-android-star-outline'}}" aria-hidden="true"></span>
    		            <span class="{{ ($proveedor->calificacion_legusto > 2.0) ? (($proveedor->calificacion_legusto <= 2.9) ? 'ionicons-inline ion-android-star-half' : 'ionicons-inline ion-android-star') : 'ionicons-inline ion-android-star-outline'}}" aria-hidden="true"></span>
    		            <span class="{{ ($proveedor->calificacion_legusto > 3.0) ? (($proveedor->calificacion_legusto <= 3.9) ? 'ionicons-inline ion-android-star-half' : 'ionicons-inline ion-android-star') : 'ionicons-inline ion-android-star-outline'}}" aria-hidden="true"></span>
    		            <span class="{{ ($proveedor->calificacion_legusto > 4.0) ? (($proveedor->calificacion_legusto <= 5.0) ? 'ionicons-inline ion-android-star-half' : 'ionicons-inline ion-android-star') : 'ionicons-inline ion-android-star-outline'}}" aria-hidden="true"></span>
    		        </small>
                </div>
                
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalComentario">Comentar</button>
            </div>
        </div>
        @if(count($proveedor->comentariosProveedores) > 0)
        <div class="container">
            <hr>
             <ul class="list-group list-group-flush no-list-style">
                @foreach ($proveedor->comentariosProveedores as $comentario)
                     <li class="list-group-item">
                         <p class="text-muted m-0"><i class="ion-person"></i> {{$comentario->user->username}} - <i class="ion-calendar"></i> {{date("j/m/y", strtotime($comentario->fecha))}}</p>
    
                        <blockquote>
                        {{$comentario->comentario}}
                        </blockquote>
                    </li>
                @endforeach
                  
                           
            </ul>
        </div>
        
        @endif
        
        
        <!-- Modal -->
         <div class="modal fade" id="modalComentario" tabindex="-1" role="dialog" aria-labelledby="labelModalComentario" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="labelModalComentario">Comentar y calificar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="formEnviarComentario" name="formEnviarComentario" method="post" action="/proveedor/guardarcomentario">
                        <div class="modal-body">
                            <input type="hidden" name="id" value="{{$proveedor->id}}" />
                            <div class="form-group text-center">
                                <label class="control-label" for="calificacionLeGusto">¿Le gustó?</label>
                                <div class="checks">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="calificacionLeGusto" id="calificacionLeGusto-1" value="1" required onclick="showStars(this)">
                                        <label class="form-check-label" for="calificacionLeGusto-1"><span class="ionicons-inline ion-android-star-outline"></span><span class="sr-only">1</span></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="calificacionLeGusto" id="calificacionLeGusto-2" value="2" required onclick="showStars(this)">
                                        <label class="form-check-label" for="calificacionLeGusto-2"><span class="ionicons-inline ion-android-star-outline"></span><span class="sr-only">2</span></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="calificacionLeGusto" id="calificacionLeGusto-3" value="3" required onclick="showStars(this)">
                                        <label class="form-check-label" for="calificacionLeGusto-3"><span class="ionicons-inline ion-android-star-outline"></span><span class="sr-only">3</span></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="calificacionLeGusto" id="calificacionLeGusto-4" value="4" required onclick="showStars(this)">
                                        <label class="form-check-label" for="calificacionLeGusto-4"><span class="ionicons-inline ion-android-star-outline"></span><span class="sr-only">4</span></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="calificacionLeGusto" id="calificacionLeGusto-5" value="5" required onclick="showStars(this)">
                                        <label class="form-check-label" for="calificacionLeGusto-5"><span class="ionicons-inline ion-android-star-outline"></span><span class="sr-only">5</span></label>
                                    </div>
                                </div>
                                
                            </div>
        
                            
                            <div class="form-group">
                                <label class="control-label" for="comentario"><span class="asterisk">*</span> Comentario</label>
                                <textarea class="form-control" id="comentario" name="comentario" rows="5" maxlength="1000" placeholder="Ingrese su comentario. Máx. 1000 caracteres" style="resize:none;" required></textarea>    
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>    
                    </form>
                    
                </div>
            </div>
        </div>
      
   </section>

    
    
    

@endsection
@section('javascript')
<!--<script src="{{asset('/js/public/vibrant.js')}}"></script>-->
<!--<script src="{{asset('/js/public/setProminentColorImg.js')}}"></script>-->
<script>
  

    function showStars(input){
        //var checksFacilLlegar = document.getElementsByName(input.name);
        $("input[name='" + input.name + "']+label>.ionicons-inline").removeClass('ion-android-star');
        $("input[name='" + input.name + "']+label>.ionicons-inline").addClass('ion-android-star-outline');
        for(var i = 0; i < parseInt(input.value); i++){
            $("label[for='" + input.name + "-" + (i+1) + "'] .ionicons-inline").removeClass('ion-android-star-outline');
            $("label[for='" + input.name + "-" + (i+1) + "'] .ionicons-inline").addClass('ion-android-star');
            //console.log(checksFacilLlegar[i].value);
        }
    }
</script>
<script>
    $(document).ready(function(){
        $('#modalComentario').on('hidden.bs.modal', function (e) {
            $(this).find('form')[0].reset();
            $(this).find('.checks .ionicons-inline').removeClass('ion-android-star');
            $(this).find('.checks .ionicons-inline').addClass('ion-android-star-outline');
        })
    });
</script>
<script async defer
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC55uUNZFEafP0702kEyGLlSmGE29R9s5k&callback=initMap">

</script>
@endsection