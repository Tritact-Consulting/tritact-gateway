@extends('layouts.admin-app')
@section('title', $data->name . ' Edit Users' . $user->name)
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">{{ $data->name }} Edit User List - {{ $user->name }}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">{{ $data->name }}</li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $data->name }} Edit User List - {{ $user->name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
<section class="content" style="min-height: auto;">
    <div class="row">
        <div class="col-xxxl-4 col-12">
            <div class="box mb-0">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <img class="mr-10 rounded-circle avatar avatar-xl b-2 border-primary" src="{{ asset($data->company->logo) }}" alt="{{ $data->name }}" style="object-fit: cover;">
                        <div>
                            <h4 class="mb-0">{{ $data->name }}</h4>
                            <span class="font-size-14 text-info">{{ $data->email }}</span>
                        </div>
                    </div>
                </div>
                <div class="box-body border-bottom pt-0">
                    <div class="">
                        <h6 class="mb-2">Director name: {{ $data->company->director_name }}</h6>
                        <h6 class="mb-2">Short Name: {{ $data->company->short_name }}</h6>
                        <h6 class="mb-0">Total Users: <span class="badge badge-info badge-sm">{{ $data->company->total_user }}</span></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Edit User form</h4>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger m-20 mb-0">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul class="mt-2 mb-2">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- /.box-header -->
                <form class="form" enctype="multipart/form-data" method="post" action="{{ route('company.user.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="company_id" id="company_id" value="{{ $data->id }}">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name <strong>*</strong></label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>E-mail <strong>*</strong></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="button" class="btn btn-rounded btn-warning btn-outline mr-1">
                        <i class="ti-trash"></i> Cancel
                        </button>
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                        <i class="ti-save-alt"></i> Save
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.box -->			
        </div> 
    </div>
</section>
@endsection