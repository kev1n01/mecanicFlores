@section('title','Dashboard')
<div>
    <h2>the {{ Auth()->user()->roles()->first()->name ?? '' }}, to home</h2>
    <div class="row">
        <div class="col-lg-6 col-xxl-3 m-b-30">
            <div class="card card-statistics h-100 mb-0">
                <div class="card-header">
                    <h4 class="card-title">Job Seekers/Providers</h4>
                </div>
                <div class="card-body pt-0">
                    <div class="apexchart-wrapper">
                        <div id="jobportaldemo3"></div>
                    </div>
                    <div class="row text-center justify-content-center">
                        <div class="col ml-3">
                            <h4 class="mb-0">45%</h4>
                            <span> <i class="fa fa-square pr-1 text-primary"></i> Job Seekers </span>
                        </div>
                        <div class="col">
                            <h4 class="mb-0">55%</h4>
                            <span> <i class="fa fa-square pr-1 text-info"></i> Job Providers </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xxl-3 m-b-30">
            <div class="card card-statistics h-100 mb-0 widget-income-list">
                <div class="card-body d-flex align-itemes-center">
                    <div class="media align-items-center w-100">
                        <div class="text-left">
                            <h3 class="mb-0">45.8k </h3>
                            <span>Pending Users</span>
                        </div>
                        <div class="img-icon bg-pink ml-auto">
                            <i class="ti ti-user text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex align-itemes-center">
                    <div class="media align-items-center w-100">
                        <div class="text-left">
                            <h3 class="mb-0">65.4k </h3>
                            <span>New Users</span>
                        </div>
                        <div class="img-icon bg-primary ml-auto">
                            <i class="ti ti-tag text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex align-itemes-center">
                    <div class="media align-items-center w-100">
                        <div class="text-left">
                            <h3 class="mb-0">78.2k </h3>
                            <span>Deleted Users</span>
                        </div>
                        <div class="img-icon bg-orange ml-auto">
                            <i class="ti ti-wallet text-white"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex align-itemes-center">
                    <div class="media align-items-center w-100">
                        <div class="text-left">
                            <h3 class="mb-0">65.3k </h3>
                            <span>Active Users</span>
                        </div>
                        <div class="img-icon bg-info ml-auto">
                            <i class="ti ti-slice text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-6 m-b-30">
            <div class="card card-statistics site-visitor h-100 mb-0">
                <div class="card-header">
                    <h4 class="card-title">Site Visitors</h4>
                </div>
                <div class="card-body pb-0">
                    <div class="row">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <h2 class="mb-0">154,65</h2>
                            <span>Total visit</span>
                        </div>
                        <div class="col-sm-8 ml-auto">
                            <div class="row">
                                <div class="border-right col mr-4">
                                    <h4 class="mb-0">4,251</h4>
                                    <span> <i class="fa fa-square pr-1 text-pink"></i> Applicants </span>
                                </div>
                                <div class="border-right col mr-4">
                                    <h4 class="mb-0">6,578</h4>
                                    <span> <i class="fa fa-square pr-1 text-primary"></i> Interviews </span>
                                </div>
                                <div class="col">
                                    <h4 class="mb-0">2,654</h4>
                                    <span> <i class="fa fa-square pr-1 text-light"></i> Forwards </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="apexchart-wrapper">
                        <div id="jobportaldemo4" class="chart-fit"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
