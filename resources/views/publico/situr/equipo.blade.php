@extends('layout._publicLayout')

@section('Title','Equipo SITUR')

@section ('estilos')
    <style>
        header{
            position: static;
            background-color: black;
            margin-bottom: 1rem;
        }
        .nav-bar > .brand a img{
            height: auto;
        }
        main{
            padding: 2% 0;
        }
        .label{
            white-space: normal;
            display: inline-block;
            font-weight: 500;
            font-size: .85rem;
        }
        .tile .tile-img .text-overlap{
            display: flex;
            align-items: flex-end;
            background: transparent;
        }
        .tile .tile-img img{
            width: 100%;
        }
        .tiles .tile .tile-img{
            height: 256px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <h2 class="title-section">Equipo SITUR Atlántico</h2>
        <hr>
        <h3>Comité Directivo SITUR Atlántico</h3>
        <div class="tiles">
            <div class="tile">
                <div class="tile-img" style="background:white;">
                    <img src="/res/equipo/Carlos_Leyes.jpeg" alt="Imagen por defecto de persona">
                    
                </div>
                <div class="tile-body">
                    <h4>Carlos Martin Leyes</h4>
                    <p class="text-muted">Subsecretario de Turismo del Atlántico</p>
                </div>
                
            </div>
            <div class="tile">
                <div class="tile-img" style="background:white;">
                    <img src="/res/equipo/Jaime_Alfaro.jpeg" alt="Imagen por defecto de persona">
                    
                </div>
                <div class="tile-body">
                    <h4>Jaime Alfaro</h4>
                    <p class="text-muted">Jefe de la oficina de turismo de Barranquilla</p>
                </div>
                
            </div>
            <div class="tile">
                <div class="tile-img" style="background:white;">
                    <img src="/res/User-Profile.png" alt="Imagen por defecto de persona">
                    
                </div>
                <div class="tile-body">
                    
                    <h4>Mario Muvdi</h4>
                    <p class="text-muted">Presidente de Cotelco Capitulo Atlántico</p>
                </div>
                
            </div>
            <div class="tile">
                <div class="tile-img" style="background:white;">
                    <img src="/res/equipo/marbel.jpeg" alt="Imagen por defecto de persona">
                    
                </div>
                <div class="tile-body">
                    <h4>Marbel Ruiz</h4>
                    <p class="text-muted">Directora Ejecutiva de Cotelco Capitulo Atlántico</p>
                </div>
                
            </div>
        </div>
        <hr>
         <h3>Equipo de trabajo SITUR Atlántico</h3>
        <div class="tiles">
            <div class="tile">
                <div class="tile-img" style="background:white;">
                    <img src="/res/equipo/david.jpeg" alt="Imagen por defecto de persona">
                    <div class="text-overlap">
                        <span class="label label-success">Director</span>
                    </div>
                </div>
                <div class="tile-body">
                    <h4>David Borge</h4>
                    <p class="text-muted">Economista - Magister en Desarrollo Social</p>
                </div>
                
            </div>
            
         <div class="tile">
                <div class="tile-img" style="background:white;">
                    <img src="/res/equipo/javier.jpeg" alt="Imagen por defecto de persona">
                    <div class="text-overlap">
                        <span class="label label-success">Supervisor de Campo</span>
                    </div>
                </div>
                <div class="tile-body">
                    <h4>Javier Ortega</h4>
                    <p class="text-muted">Economista Universidad del Norte</p>
                </div>
                
            </div>
            
            
            <div class="tile">
                <div class="tile-img" style="background:white;">
                    <img src="/res/equipo/endy_acosta.jpg" alt="Imagen por defecto de persona">
                    <div class="text-overlap">
                        <span class="label label-success">Analista</span>
                    </div>
                </div>
                <div class="tile-body">
                    <h4>Endy Salon</h4>
                    <p class="text-muted">Economista Universidad del Norte</p>
                </div>
                
            </div>
          
         
         
         
         
            <div class="tile">
                <div class="tile-img" style="background:white;">
                    <img src="/res/User-Profile.png" alt="Imagen por defecto de persona">
                    <div class="text-overlap">
                        <span class="label label-success">Profesional de Apoyo </span>
                    </div>
                </div>
                <div class="tile-body">
                    <h4>Alveiro Medina Robayo</h4>
                    <p class="text-muted">Comunicador Social y Periodista de la universidad Autónoma del Caribe</p>
                </div>
                
            </div>
              
            
            <div class="tile">
                <div class="tile-img" style="background:white;">
                    <img src="/res/equipo/paola_sierra.jpg" alt="Imagen por defecto de persona">
                    <div class="text-overlap">
                        <span class="label label-success">Profesional de Apoyo </span>
                    </div>
                </div>
                <div class="tile-body">
                    <h4>Paola Sierra</h4>
                    <p class="text-muted">Ingeniera Ambiental Universidad de la Costa</p>
                </div>
                
            </div>
            
            <div class="tile">
                <div class="tile-img" style="background:white;">
                    <img src="/res/equipo/karime.jpg" alt="Imagen por defecto de persona">
                    <div class="text-overlap">
                        <span class="label label-success">Profesional de Apoyo </span>
                    </div>
                </div>
                <div class="tile-body">
                    <h4>Luz Karime García</h4>
                    <p class="text-muted">Administradora de negocios internacionales de la universidad ITSA</p>
                </div>
                
            </div>
            <div class="tile">
                <div class="tile-img" style="background:white;">
                    <img src="/res/equipo/jesus_polanco.jpg" alt="Imagen por defecto de persona">
                    <div class="text-overlap">
                        <span class="label label-success">Profesional de Apoyo </span>
                    </div>
                </div>
                <div class="tile-body">
                    <h4>Jesús Polanco Medrano</h4>
                    <p class="text-muted">Contador de la Universidad Simón Bolívar</p>
                </div>
                
            </div>
            
              <div class="tile">
                <div class="tile-img" style="background:white;">
                    <img src="/res/equipo/Anaromero.jpeg" alt="Imagen por defecto de persona">
                    <div class="text-overlap">
                        <span class="label label-success">Agente de llamadas </span>
                    </div>
                </div>
                <div class="tile-body">
                    <h4>Ana Romero</h4>
                    <p class="text-muted"> </p>
                </div>
                
            </div>
        </div>
    </div>

@endsection
