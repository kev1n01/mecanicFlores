@section('title','Dashboard')
<div>
    <div class="row">
        <div class="col-lg-6 col-xxl-3 m-b-30">
            <div class="card card-statistics h-100 mb-0">
                <div class="card-header">
                    <h4 class="card-title">{{ $chart1->options['chart_title'] }}</h4>
                </div>
                <div class="card-body pt-0">
                    <div class="apexchart-wrapper">
{{--                        <div id="jobportaldemo3"></div>--}}
                        {!! $chart1->renderHtml() !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xxl-3 m-b-30">
            <div class="card card-statistics h-100 mb-0 widget-income-list">
                <div class="card-body d-flex align-itemes-center">
                    <div class="media align-items-center w-100">
                        <div class="text-left">
                            <h3 class="mb-0">{{ $customers }} </h3>
                            <span>Cliente</span>
                        </div>
                        <div class="img-icon bg-pink ml-auto">
                            <i class="ti ti-user text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex align-itemes-center">
                    <div class="media align-items-center w-100">
                        <div class="text-left">
                            <h3 class="mb-0">{{$products}} </h3>
                            <span>Productos</span>
                        </div>
                        <div class="img-icon bg-primary ml-auto">
                            <i class="fa fa-th text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex align-itemes-center">
                    <div class="media align-items-center w-100">
                        <div class="text-left">
                            <h3 class="mb-0">{{$purchases}} </h3>
                            <span>Compras</span>
                        </div>
                        <div class="img-icon bg-orange ml-auto">
                            <i class="fa fa-shopping-basket text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex align-itemes-center">
                    <div class="media align-items-center w-100">
                        <div class="text-left">
                            <h3 class="mb-0">{{$sales}} </h3>
                            <span>Ventas</span>
                        </div>
                        <div class="img-icon bg-info ml-auto">
                            <i class="fa fa-shopping-cart text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-6 m-b-30">
            <div class="card card-statistics site-visitor h-100 mb-0">
                <div class="card-header">
                    <h4 class="card-title">{{ $chart2->options['chart_title'] }}</h4>
                </div>
                <div class="card-body pb-0">
                    <div class="apexchart-wrapper">
{{--                        <div id="jobportaldemo4" class="chart-fit"></div>--}}
                        {!! $chart2->renderHtml() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!}
    {!! $chart2->renderJs() !!}
@endpush
