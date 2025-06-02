@extends('layouts.admin-app')
@section('title', 'Edit User')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Edit User - {{ $data->name }}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Users</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit User - {{ $data->name }}</li>
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
                    <h4 class="box-title">Add User form</h4>
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
				<form class="form" method="post" action="{{ route('users.update', $data->id) }}">
					@csrf
					@method('PUT')
					<div class="box-body">
						<div class="row">
							@if($errors->any())
								{!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
							@endif
							@if(session()->has('success'))
								<div class="alert alert-success">
									{{ session()->get('success') }}
								</div>
							@endif
							
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Name <strong>*</strong></label>
									<input type="text" class="form-control" name="name" value="{{ old('name', $data->name) }}" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">E-mail <strong>*</strong></label>
									<input type="email" class="form-control" name="email" value="{{ old('email', $data->email) }}" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Role <strong>*</strong></label>
									<select name="role" id="role" class="form-control" required>
										@foreach($roles as $key => $value)
										<option value="{{ $value->name }}" {{ $data->getRole() == $value->name ? 'selected' : '' }}>{{ $value->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="form-label">Password</label>
									<input type="text" class="form-control" name="password">
								</div>
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-primary">Update User</button>
							</div>
						</div>
					</div>
				</form>
				<!-- /.box -->			
			</div>
		</div>
	</div>
</section>
@endsection

@push('scripts')
@endpush