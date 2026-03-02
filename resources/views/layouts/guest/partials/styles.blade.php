<div>
    {{--  Hojas de estilo necesarias para el template  --}}
    <link href="{{asset("template_guest/css/bootstrap.css")}}" rel="stylesheet">
    <link href="{{asset("template_guest/css/main.css")}}" rel="stylesheet">

    {{--  favicon de la pagina (icono pequeño que aparece en la pestaña de la pagina)  --}}
    <link rel="shortcut icon" href="{{asset("template_guest/images/favicon.png")}}">

    {{--  fuentes de google--}}
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,600" rel="stylesheet" type="text/css">

    {{-- Fontawesome icons--}}
    <script src="https://kit.fontawesome.com/51cc3f5dea.js" crossorigin="anonymous"></script>

    <!--scripts de la app-->
    <script src="{{ mix('/js/app.js') }}"></script>


</div>
