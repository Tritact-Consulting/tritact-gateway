@extends('layouts.admin-app')
@section('title', 'Edit Role')
@section('content')
<div class="breadcrumb__area">
    <div class="breadcrumb__wrapper mb-25">
        <nav>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Roles</li>
                <li class="breadcrumb-item active" aria-current="page">Edit Role - {{ $data->name }}</li>
            </ol>
        </nav>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Edit Role form</h4>
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
				<form class="form" method="post" action="{{ route('roles.update', $data->id) }}">
					<div class="box-body">
						@csrf
						@method('PUT')
						<div class="row gy-3">
							<div class="col-12">
								<div class="form-group">
									<label class="form-label">Name <strong>*</strong></label>
									<input type="text" class="form-control" name="name" required value="{{ old('name', $data->name) }}">
								</div>
							</div>
							<div class="col-12">
								<label class="form-label">Permission <strong>*</strong></label>
								<ul class="role-wrapper">
								@foreach($permission as $key => $value)
									<li>
										<input class="form-check-input" name="permission[]" value="{{ $value->name }}" type="checkbox" id="basic_checkbox_{{$key}}" {{ in_array($value->name, $rolePermissions) ? 'checked' : '' }} />
										<label for="basic_checkbox_{{$key}}">{{ $value->name }}</label>
									</li>
								@endforeach
								</ul>
							</div>
							<div class="col-12">
								<button type="submit" class="btn btn-primary">Update Role</button>
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