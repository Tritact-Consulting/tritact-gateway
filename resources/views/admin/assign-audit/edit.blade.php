@extends('layouts.admin-app')
@section('title', 'Edit Assign Audit ' . $data->name )
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Edit Assign Audit - {{ $data->id }}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Assign Audit</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Assign Audit - {{ $data->id }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Edit Assign Audit form</h4>
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
                <form class="form" enctype="multipart/form-data" method="post" action="{{ route('assign-audit.update', $data->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>User <strong>*</strong></label>
                                    <select name="user_id" id="user_id" class="form-control select2" required>
                                        <option value="">Select User</option>
                                        @foreach($user as $key => $value)
                                        <option value="{{ $value->id }}" {{ $value->id == $data->user_id ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Company <strong>*</strong></label>
                                    <select name="company_id" id="company_id" class="form-control select2" required>
                                        <option value="">Select Company</option>
                                        @foreach($company as $key => $value)
                                        <option value="{{ $value->id }}" {{ $value->id == $data->company_id ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Certification Category <strong>*</strong></label>
                                    <select name="certification_category_id" id="certification_category_id" class="form-control select2" required>
                                        <option value="">Select Certification Category</option>
                                        @foreach($certification_category as $key => $value)
                                        <option value="{{ $value->id }}" {{ $value->id == $data->certification_category_id ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Audit Name <strong>*</strong></label>
                                    <input type="text" name="audit_name" id="audit_name" class="form-control" value="{{ $data->audit_name }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Audit Start Date <strong>*</strong></label>
                                    <input type="date" name="audit_start_date" id="audit_start_date" class="form-control" value="{{ $data->audit_start_date }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Audit End Date <strong>*</strong></label>
                                    <input type="date" name="audit_end_date" id="audit_end_date" class="form-control" value="{{ $data->audit_end_date }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status <strong>*</strong></label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Upcoming</option>
                                        <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>In progress</option>
                                        <option value="2" {{ $data->status == 2 ? 'selected' : '' }}>Completed</option>
                                        <option value="3" {{ $data->status == 3 ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
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
