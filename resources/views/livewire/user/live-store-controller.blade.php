@section('title','Tienda Enetero')
<div    >
    <div class="container " style="padding-top: 50px; !important;">
        <div class="row">
            <!-- Sidebar -->
            <div id="left-column" class="sidebar col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <!-- Block - Filter -->
                <div class="block product-filter">
                    <h3 class="block-title">Categorias</h3>
                    <div class="block-content">
                        <div class="filter-item">
                            <div class="filter-content">
                                <ul style="max-height: 500px !important;">
                                    @foreach($categories as $c)
                                        <li>
                                            <label class="check" wire:click="addidcategory({{$c->id}})">
                                            <span class="custom-checkbox">
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </span>
                                                <a>{{$c->name}} <span class="quantity">({{$c->products_count}})</span></a>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block product-filter">
                    <h3 class="block-title">Marcas</h3>
                    <div class="block-content">
                        <div class="filter-item">
                            <div class="filter-content">
                                <ul style="max-height: 500px !important;">
                                    @foreach($brands as $b)
                                        <li>
                                            <label class="check" wire:click="addidbrand({{$b->id}})">
                                            <span class="custom-checkbox">
                                                <input type="checkbox">
                                                <span class="checkmark"></span>
                                            </span>
                                                <a>{{$b->name}} <span class="quantity">({{$b->products_count}})</span></a>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div id="center-column" class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                <div class="product-category-page">
                    <!-- Nav Bar -->
                    <div class="products-bar">
                        <div class="row">
                            <div class="col-md-6 col-xs-6">
                                <div class="gridlist-toggle" role="tablist">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#products-grid" data-toggle="tab" aria-expanded="true"><i class="fa fa-th-large"></i></a></li>
                                        <li><a href="#products-list" data-toggle="tab" aria-expanded="false"><i class="fa fa-bars"></i></a></li>
                                    </ul>
                                </div>

                                <div class="total-products">Hay {{$products->count()}} productos</div>
                            </div>

                            <div class="col-md-6 col-xs-6">

                                <div class="filter-bar">

                                    <div class="select pull-right" >
                                        <button wire:click="sortable('name')" class="form-control" style="width: 6.9 pc;">
                                            Por nombre
                                        </button>
                                    </div>
                                    <div class="select pull-right" >
                                        <button wire:click="sortable('sale_price')" class="form-control" style="width: 6.9 pc;">
                                            Por precio
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-content">
                        <!-- Products Grid -->
                        <div class="tab-pane active" id="products-grid">
                            <div class="products-block">
                                <div class="row">
                                    @foreach($products as $p)
                                    <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                        <div class="product-item">
                                            <div class="product-image">
                                                <img class="img-responsive" src="{{ asset('storage/'.$p->image_product) }}" alt="{{ $p->name }}"
                                                     style="height: 250px !important;" >
                                            </div>

                                            <div class="product-title">
                                                <p>
                                                    {{ $p->name }}
                                                </p>
                                                <p>
                                                    {{ $p->category_product->name }}
                                                </p>
                                                <p>
                                                    {{ $p->brand_product->name }}
                                                </p>
                                            </div>

                                            <div class="product-price">
                                                <span class="sale-price">S/. {{ $p->sale_price}}</span>
                                            </div>

                                            <div class="product-buttons">
                                                <a class="add-to-cart"  wire:click="addToCartStore({{$p->code}})">
                                                    <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Products List -->
                        <div class="tab-pane" id="products-list">
                            <div class="products-block layout-5">
                                @foreach($products as $p)
                                <div class="product-item">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                            <div class="product-image">
                                                <img class="img-responsive" src="{{ asset('storage/'.$p->image_product) }}" alt="{{ $p->name }}">
                                            </div>
                                        </div>

                                        <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                            <div class="product-info">
                                                <div class="product-title">
                                                    <p>
                                                        {{ $p->name }}
                                                    </p>
                                                    <p>
                                                        {{ $p->category_product->name }}
                                                    </p>
                                                    <p>
                                                        {{ $p->brand_product->name }}
                                                    </p>
                                                </div>

                                                <div class="product-price">
                                                    <span class="sale-price">S/. {{ $p->sale_price}}</span>
                                                </div>

                                                <div class="product-stock">
                                                    <i class="fa fa-{{$p->stock >= 1 ? 'check-square-o' : 'close'}}" aria-hidden="true"></i>
                                                    {{$p->stock >= 1 ? 'En stock' : 'Sin stock'}}
                                                </div>

                                                <div class="product-buttons">
                                                    <a class="add-to-cart" wire:click="addToCartStore({{$p->code}})">
                                                        <i class="fa fa-shopping-basket" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

                    <!-- Pagination Bar -->
                    <div class="pagination-bar">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="text">Mostrando {{$perPage}} productos en la página {{$page}} </div>
                            </div>
                            {{$products->links('layouts.user.pagination')}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
