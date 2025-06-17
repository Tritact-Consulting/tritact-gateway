@extends('layouts.admin-app')
@section('title', 'Assigned Audit - ' . $data->audit_name)
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Assigned Audit - {{ $data->audit_name }}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Assigned Audit</li>
                        <li class="breadcrumb-item active" aria-current="page">Assigned Audit - {{ $data->audit_name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-12">
			<div class="box">
                <form action="{{ route('assigned-audit.update', $data->id) }}" method="post">
			        <div class="box-body">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Company <strong>*</strong></label>
                                    <input type="text" value="{{ $data->company->name }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Certification Type <strong>*</strong></label>
                                    <input type="text" value="{{ $data->category->name }}" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Audit Name <strong>*</strong></label>
                                    <input type="text" class="form-control" value="{{ $data->audit_name }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Audit Start Date <strong>*</strong></label>
                                    <input type="date" class="form-control" value="{{ $data->audit_start_date }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Audit End Date <strong>*</strong></label>
                                    <input type="date" class="form-control" value="{{ $data->audit_end_date }}" readonly>
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
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline"><i class="ti-save-alt"></i> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection