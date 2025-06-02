@extends('layouts.admin-app')
@section('title', 'Add Role')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Role List</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Roles</li>
                        <li class="breadcrumb-item active" aria-current="page">Add Role</li>
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
                    <h4 class="box-title">Add Role form</h4>
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
                <form class="form" method="post" action="{{ route('roles.store') }}">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label class="form-label">Name <strong>*</strong></label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-12">
								<label class="form-label">Permission <strong>*</strong></label>
								<ul class="role-wrapper">
								@foreach($permission as $key => $value)
									<li>
										<input class="form-check-input" name="permission[]" value="{{ $value->name }}" type="checkbox" id="basic_checkbox_{{$key}}"/>
										<label for="basic_checkbox_{{$key}}">{{ $value->name }}</label>
									</li>
								@endforeach
								</ul>
							</div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-rounded btn-primary btn-outline">Save Role</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')

@endpush