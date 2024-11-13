@extends('layouts.user-app')
@section('title', 'Add User')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Add User</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">User</li>
                        <li class="breadcrumb-item active" aria-current="page">Add User</li>
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
                <!-- /.box-header -->
                <form class="form" enctype="multipart/form-data" method="post" action="{{ route('user.store') }}">
                    @csrf                    
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name <strong>*</strong></label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>E-mail <strong>*</strong></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password <strong>*</strong></label>
                                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password <strong>*</strong></label>
                                    <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status <strong>*</strong></label>
                                    <select class="form-control" name="status" required>
                                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Active</option>
                                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Deactive</option>
                                    </select>                                   
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <h4>Permission</h4>
                                <ul class="permission">
                                    <li>
                                        <div class="form-group mb-0">
                                            <div class="checkbox">
                                                <input class="form-check-input all-check" type="checkbox" name="users" id="users" {{ old('users') ? 'checked' : '' }}>
                                                <label for="users">Users</label>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <ul>
                                            <li>
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <input value="view user" class="form-check-input" type="checkbox" name="permission[]" id="view-user" {{ old('view-user') ? 'checked' : '' }}>
                                                        <label for="view-user">View User</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <input value="create user" class="form-check-input" type="checkbox" name="permission[]" id="create-user" {{ old('view-user') ? 'checked' : '' }}>
                                                        <label for="create-user">Create User</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <input value="update user" class="form-check-input" type="checkbox" name="permission[]" id="update-user" {{ old('update-user') ? 'checked' : '' }}>
                                                        <label for="update-user">Update User</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <input value="delete user" class="form-check-input" type="checkbox" name="permission[]" id="delete-user" {{ old('delete-user') ? 'checked' : '' }}>
                                                        <label for="delete-user">Delete User</label>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul class="permission">
                                    <li>
                                        <div class="form-group mb-0">
                                            <div class="checkbox">
                                                <input class="form-check-input all-check" type="checkbox" name="documents" id="documents" {{ old('documents') ? 'checked' : '' }}>
                                                <label for="documents">Documents</label>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <ul>
                                            <li>
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <input value="view document" class="form-check-input" type="checkbox" name="permission[]" id="view-document" {{ old('view-document') ? 'checked' : '' }}>
                                                        <label for="view-document">View Document</label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="form-group">
                                                    <div class="checkbox">
                                                        <input value="download document" class="form-check-input" type="checkbox" name="permission[]" id="document-document" {{ old('document-document') ? 'checked' : '' }}>
                                                        <label for="download-document">Download Document</label>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                        <i class="ti-save-alt"></i> Save User
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
        $('.all-check').click(function(){
            if($(this).prop('checked')){
                $(this).parent().parent().parent().next().find('input').each(function(){
                    $(this).prop('checked', true);
                });
            }else{
                $(this).parent().parent().parent().next().find('input').each(function(){
                    $(this).prop('checked', false);
                });
            }
        })
    });
</script>
@endpush