<div id="logos" class="container">
        <div id="slider-logos">
            <img src="/res/logo_mincit.png" alt="{{trans('resources.common.logoDe', ['logo' => 'Ministerio de Industria, Comercio y Turísmo'])}}" class="img-responsive">
            <img src="/res/logo_fontur.png" alt="{{trans('resources.common.logoDe', ['logo' => 'Fontur'])}}" class="img-responsive">
            <img src="/res/logo_gobierno.png" alt="{{trans('resources.common.logoDe', ['logo' => 'Gobierno de Colombia'])}}" class="img-responsive">
            <img src="/res/gobernacion.png" alt="{{trans('resources.common.logoDe', ['logo' => 'Gobernación del Atlántico'])}}" class="img-responsive">
            <img src="/res/alcaldia.png" alt="{{trans('resources.common.logoDe', ['logo' => 'alcaldía de Barranquilla'])}}" class="img-responsive">
            <img src="/res/logo_cotelco.png" alt="{{trans('resources.common.logoDe', ['logo' => 'Cotelco Atlántico'])}}" class="img-responsive">    
        </div>
        
    </div>
<footer>
    
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
                <hr style="margin: .5rem 0">
                <p style="margin: 0">{{trans('resources.common.suscribase')}}</p>
                <form class="form-inline" name="guardarSuscriptor" action="/suscriptores/guardarsuscriptor" method="post">
        			<div class="form-group" style="width: 80%;">
        			    <label class="sr-only" for="emailSuscriptor">{{trans('resources.common.suscribir')}}</label>
                        <input type="email" class="form-control" style="width: 100%;" required name="emailSuscriptor" id="emailSuscriptor" placeholder="Ingrese el correo donde desea recibir las notificaciones"/>
    					
                    </div>
                    <button type="submit" class="btn btn-info">{{trans('resources.common.enviar')}}</button>
                </form>
                    @if(isset($suscriptorExiste) && $suscriptorExiste != null)
                        <div class="alert alert-warning">
                            
                            <span class="messages">
                                  <span>*{{$suscriptorExiste}}</span><br/>
                            </span>
                        </div>
                    @endif
                    @if(isset($exitoso) && $exitoso != null)
                        <div class="alert alert-success">
                            
                            <span class="messages">
                                  <span>*{{$exitoso}}</span><br/>
                            </span>
                        </div>
                    @endif
        		
            </div>
        </div>
    </div>
    <div id="sign">
        <div class="container text-center">
            <p>SITUR Atlántico &copy; 2018. Desarrollado por <a href="http://www.softsimulation.com">Softsimulation S.A.S</a></p>
        </div>
    </div>
</footer>