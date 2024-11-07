@extends('layouts.admin-app')
@section('title', $data->name . ' Users')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">{{ $data->name }} User List</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">{{ $data->name }}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $data->name }} User List</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
<section class="content">
    <div class="row">
        <div class="col-xxxl-4 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <img class="mr-10 rounded-circle avatar avatar-xl b-2 border-primary" src="{{ asset($data->company->logo) }}" alt="{{ $data->name }}" style="object-fit: cover;">
                        <div>
                            <h4 class="mb-0">{{ $data->name }}</h4>
                            <span class="font-size-14 text-info">{{ $data->email }}</span>
                        </div>
                    </div>
                </div>
                <div class="box-body border-bottom">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0">Director name: {{ $data->company->director_name }}</h6>
                        <h6 class="mb-0">Short Name: {{ $data->company->short_name }}</h6>
                        <h6 class="mb-0">Director name: {{ $data->company->director_name }}</h6>
                    </div>
                </div>
                <div class="box-body border-bottom">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-map-marker mr-10 font-size-24"></i>
                        <h4 class="mb-0 text-black">1623 E Updahl Ct, Harrison, ID, 83833</h4>
                    </div>
                </div>
                <div class="box-body">
                    <h4 class="mb-10">Order Nots</h4>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                </div>
            </div>
            <div class="row">

            </div>
        </div>
    </div>
</section>
@endsection
