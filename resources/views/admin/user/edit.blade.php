@extends('layouts.admin-app')
@section('title', 'Edit User')
@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush
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
							<div class="col-md-12">
							@if($errors->any())
								{!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
							@endif
							@if(session()->has('success'))
								<div class="alert alert-success">
									{{ session()->get('success') }}
								</div>
							@endif
							</div>
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
									<select name="role[]" id="role" class="form-control select2" multiple required>
										@foreach($roles as $key => $value)
										<option value="{{ $value->name }}" {{ in_array($value->name, $data->getRole()) ? 'selected' : '' }}>{{ $value->name }}</option>
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
						</div>
						<div class="row" id="attendance-fields" style="display:none;">
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Shift Start Timing</label>
									<input type="time" class="form-control" name="shift_start" id="shift_start" value="{{ $data->shift_start }}">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Shift End Timing</label>
									<input type="time" class="form-control" name="shift_end" id="shift_end" value="{{ $data->shift_end }}">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label class="form-label">Shift Timezone</label>
									<select name="timezone" id="timezone" class="form-control select2">
										@foreach(timezone_identifiers_list() as $tz)
										<option value="{{ $tz }}" {{ old('timezone', $data->timezone ?? 'UTC') === $tz ? 'selected' : '' }}>
											{{ $tz }}
										</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="form-label">Company List</label>
									<select name="company[]" id="company" class="select2" multiple>
										<option value="All">All</option>
										@foreach($company as $key => $value)
										<option value="{{ $value->id }}"
										{{ in_array($value->id, $assignedUserIds ?? []) ? 'selected' : '' }}
										>{{ $value->name }}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="box-footer">
						<div class="row">
							<div class="col-12">
								<button type="submit" class="btn btn-rounded btn-primary btn-outline">Update User</button>
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

@push('script')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
	flatpickr("#shift_start", {
		enableTime: true,
		noCalendar: true,
		dateFormat: "H:i", // 24-hour format
		time_24hr: true
	});
	flatpickr("#shift_end", {
		enableTime: true,
		noCalendar: true,
		dateFormat: "H:i", // 24-hour format
		time_24hr: true
	});
</script>
<script>
	$(document).ready(function () {
		const $roleSelect = $('#role');
		const $attendanceFields = $('#attendance-fields');

		function toggleAttendanceFields() {
			let selectedRoles = $roleSelect.val() || [];
			if (selectedRoles.includes('attendance')) {
				$attendanceFields.show();
			} else {
				$attendanceFields.hide();
			}
		}

		// Listen to select2 change
		$roleSelect.on('change', toggleAttendanceFields);

		// Trigger on page load
		toggleAttendanceFields();
	});
</script>
@endpush