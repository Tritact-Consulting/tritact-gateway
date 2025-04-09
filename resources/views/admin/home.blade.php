@extends('layouts.admin-app')
@section('title', 'Dashboard')
@section('content')
<!-- Main content -->
<section class="content">
    <d[iv class="row">
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-building mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $company_count }}</h2>
                            <p class="text-fade mb-0">Total Company</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-tags mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $tag_count }}</h2>
                            <p class="text-fade mb-0">Total Tags</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-users mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $user_count }}</h2>
                            <p class="text-fade mb-0">Total Users</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-th-list mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $document_count }}</h2>
                            <p class="text-fade mb-0">Total Documents</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-book mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $guide_count }}</h2>
                            <p class="text-fade mb-0">Total Guides</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@endsection
