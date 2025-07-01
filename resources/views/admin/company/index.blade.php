@extends('layouts.admin-app')
@section('title', 'Company List')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Company List</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Company</li>
                        <li class="breadcrumb-item active" aria-current="page">Company list</li>
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
        <div class="col-xxxl-4 col-xl-4 col-lg-6 col-12">
            <div class="box food-box">
                <div class="box-body text-center">
                    <div class="menu-item">
                        @if($value->company != null)
                        <img src="{{ asset($value->company->logo) }}" class="img-fluid w-p75" alt="">
                        @endif
                    </div>
                    <div class="menu-details text-center">
                        <h4 class="mt-20 mb-10">
                            @if($value->company->company_id) {{ $value->company->company_id }} - @endif {{ $value->name }}
                        </h4>
                        <p class="mb-5">{{ $value->email }}</p>
                        @foreach($value->tags as $tag)
                        <span class="badge badge-info mb-10">{{ $tag->name }}</span>
                        @endforeach
                        <hr style="margin-top: 4px;">
                        @foreach($value->categories as $category)
                        <span class="badge badge-info mb-10">{{ $category->name }}</span>
                        @endforeach
                    </div>
                    <div class="act-btn d-flex justify-content-between">
                        @can('edit company')
                        <div class="text-center mx-5">
                            <a href="{{ route('company.edit', $value->id) }}" class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-5"><i class="fa fa-edit"></i></a>
                            <small class="d-block">Edit</small>
                        </div>
                        @endcan
                        @can('delete company')
                        <div class="text-center mx-5">
                            <form action="{{ route('company.destroy',$value->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="waves-effect waves-circle btn btn-circle btn-primary-light btn-xs mb-5"><i class="fa fa-trash"></i></button>
                                <small class="d-block">Delete</small>
                            </form>
                        </div>
                        @endcan
                        @can('assign company user')
                        <div class="text-center mx-5">
							<a href="{{ route('company.user', $value->id) }}" class="waves-effect waves-circle btn btn-circle btn-info-light btn-xs mb-5"><i class="fa fa-users"></i></a>
							<small class="d-block">Users</small>
						</div>
                        @endcan
                        @can('login company')
						<div class="text-center mx-5">
                            <a href="{{ route('company.dashboard', $value->id) }}" class="waves-effect waves-circle btn btn-circle btn-success-light btn-xs mb-5"><i class="fa fa-lock"></i></a>
                            <small class="d-block">Login</small>
                        </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection
