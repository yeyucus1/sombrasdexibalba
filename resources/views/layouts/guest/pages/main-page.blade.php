@extends('layouts.guest.base')
@section('content')
    {{--{{Route::currentRouteName() }}--}}
    <div class="preloader"></div>

    <! -- ******************** MASTHEAD SECTION ******************** -->
    <main class="masthead" role="main">
        <div class="container">
            <div class="logo"> <a href="#"><img src="{{asset("template_guest/images/logo_xibalba.png")}}" alt="logo"></a>
            </div>

            <h1>El señor de<br> Ethan M. Morgue te da la <b>bienvenida</b> a nuestra casa<br></h1>

            <a href="#OurProducts" class="scrollto">
                <p>Que Ofrecemos</p>
                <p class="scrollto--arrow"><img src="{{asset("template_guest/images/scroll_down.png")}}" alt="scroll down arrow"></p>
            </a>
        </div><! --/container -->
    </main><! --/main -->


    <! -- ******************** FEATURES SECTION ******************** -->
    <div class="container" id="explore">

        <div class="section-title">
            <h2>¿Que es Sombras de Xibalba?</h2>
            <h4>Somos un grupo de programadores, escritores y creativos que queremos dar un espacio para la publicación de obras artisticas.</h4>
        </div>

        <section class="row heroimg breath">
            <div class="col-md-12 text-center">
                <h5>Nuestros objetivos:</h5>
                <ul>
                    <li>
                        Apoyar el arte
                    </li>
                </ul>
            </div>
        </section><! --/section -->

        <div id="OurProducts" class="section-title">
            <h2>Que Ofrecemos</h2>
            <h4>Nuestro objetivo principal es fomentar la creatividad en nuestros usuarios</h4>
        </div>

        <section class="row features">
            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                    <a href="{{route('writer.artworks.create')}}" class="" >
                        <i class="fas fa-pencil-alt fa-7x"></i>
                        <div class="caption">
                            <h3>Cuentanos tu historia</h3>
                            <p>Puede que no seas el mejor escritor, pero todos tenemos una historia que contar, queremos conocer la tuya</p>
                        </div>
                    </a>
                </div><! --/thumbnail -->
            </div><! --/col-sm-6-->

            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                    <a href="{{route('guest.artwork.random')}}" class="" >
                        <i class="fas fa-book fa-7x"></i>
                        <div class="caption">
                            <h3>Echa vistazo a nuestro contenido</h3>
                            <p>Echa un vistaso a las obras de las sombras de Xibalba</p>
                        </div>
                    </a>
                </div><! --/thumbnail -->
            </div><! --/col-sm-6-->

            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                    <a href="{{route('writer.characters')}}" class="" >
                        <i class="fas fa-user-secret fa-7x"></i>
                        <div class="caption">
                            <h3>Crear un personaje</h3>
                            <p>Tal vez no quieres hacer una historia, describe un personaje y las sombras de xibalba nos ecargaremos de darle una.</p>
                        </div>
                    </a>
                </div><! --/thumbnail -->
            </div><! --/col-sm-6-->

            <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
                    <i class="far fa-image fa-7x"></i>
                    <div class="caption">
                        <h3>Crea un Escenario.</h3>
                        <p>Si no quieres crear una historia, ni un personaje, describe un lugar y las sombras de xibalba nos encargaremos de darle personajes y una historia.</p>
                    </div>
                </div><! --/thumbnail -->
            </div><! --/col-sm-6-->
        </section><! --/section -->


        <! -- ******************** Patrions SECTION ******************** -->
        <!--    <div class="section-title">
        <h2>Algunos de nuestros patrocinadores</h2>
        <h4>We work with different kind of brands</h4>
    </div>

    <section class="row clientlogo breath">
        <div class="col-md-12 text-center">
            <img src="{{asset("template_guest/images/client-logos.png")}}" alt="client-logos">
        </div>
    </section><! &#45;&#45;/section &ndash;&gt;

