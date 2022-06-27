@section('title','Home Enetero')
<div>

    <!-- Product - New Arrivals -->
    <div class="section products-block product-tab tab-2">
        <div class="block-title">
            <h2 class="title">Productos <span>Recientes</span></h2>
        </div>

        <div class="block-content">
            <div class="container">
                <!-- Tab Navigation -->
                <!-- Tab Content -->
                <div class="tab-content">
                    <!-- All Products -->
                    <div role="tabpanel" class="tab-pane fade in active" id="all-products">
                        <div class="products owl-theme owl-carousel">
                                @foreach($products as $p)
                                <div class="product-item">
                                    <div class="product-image">
                                        <img src="{{ asset('storage/'.$p->image_product) }}" alt="{{ $p->name }}">
                                    </div>

                                    <div class="product-title">
                                        <p >
                                            {{ $p->name}}
                                        </p>
                                        <p >
                                        {{ $p->category_product->name}}
                                        </p>
                                    </div>

                                    <div class="product-price">
                                        <span class="sale-price">S/. {{ $p->sale_price}}</span>
                                    </div>

                                    <div class="product-buttons">
                                        <a class="add-to-cart" wire:click="addtocart({{$p->code}})">
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
    </div>

    <!-- Banners -->
    <div class="section banners">
        <div class="row margin-0">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 padding-0">
                <div class="banner-item">
                    <div class="text">
                        <h3>Tomato and Pepper</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
                    </div>
                    <div class="image-mask"></div>
                    <img class="img-responsive" src="{{ asset('assetsuser/img/banner/home3-banner-1.jpg') }}" alt="Banner">
                </div>
            </div>

            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 padding-0">
                <div class="row margin-0">
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 padding-0">
                        <div class="banner-item">
                            <div class="text">
                                <h3>Tomato and Pepper</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
                            </div>
                            <div class="image-mask"></div>
                            <img class="img-responsive" src="{{ asset('assetsuser/img/banner/home3-banner-2.jpg') }}" alt="Banner">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding-0">
                        <div class="banner-item">
                            <div class="text">
                                <h3>Tomato and Pepper</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
                            </div>
                            <div class="image-mask"></div>
                            <img class="img-responsive" src="{{ asset('assetsuser/img/banner/home3-banner-3.jpg') }}" alt="Banner">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 padding-0">
                        <div class="banner-item">
                            <div class="text">
                                <h3>Tomato and Pepper</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
                            </div>
                            <div class="image-mask"></div>
                            <img class="img-responsive" src="{{ asset('assetsuser/img/banner/home3-banner-4.jpg') }}" alt="Banner">
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 padding-0">
                        <div class="banner-item">
                            <div class="text">
                                <h3>Tomato and Pepper</h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip</p>
                            </div>
                            <div class="image-mask"></div>
                            <img class="img-responsive" src="{{ asset('assetsuser/img/banner/home3-banner-5.jpg') }}" alt="Banner">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
