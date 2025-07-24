@extends('layouts.admin-app')
@section('title', 'Edit Consultation Summary ' . $data->name )
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Edit Consultation Summary - {{ $data->id }}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Consultation Summary</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Consultation Summary - {{ $data->id }}</li>
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
                    <h4 class="box-title">Edit Consultation Summary form</h4>
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
                <form class="form" enctype="multipart/form-data" method="post" action="{{ route('consultation-summary.update', $data->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="row">
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
                                    <label>Certification Type <strong>*</strong></label>
                                    <select name="certification_category_id" id="certification_category_id" class="form-control select2" required>
                                        <option value="">Select Certification Type</option>
                                        @foreach($certification_category as $key => $value)
                                        <option value="{{ $value->id }}" {{ $value->id == $data->certification_category_id ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Certification Body <strong>*</strong></label>
                                    <select name="certification_body_id" id="certification_body_id" class="form-control select2" required>
                                        <option value="">Select Certification Body</option>
                                        @foreach($certification_body as $key => $value)
                                        <option value="{{ $value->id }}" {{ $value->id == $data->certification_body_id ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Consultant <strong>*</strong></label>
                                    <select name="consultant_id" id="consultant_id" class="form-control select2" required>
                                        <option value="">Select Consultant</option>
                                        @foreach($consultants as $key => $value)
                                        <option value="{{ $value->id }}" {{ $value->id == $data->consultant_id ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Audit Type <strong>*</strong></label>
                                    <input type="text" name="audit_type" id="audit_type" class="form-control" value="{{ $data->audit_type }}" required>
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
@push('script')

@endpush