</div><! &#45;&#45;/container &ndash;&gt;-->


        <! -- ******************** OUR TEAM SECTION ******************** -->
        <div class="highlight testimonials">
            <div class="container">
                <div class="section-title">
                    <h2>Quienes somos</h2>
                    <h4>Conoce un poco a los señores y arquitectos de nuestro inframundo.</h4>
                </div>

                @include('layouts.guest.partials.our-team')

            </div><! --/container -->
        </div><! --/highlight Testimonials -->


        <! -- ******************** Sección de paquetes de pago ******************** -->
        <!--<div class="container">

            <div class="section-title">
                <h2>Honest pricing. No surprises.</h2>
                <h4>No contract. No risk. No credit card required. </h4>
            </div>


            <section class="row breath planpricing">

                <div class="col-md-4">
                    <div class="pricing color1">
                        <div class="planname">Personal</div>
                        <div class="price"> <span class="curr">$</span>14<span class="per">/MO</span></div>
                        <div class="billing">Billed Annually</div>
                    </div><! &#45;&#45;/pricing &ndash;&gt;
                </div><! &#45;&#45;/col-md-4&ndash;&gt;

                <div class="col-md-4">
                    <div class="pricing color2">
                        <div class="planname">Agency</div>
                        <div class="price"> <span class="curr">$</span>49<span class="per">/MO</span></div>
                        <div class="billing">Billed Annually</div>
                    </div><! &#45;&#45;/pricing &ndash;&gt;
                </div><! &#45;&#45;/col-md-4&ndash;&gt;

                <div class="col-md-4">
                    <div class="pricing color3">
                        <div class="planname">Enterprise</div>
                        <div class="price"> <span class="curr">$</span>99<span class="per">/MO</span></div>
                        <div class="billing">Billed Annually</div>
                    </div><! &#45;&#45;/pricing &ndash;&gt;
                </div><! &#45;&#45;/col-md-4&ndash;&gt;
            </section>&lt;!&ndash; /section planpricing &ndash;&gt;-->


        <! -- ******************** FAQ ******************** -->

        <div class="section-title">
            <h5>Preguntas Frecuentes</h5>
        </div>

        <section class="row faq breath">
            <div class="col-md-6">
                <h6>¿Es gratuito?</h6>
                <p>Sombras de xibalba es un servicio gratuito, tanto para artistas como para consumidores, pero aceptamos donaciones para mantener el sitio y a nuestros desarrolladores</p>
                <!--            <h6>Can I switch plans later?</h6>
                            <p>Absolutely. You can switch between our paid plans, or cancel your account altogether, whenever you like. We will adjust any payments accordingly.</p>-->
            </div><! --/col-md-6 -->

            <!--        <div class="col-md-6">
                        <h6>Do I need to choose a plan now?</h6>
                        <p>No. You get the full featured, unlimited version of our service completely free for 10 days. Once you're ready to upgrade, you may choose a plan which suits your needs.</p>
                        <h6>What payment types do you accept?</h6>
                        <p>We accept payments from MasterCard, Visa, Visa Debit and American Express. We do not accept PayPal. Remember, you do not need to supply card details to start your free trial.</p>
                    </div><! &#45;&#45;/col-md-6 &ndash;&gt;-->
        </section><! --/section faq -->

    </div><! --/container -->

    <! -- ******************** FOOTER ******************** -->
    <main class="footercta" role="main">
        <div class="container">
            <h1>Conoce nuestro inframundo: SombrasDeXibalba.mx</h1>
        </div><! --/container -->
    </main><! --/main -->

    <div class="container">
        <section class="row breath">
            <div class="col-md-12 footerlinks">
                <p>&copy; 2014 BlackTie.co. & <br> <a href="https://tecnowizards.com">TecnoWizards.com</a>All Rights Reserved</p>
            </div>
        </section><! --/section -->
    </div><! --/container -->
@endsection
