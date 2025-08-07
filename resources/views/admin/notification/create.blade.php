@extends('layouts.admin-app')
@section('title', 'Add Notification')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Add Notification</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Notifications</li>
                        <li class="breadcrumb-item active" aria-current="page">Add Notification</li>
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
                    <h4 class="box-title">Add Notification form</h4>
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
                <form class="form" enctype="multipart/form-data" method="post" action="{{ route('notification-message.store') }}">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Subject <strong>*</strong></label>
                                    <input type="text" class="form-control" name="subject" value="{{ old('subject') }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Message <strong>*</strong></label>
                                    <textarea name="message" id="message" class="form-control" required>{{ old('message') }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                @foreach ($roles as $role)
                                @if ($role->users->isNotEmpty())
                                    <div style="margin-bottom: 10px;">
                                        <!-- Role Checkbox -->
                                        <div>
                                            <input type="checkbox"
                                                class="form-check-input role-checkbox"
                                                id="role-{{ $role->id }}"
                                                data-role-id="{{ $role->id }}">

                                            <label class="form-label" for="role-{{ $role->id }}">
                                                <strong>All {{ ucfirst($role->name) }}</strong>
                                            </label>
                                        </div>

                                        <!-- Users under this Role -->
                                        <ul class="role-wrapper notification-role-wrapper">
                                            @foreach ($role->users as $user)
                                                <li>
                                                    <input class="form-check-input user-checkbox role-{{ $role->id }}"
                                                        type="checkbox"
                                                        name="users[]"
                                                        value="{{ $user->id }}"
                                                        id="user-{{ $user->id }}">

                                                    <label for="user-{{ $user->id }}">{{ $user->name }}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            @endforeach

                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline"><i class="ti-save-alt"></i> Save</button>
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
    document.addEventListener('DOMContentLoaded', function () {
        // For each role checkbox
        document.querySelectorAll('.role-checkbox').forEach(function (roleCheckbox) {
            roleCheckbox.addEventListener('change', function () {
                const roleId = this.dataset.roleId;
                const userCheckboxes = document.querySelectorAll('.role-' + roleId);

                userCheckboxes.forEach(function (checkbox) {
                    checkbox.checked = roleCheckbox.checked;
                });
            });
        });
    });
</script>
@endpush
