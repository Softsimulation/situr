@extends('layout._publicLayout')

@section('Title','Registrar')

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
        /*main{*/
        /*    padding: 2% 0;*/
        /*}*/
    </style>
@endsection
@section('content')
    <div class="container">
        <h2 class="title-section">Registro</h2>
        <form id="signupform" name="registrarForm" class="form-horizontal" role="form">
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Correo electrónico"/>
			</div>
			<div class="form-group">
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese su nombre"/>
			</div>
			<div class="form-group">
                <input type="password" class="form-control" name="password1" id="password1" placeholder="Contraseña"/>
			</div>
			<div class="form-group">
                <input type="password" class="form-control" name="password2" id="password2" placeholder="Confirmar contraseña"/>
			</div>
        </form>
    </div>

@endsection