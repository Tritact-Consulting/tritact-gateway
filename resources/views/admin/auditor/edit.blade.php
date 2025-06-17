@extends('layouts.admin-app')
@section('title', 'Edit Auditor ' . $data->name )
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Edit Auditor - {{ $data->name }}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Auditor</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Auditor - {{ $data->name }}</li>
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
                    <h4 class="box-title">Edit Auditor form</h4>
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
                <form class="form" enctype="multipart/form-data" method="post" action="{{ route('auditor.update', $data->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                    <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name <strong>*</strong></label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name', $data->name) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email <strong>*</strong></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email', $data->email) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone <strong>*</strong></label>
                                    <input type="text" class="form-control" name="phone" value="{{ old('phone', $data->phone) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Certification Body <strong>*</strong></label>
                                    <select name="certification_body_id" id="certification_body_id" class="form-control">
                                        <option value="">Select Certification Body</option>
                                        @foreach($body as $key => $value)
                                        <option value="{{ $value->id }}" {{ $data->certification_body_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Certification Type <strong>*</strong></label>
                                    <select class="form-control select2" multiple name="certification_category[]" required>
                                        @foreach($category as $key => $value)
                                        <option value="{{ $value->id }}" {{ in_array($value->id, $data->category->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
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
