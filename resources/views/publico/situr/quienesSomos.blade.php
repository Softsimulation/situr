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
        /*main{*/
        /*    padding: 2% 0;*/
        /*}*/
    </style>
@endsection
@section('content')
    <div class="container">
        <h2 class="title-section">Quiénes somos</h2>
        <p>El <strong>Sistema de Información Turística del Atlántico</strong> es una iniciativa del Ministerio de Comercio, Industria y Turismo (MinCIT) diseñada para integrar la información cuantitativa y cualitativa del turismo en el departamento del Atlántico con el objetivo de consolidar mediciones del sector que brinden información para caracterizar el turismo y generar estándares que permitan la comparación e integración estadística sectorial.</p>
        <p>La finalidad del SITUR es apoyar la toma de decisiones, soportar las estrategias de promoción de la región y consolidar una cultura de información del turismo como sector económico.</p>
        <p>Actualmente se realizan las siguientes mediciones:</p>
        <ul>
            <li>Turismo Receptor</li>
            <li>Turismo Interno y Emisor</li>
            <li>Caracterización de la Oferta</li>
            <li>Impacto en la Generación de Empleo</li>
        </ul>
        <p>
            El <strong>SITUR Atlántico - Sistema de información turística del Atlántico</strong>, un proyecto del Ministerio de Comercio, Industria y Turismo, Gobernación del Atlántico y la Alcaldía Distrital de Barranquilla. Esta iniciativa pretende caracterizar el sector turístico del departamento a través de la consolidación de información estadística y de promoción, con el fin de promover el posicionamiento del turismo como motor de desarrollo, generación de empleo y calidad de vida de los habitantes, aumentando la competitividad del Atlántico y la región Caribe.
        </p>
        <p>
            Este sistema ya fue reconocido por el MinCIT como un caso exitoso de recolección de datos, SITUR se ganó este reconocimiento nacional gracias a que es el único sistema en Colombia que más ha avanzado en la labor de medición ya que desde sus inicios, en el año 2005, funciona bajo los parámetros de la OMT.
        </p>
    </div>

@endsection
