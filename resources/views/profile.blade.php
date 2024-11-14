@extends('layouts.user-app')
@section('title', 'Profile')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Profile</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Profile</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Profile form</h4>
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
                <form class="form" enctype="multipart/form-data" method="post" action="{{ route('profile.update') }}">
                    @csrf                    
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name <strong>*</strong></label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name', Auth::user()->name) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>E-mail <strong>*</strong></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email', Auth::user()->email) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password">
                                                <i class="fa fa-fw field-icon fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password">
                                                <i class="fa fa-fw field-icon fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                        <i class="ti-save-alt"></i> Update Profile
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.box -->			
        </div> 
    </div>
</section>
@endsection
@push('script')
<script>
    $(document).ready(function(){
        $(".toggle-password").click(function() {
            $(this).find('i').toggleClass("fa-eye fa-eye-slash");
            var input = $(this).parent().parent().parent().find('input');
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    })    
</script>
@endpush