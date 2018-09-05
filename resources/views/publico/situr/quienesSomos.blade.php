@extends('layout._publicLayout')

@section('Title','Quiénes somos')

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
        <h2 class="title-section">Quiénes somos</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consequat enim vel lorem commodo venenatis. Sed eleifend metus quis diam malesuada mollis. Curabitur sit amet ipsum quam. Quisque at lectus mi. In dictum sodales augue, ac porttitor turpis egestas ut. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras congue consectetur sagittis. Nulla eu molestie tortor, et maximus eros. Sed nibh magna, hendrerit id pharetra quis, congue iaculis risus. Nullam lobortis metus quis turpis duis.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In consequat enim vel lorem commodo venenatis. Sed eleifend metus quis diam malesuada mollis. Curabitur sit amet ipsum quam. Quisque at lectus mi. In dictum sodales augue, ac porttitor turpis egestas ut. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras congue consectetur sagittis. Nulla eu molestie tortor, et maximus eros. Sed nibh magna, hendrerit id pharetra quis, congue iaculis risus. Nullam lobortis metus quis turpis duis.</p>
        <ul>
            <li>Option list One</li>
            <li>Option list Two</li>
            <li>Option list Three</li>
            <li>Option list Four</li>
        </ul>
    </div>

@endsection
