@extends('layout._publicLayout')

@section('Title','')
@section ('estilos')
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
                  <img src="res/slider/slide1.jpeg" alt="" role="presentation">
                  <div class="carousel-caption">
                    ...
                  </div>
                </div>
                <div class="item">
                  <img src="res/slider/slide2.jpeg" alt="" role="presentation">
                  <div class="carousel-caption">
                    ...
                  </div>
                </div>
                <div class="item">
                  <img src="res/slider/slide3.jpeg" alt="" role="presentation">
                  <div class="carousel-caption">
                    ...
                  </div>
                </div>
              </div>
              <section id="indicadores">
                <div class="indicador">
                    <h2>Vacaciones, recreo y ocio</h2>
                    <p>fue el Motivo principal de viaje para visitar el Atlántico en el año 2017</p>
                </div>
                <div class="indicador">
                    <h2>Transporte terrestre de pasajeros</h2>
                    <p>Fue el medio de transporte más utilizado por los visitantes en el 2017</p>
                </div>
                <div class="indicador">
                    <h2>Hotel</h2>
                    <p>fue el tipo de alojamiento más utilizado en el 2017</p>
                </div>
            </section>
            </div>
            
            <div id="estadisticas" class="estadisticas">
                <ul>
                    <li id="turismoReceptor">
                        <a role="button" href="#"><span class="sprite estadisticas-receptor invert" aria-hidden="true"></span> Turismo receptor</a>
                    </li>
                    <li id="turismoInternoEmisor">
                        <a role="button" href="#"><span class="sprite estadisticas-emisor invert" aria-hidden="true"></span> Turismo interno y emisor</a>
                    </li>
                    <li id="turismoEmpleo">
                        <a role="button" href="#"><span class="sprite estadisticas-empleo invert" aria-hidden="true"></span> Empleo</a>
                    </li>
                    <li id="turismoOferta">
                        <a role="button" href="#"> <span class="sprite estadisticas-oferta invert" aria-hidden="true"></span> Oferta</a>
                    </li>
                    <li id="turismoSostenibilidad">
                        <a role="button" href="#"> <span class="sprite estadisticas-sostenibilidad invert" aria-hidden="true"></span>Turismo sostenible</a>
                    </li>
                </ul>
            </div>
            
            <section id="widgets">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <a class="weatherwidget-io" href="https://forecast7.com/es/11d00n74d81/barranquilla/" data-label_1="BARRANQUILLA" data-label_2="Clima" data-theme="original" >BARRANQUILLA Clima</a>
<script>
!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
</script>
                        </div>
                    </div>
                </div>
                
            </section>
            <section id="descripcion">
                <div class="container text-center">
                    <h2>SITUR Atlántico</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean varius metus quis neque vulputate maximus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi nec eros quis ex tristique gravida sed at elit. Sed vitae neque auctor elit viverra lobortis quis at risus. Nunc nibh felis, semper at lorem sed, gravida lobortis nunc. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus lorem lorem, imperdiet a enim a, cursus placerat volutpat.</p>
                </div>
                
            </section>
@endsection