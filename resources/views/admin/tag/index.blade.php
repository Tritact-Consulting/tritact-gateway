@extends('layouts.admin-app')
@section('title', 'Tag List')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Tag List</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Tag</li>
                        <li class="breadcrumb-item active" aria-current="page">Tag list</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
<section class="content">
    <div class="row">
        @foreach($data as $key => $value)
        <div class="col-xxxl-3 col-xl-4 col-lg-6 col-12">
            <div class="box food-box mt-10">
                <div class="box-body text-center">
                    <div class="menu-details text-center">
                        <h4 class="mb-10">{{ $value->name }}</h4>
                        <p>{{ $value->created_at->format('d M, Y') }}</p>
                    </div>
                    <div class="act-btn d-flex justify-content-between">
                        <div class="text-center mx-5">
                            <a href="#" class="waves-effect waves-circle btn btn-circle btn-success-light btn-xs mb-5"><i class="fa fa-eye-slash"></i></a>
                            <small class="d-block">View</small>
                        </div>
                        <div class="text-center mx-5">
                            <a href="{{ route('tag.edit', $value->id) }}" class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-5"><i class="fa fa-edit"></i></a>
                            <small class="d-block">Edit</small>
                        </div>
                        <div class="text-center mx-5">
                            <a href="#" class="waves-effect waves-circle btn btn-circle btn-primary-light btn-xs mb-5"><i class="fa fa-trash"></i></a>
                            <small class="d-block">Delete</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
