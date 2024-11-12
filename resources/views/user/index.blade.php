@extends('layouts.user-app')
@section('title', 'User List')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">User List</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">User</li>
                        <li class="breadcrumb-item active" aria-current="page">User list</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
<section class="content">
    <div class="row">
        @foreach($data as $user)
        <div class="col-12 col-lg-4">
            <div class="box ribbon-box p-4">
                <div class="ribbon-two ribbon-two-success"><span>USER</span></div>
                <div class="box-header no-border p-0">				
                    <a href="#">
                        <img class="img-fluid" src="{{ asset('images/avatar-dummy.png') }}" alt="{{ $user->name }}" style="height: 100px;width: auto;margin: 0 auto;display: block;border: 2px solid #e5e5e5;border-radius: 50px;">
                    </a>
                </div>
                <div class="box-body p-0">
                    <div class="text-center">
                        <h4 class="my-10"><a href="#">{{ $user->name }}</a></h4>
                        <h6 class="user-info mt-0 mb-10 text-fade">{{ $user->email }}</h6>
                    </div>
                    <div class="act-btn d-flex justify-content-center">
                        @can('update user')
                        <div class="text-center mx-5">
                            <a href="{{ route('user.edit', $user->id) }}" class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-5"><i class="fa fa-edit"></i></a>
                            <small class="d-block">Edit</small>
                        </div>
                        @endcan
                        @can('delete user')
                        <div class="text-center mx-5">
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">                                
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="waves-effect waves-circle btn btn-circle btn-primary-light btn-xs mb-5"><i class="fa fa-trash"></i></button>
                                <small class="d-block">Delete</small>
                            </form>
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
