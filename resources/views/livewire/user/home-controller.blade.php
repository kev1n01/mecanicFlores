@section('title','Market Enetero')
<div>
    <!-- Slideshow -->
    <div class="section slideshow">
        <div class="container">
            <div class="tiva-slideshow-wrapper">
                <div id="tiva-slideshow" class="nivoSlider">
                    <a href="#">
                        <img class="img-responsive" src="{{asset('assetsuser/img/slideshow/home2-slideshow-1.jpg')}}" alt="Slideshow Image">
                    </a>
                    <a href="#">
                        <img class="img-responsive" src="{{asset('assetsuser/img/slideshow/home2-slideshow-2.jpg')}}" alt="Slideshow Image">
                    </a>
                    <a href="#">
                        <img class="img-responsive" src="{{asset('assetsuser/img/slideshow/home2-slideshow-3.jpg')}}" alt="Slideshow Image">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Banners -->
    <div class="section banners">
        <div class="container">
            <div class="row margin-10">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding-10">
                    <div class="banner-item effect">
                        <a href="#">
                            <img class="img-responsive" src="{{asset('assetsuser/img/banner/home2-banner-1.png')}}" alt="Banner 1">
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding-10">
                    <div class="banner-item effect">
                        <a href="#">
                            <img class="img-responsive" src="{{asset('assetsuser/img/banner/home2-banner-2.png')}}" alt="Banner 2">
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding-10">
                    <div class="banner-item effect">
                        <a href="#">
                            <img class="img-responsive" src="{{asset('assetsuser/img/banner/home2-banner-3.png')}}" alt="Banner 3">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2 Columns -->
    <div class="two-columns">
        <div class="container">
            <div class="row ">
                <!-- Left Column -->
                <div class="col-20p col-md-3 left-column">
                    <!-- Product - Category -->
                    <div class="section product-categories">
                        <div class="block-title">
                            <h2 class="title">Categorias</h2>
                        </div>

                        <div class="block-content">
                            @foreach($categories as $c)
                            <div class="item">
{{--                                    <span class="arrow collapsed" data-toggle="collapse" data-target="#vegetables" aria-expanded="false" role="button">--}}
{{--                                        <i class="fa fa-angle-down" aria-hidden="true"></i>--}}
{{--                                        <i class="fa fa-angle-right" aria-hidden="true"></i>--}}
{{--                                    </span>--}}

                                <a class="category-title" wire:model="{{$c->id}}">{{$c->name}}</a>
{{--                                <div class="sub-category collapse" id="vegetables" aria-expanded="true" role="main">--}}
{{--                                    <div class="item">--}}
{{--                                        <a href="#">Tomato</a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>


                <!-- Right Column -->
                <div class="col-80p col-md-9 right-column">
                    <!-- Product - Category Tab -->
                    <div class="section products-block category-tab">
                        <div class="block-title">
                            @foreach($cn as $cn)
                            <h2 class="title">{{$cn->name}}</h2>
                            @endforeach
                        </div>
                        <div class="block-content">
                            <!-- Tab Navigation -->
                            <div class="tab-nav">
                                <ul>
                                    <li class="active">
                                        <a data-toggle="tab" href="#new-arrivals" wire:click="activetab">
                                            <span>Recientes</span>
                                        </a>
                                    </li>
                                    <li class="{{$isactive == 'activemore' ?? 'active',''}}" wire:click="activetab">
                                        <a data-toggle="tab" href="#best-seller">
                                            <span>Más vendidos</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <!-- Tab Content -->
                            <div class="tab-content">
                                <!-- New Arrivals -->
                                <div role="tabpanel" class="tab-pane fade in active " id="new-arrivals">
                                    <div class="products owl-theme owl-carousel">
                                    @foreach($productsnew as $p)
                                        <div class="product-item">
                                            <div class="product-image">
                                                <a href="#">
                                                    <img src="{{ asset('storage/'.$p->image_product) }}" alt="Product Image">
                                                </a>
                                            </div>

                                            <div class="product-title">
                                                <a href="#">
                                                    {{$p->name}}
                                                </a>
                                            </div>

                                            <div class="product-rating">
                                                <div class="star on"></div>
                                                <div class="star on"></div>
                                                <div class="star on "></div>
                                                <div class="star on"></div>
                                                <div class="star"></div>
                                            </div>

                                            <div class="product-price">
                                                <span class="sale-price">S/. {{$p->purchase_price}}</span>
                                                <span class="base-price">S/. {{$p->sale_price}}</span>
                                            </div>

                                            <div class="product-buttons">
                                                <a class="add-to-cart" href="#">
                                                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>

                                <!-- Best Seller -->
                                <div role="tabpanel" class="tab-pane fade" id="best-seller">
                                    <div class="products owl-theme owl-carousel">
                                        @foreach($productsbestseller as $p)
                                        <div class="product-item">
                                            <div class="product-image">
                                                <a >
                                                    <img src="{{ asset('storage/'.$p->image_product) }}" alt="Product Image">
                                                </a>
                                            </div>

                                            <div class="product-title">
                                                <a href="#">
                                                    {{$p->name}}
                                                </a>
                                            </div>

                                            <div class="product-rating">
                                                <div class="star on"></div>
                                                <div class="star on"></div>
                                                <div class="star on "></div>
                                                <div class="star on"></div>
                                                <div class="star"></div>
                                            </div>

                                            <div class="product-price">
                                                <span class="sale-price">S/. {{$p->purchase_price}}</span>
                                                <span class="base-price">S/. {{$p->sale_price}}</span>
                                            </div>

                                            <div class="product-buttons">
                                                <a class="add-to-cart" href="#">
                                                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Newsletter -->
                    <div class="section newsletter">
                        <h2 class="block-title">Boletin informativo</h2>

                        <div class="block-content">
                            <p class="description">Suscríbase al boletín para recibir ofertas especiales y noticias exclusivas sobre los productos Enetero</p>
                            <form action="#" method="post">
                                <input type="text" placeholder="Enter Your Email">
                                <button type="submit" class="btn btn-primary">Suscribir</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Intro -->
    <div class="section intro">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="intro-header">
                        <img src="{{asset('assetsuser/img/leaf.png')}}" alt="Partner 1">
                        <h3>¿Porqué elegirnos?</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="intro-left">
                        <div class="intro-item">
                            <p><img src="{{asset('assetsuser/img/intro-icon-1.png')}}" alt="Intro Image"></p>
                            <h4>Siempre fresco</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>

                        <div class="intro-item">
                            <p><img src="{{asset('assetsuser/img/intro-icon-2.png')}}" alt="Intro Image"></p>
                            <h4>Producto calidad</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="effect">
                        <a href="#">
                            <img class="intro-image img-responsive" src="{{asset('assetsuser/img/intro-2.png')}}" alt="Intro Image">
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="intro-right">
                        <div class="intro-item">
                            <p><img src="{{asset('assetsuser/img/intro-icon-3.png')}}" alt="Intro Image"></p>
                            <h4>Precios comodos</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>

                        <div class="intro-item">
                            <p><img src="{{asset('assetsuser/img/intro-icon-4.png')}}" alt="Intro Image"></p>
                            <h4>Productos únicos</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
