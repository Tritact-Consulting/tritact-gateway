@extends('layouts.admin-app')
@section('title', 'Edit Company ' . $data->name )
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Edit Company - {{ $data->name }}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Company</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Company - {{ $data->name }}</li>
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
                    <h4 class="box-title">Edit Company form</h4>
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
                <form class="form" enctype="multipart/form-data" method="post" action="{{ route('company.update', $data->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Logo <strong>*</strong></label>
                                    <input type="file" name="logo" class="form-control dropify" data-default-file="{{ asset($data->company->logo) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_id">Company ID</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <select name="prefix_company_id" class="input-group-text" id="basic-addon1">
                                                <option value="TCA" title="Tritact Clients" {{ $data->company->prefix_company_id == 'TCA' ? 'selected' : '' }}>TCA</option>
                                                <option value="PCA" title="Private Clients" {{ $data->company->prefix_company_id == 'PCA' ? 'selected' : '' }}>PCA</option>
                                            </select>
                                        </div>
                                        <input type="text" name="company_id" id="company_id" class="form-control" value="{{ old('company_id', $data->company->company_id) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name <strong>*</strong></label>
                                    <input type="text" class="form-control" name="name" value="{{ $data->name }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>E-mail <strong>*</strong></label>
                                    <input type="email" class="form-control" name="email" value="{{ $data->email }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password (Leave Empty)</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password">
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password">
                                                <i class="fa fa-fw field-icon fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password (Leave Empty)</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password_confirmation">
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password">
                                                <i class="fa fa-fw field-icon fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Director name <strong>*</strong></label>
                                    <input type="text" class="form-control" name="director_name" value="{{ $data->company->director_name }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Short name <strong>*</strong></label>
                                    <input type="text" class="form-control" name="short_name" value="{{ $data->company->short_name }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Total Users <strong>*</strong></label>
                                    <input type="number" class="form-control" name="total_user" value="{{ $data->company->total_user }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $data->company->address) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status <strong>*</strong></label>
                                    <select class="form-control" name="status" required>
                                        <option value="0" {{ $data->company->status == 0 ? 'selected' : '' }}>Active</option>
                                        <option value="1" {{ $data->company->status == 1 ? 'selected' : '' }}>Deactive</option>
                                    </select>                                   
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tags <strong>*</strong></label>
                                    <select class="form-control select2" name="tags[]" multiple="multiple" required>
                                        <option value="all">All</option>
                                        @foreach($tags as $key => $value)
                                        <option value="{{ $value->id }}" {{ in_array($value->id, $data->tags->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Categories <strong>*</strong></label>
                                    <select class="form-control select2" name="categories[]" multiple="multiple">
                                        <option value="all">All</option>
                                        @foreach($categories as $key => $value)
                                        <option value="{{ $value->id }}" {{ in_array($value->id, $data->categories->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="version">Version <strong>*</strong></label>
                                    <input type="text" name="version" id="version" class="form-control" value="{{ old('version', $data->company->version) }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="issue_date">Issue Date <strong>*</strong></label>
                                    <input type="date" name="issue_date" id="issue_date" class="form-control" value="{{  old('issue_data', date('Y-m-d', strtotime($data->company->issue_date))) }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="policy_date">Policy Issue Date</label>
                                    <input type="date" name="policy_date" id="policy_date" class="form-control" value="{{ $data->company->policy_date != null ? date('Y-m-d', strtotime($data->company->policy_date)) : '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="website">Website <strong>*</strong></label>
                                    <input type="text" name="website" id="website" class="form-control" value="{{ old('website', $data->company->website) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="registration_num">Registration Number <strong>*</strong></label>
                                    <input type="text" name="registration_num" id="registration_num" class="form-control" value="{{ old('registration_num', $data->company->registration_num) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone_num">Phone Number <strong>*</strong></label>
                                    <input type="text" name="phone_num" id="phone_num" class="form-control" value="{{ old('phone_num', $data->company->phone_num) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_email">Company Email <strong>*</strong></label>
                                    <input type="email" name="company_email" id="company_email" class="form-control" value="{{ old('company_email', $data->company->company_email) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="logo_width">Logo Width <strong>*</strong>
                                        <div class="tooltip">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span class="tooltiptext">If you have same size of logo (width and height are equal) then width = 120<br>If your logo width is greater then your logo height than width = 100<br>If your logo height is greater then your logo width than width = 70</span>
                                        </div>
                                    </label>
                                    <input type="number" name="logo_width" id="logo_width" class="form-control" value="{{ old('logo_width', $data->company->logo_width) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="logo_height">Logo Height <strong>*</strong>
                                        <div class="tooltip right-tooltip">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span class="tooltiptext">If you have same size of logo (width and height are equal) then height = 120<br>If your logo width is greater then your logo height than height = 70<br>If your logo height is greater then your logo width than height = 100</span>
                                        </div>
                                    </label>
                                    <input type="number" name="logo_height" id="logo_height" class="form-control" value="{{ old('logo_height', $data->company->logo_height) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="adding_certification">Adding Certification</label>
                                    <select name="adding_certification" id="adding_certification" class="form-control">
                                        <option value="0">NO</option>
                                        <option value="1">YES</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="referred_by">Partner</label>
                                    <select name="referred_by" id="referred_by" class="form-control">
                                        <option value="">Select Partner</option>
                                        @foreach($partners as $key => $value)
                                        <option value="{{ $value->id }}" {{ $data->company->referred_by == $value->id ? 'selected' : ''}}>{{ $value->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                        <i class="ti-save-alt"></i> Save
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
        $(".toggle-password").click(function() {
            $(this).find('i').toggleClass("fa-eye fa-eye-slash");
            var input = $(this).parent().parent().parent().find('input');
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    });
</script>
@endpush
