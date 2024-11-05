@extends('layouts.admin-app')
@section('title', 'Dashboard')
@section('content')
<!-- Main content -->
<section class="content">
    <d[iv class="row">
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <img src="../images/food/online-order-1.png" class="w-80 mr-20" alt="" />
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">89</h2>
                            <p class="text-fade mb-0">Total Order</p>
                            <p class="font-size-12 mb-0 text-success"><span class="badge badge-pill badge-success-light mr-5"><i class="fa fa-arrow-up"></i></span>3% (15 Days)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <img src="../images/food/online-order-2.png" class="w-80 mr-20" alt="" />
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">899</h2>
                            <p class="text-fade mb-0">Total Delivered</p>
                            <p class="font-size-12 mb-0 text-success"><span class="badge badge-pill badge-success-light mr-5"><i class="fa fa-arrow-up"></i></span>8% (15 Days)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <img src="../images/food/online-order-3.png" class="w-80 mr-20" alt="" />
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">59</h2>
                            <p class="text-fade mb-0">Total Canceled</p>
                            <p class="font-size-12 mb-0 text-primary"><span class="badge badge-pill badge-primary-light mr-5"><i class="fa fa-arrow-down"></i></span>2% (15 Days)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-start">
                        <div>
                            <img src="../images/food/online-order-4.png" class="w-80 mr-20" alt="" />
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">$789k</h2>
                            <p class="text-fade mb-0">Total Revenue</p>
                            <p class="font-size-12 mb-0 text-primary"><span class="badge badge-pill badge-primary-light mr-5"><i class="fa fa-arrow-down"></i></span>12% (15 Days)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-7 col-xl-6 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h4 class="box-title mb-0">Daily Revenue</h4>
                            <p class="mb-0 text-mute">Lorem ipsum dolor</p>
                        </div>
                        <div class="text-right">
                            <h3 class="box-title mb-0 font-weight-700">$ 154K</h3>
                            <p class="mb-0"><span class="text-success">+ 1.5%</span> than last week</p>
                        </div>
                    </div>
                    <div id="chart" class="mt-20"></div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-5 col-xl-6 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <h4 class="box-title">Customer Flow</h4>
                    <div class="d-md-flex d-block justify-content-between">
                        <div>
                            <h3 class="mb-0 font-weight-700">$2,780k</h3>
                            <p class="mb-0 text-primary"><small>In Restaurant</small></p>
                        </div>
                        <div>
                            <h3 class="mb-0 font-weight-700">$1,410k</h3>
                            <p class="mb-0 text-danger"><small>Online Order</small></p>
                        </div>
                    </div>
                    <div id="yearly-comparison"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
