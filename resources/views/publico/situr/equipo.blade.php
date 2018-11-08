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
    </style>
@endsection
@section('content')
    <div class="container">
        <h2 class="title-section">Equipo SITUR Atlántico</h2>
        <hr>
        <h3>Junta Directiva SITUR Atlántico</h3>
        <div class="tiles">
            <div class="tile">
                <div class="tile-body">
                    <h3>Carlos Martin Leyes</h3>
                    <p>Subsecretario de Turismo del Atlántico</p>
                </div>
                
            </div>
            <div class="tile">
                <div class="tile-body">
                    <h3>Jaime Alfaro</h3>
                    <p>Jefe de la oficina de turismo de Barranquilla</p>
                </div>
                
            </div>
            <div class="tile">
                <div class="tile-body">
                    <h3>Mario Muvdi</h3>
                    <p>Presidente de Cotelco Capitulo Atlántico</p>
                </div>
                
            </div>
            <div class="tile">
                <div class="tile-body">
                    <h3>Marbel Ruiz</h3>
                    <p>Directora Ejecutiva de Cotelco Capitulo Atlántico</p>
                </div>
                
            </div>
        </div>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consequat enim vel lorem commodo venenatis. Sed eleifend metus quis diam malesuada mollis. Curabitur sit amet ipsum quam. Quisque at lectus mi. In dictum sodales augue, ac porttitor turpis egestas ut. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras congue consectetur sagittis. Nulla eu molestie tortor, et maximus eros. Sed nibh magna, hendrerit id pharetra quis, congue iaculis risus. Nullam lobortis metus quis turpis duis.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consequat enim vel lorem commodo venenatis. Sed eleifend metus quis diam malesuada mollis. Curabitur sit amet ipsum quam. Quisque at lectus mi. In dictum sodales augue, ac porttitor turpis egestas ut. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras congue consectetur sagittis. Nulla eu molestie tortor, et maximus eros. Sed nibh magna, hendrerit id pharetra quis, congue iaculis risus. Nullam lobortis metus quis turpis duis.</p>
    </div>

@endsection
