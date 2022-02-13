<div>

    {{--  Scripts necesarios para el template  --}}
    <script src="{{asset("template_guest/js/jquery.js")}}"></script>
    <script src="{{asset("template_guest/js/bootstrap.js")}}"></script>
    <script src="{{asset("template_guest/js/easing.js")}}"></script>
<!--    <script src="{{asset("template_guest/js/nicescroll.js")}}"></script>-->

    {{--  Scripts de la pagina  --}}
    <script src="{{asset("template_guest/js/pace.js")}}"></script>

    <script src="{{asset('js/app.js')}}"> </script>
    <script src="{{ mix('/js/app.js') }}"></script>

    <script>

        $(function() {
            $('.scrollto, .gototop').bind('click',function(event){
                var $anchor = $(this);
                $('html, body').stop().animate({
                    scrollTop: $($anchor.attr('href')).offset().top
                }, 1500,'easeInOutExpo');
                //event.preventDefault();
            });
        });

    </script>

</div>
