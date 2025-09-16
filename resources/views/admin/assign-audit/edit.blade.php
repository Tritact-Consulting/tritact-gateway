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
                                    <label>Auditor <strong>*</strong></label>
                                    <select name="auditor_id" id="auditor_id" class="form-control select2" required>
                                        <option value="">Select Auditor</option>
                                        @foreach($auditors as $key => $value)
                                        <option value="{{ $value->id }}" {{ $value->id == $data->auditor_id ? 'selected' : '' }}>{{ $value->name }}</option>
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Certificate Issued <strong>*</strong></label>
                                    <select name="completed" id="completed" class="form-control">
                                        <option value="0" {{ $data->completed == 0 ? 'selected' : '' }}>NO</option>
                                        <option value="1" {{ $data->completed == 1 ? 'selected' : '' }}>YES</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-body pt-0 {{ $data->completed == 1 ? 'show-certification-summary' : '' }}" id="certification-summary">
                        <div class="row">
                            <div class="col-md-12">
                                <hr class="mt-0">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Company <strong>*</strong></label>
                                    <select name="summary_company" id="summary_company" class="form-control select2">
                                        <option value="">Select Company</option>
                                        @foreach($user as $key => $value)
                                        <option value="{{ $value->id }}" {{ $value->id == ($data->company_certification != null ? $data->company_certification->user_id : $data->company_id) ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Certification Type<strong>*</strong></label>
                                    <select name="summary_certification_category" id="summary_certification_category" class="form-control select2">
                                        <option value="">Select Certification Type </option>
                                        @foreach($certification as $key => $value)
                                        <option value="{{ $value->id }}" {{ $value->id == ($data->company_certification != null ? $data->company_certification->certifications_id : $data->certification_category_id) ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Certification Body<strong>*</strong></label>
                                    <select name="summary_certification_body" id="summary_certification_body" class="form-control select2">
                                        <option value="">Select Certification Body </option>
                                        @foreach($certification_body as $key => $value)
                                        <option value="{{ $value->id }}" {{ $value->id == ($data->company_certification != null ? $data->company_certification->certification_body_id : $data->certification_body_id) ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Auditor</label>
                                    <select name="summary_auditor" id="summary_auditor" class="form-control">
                                        <option value="">Select Auditor</option>
                                        @foreach($auditors as $key => $value)
                                        <option value="{{ $value->id }}" {{ $value->id == ($data->company_certification != null ? $data->company_certification->auditor_id : $data->auditor_id) ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Audit Type <strong>*</strong></label>
                                    <input type="text" name="summary_certification_name" id="summary_certification_name" value="{{ $data->company_certification != null ? $data->company_certification->certification_name : $data->audit_type }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Issue Date</label>
                                    <input type="date" name="summary_issue_date" id="summary_issue_date" class="form-control" value="{{ $data->company_certification != null ? $data->company_certification->issue_date : '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Expiry Date</label>
                                    <input type="date" name="summary_expire_date" id="summary_expire_date" class="form-control" value="{{ $data->company_certification != null ? $data->company_certification->expire_date : '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Next Audit Due Date
                                        <div class="tooltip">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span class="tooltiptext">
                                                The next audit due date can either be the certificate’s expiry date or a scheduled audit date.<br>
                                                <strong>Example:</strong><br>
                                                • For certifications such as SafeContractor, CHAS, Constructionline, and Cyber Essentials, the next audit date is the same as the expiry date.<br>
                                                • For ISO certifications, since they involve one certification with three years of surveillance, the next audit date may differ from the expiry date.
                                            </span>
                                        </div>
                                    </label>
                                    <input type="date" name="summary_next_audit_due_date" id="summary_next_audit_due_date" class="form-control" value="{{ $data->company_certification != null ? $data->company_certification->next_audit_due_date : '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name="summary_username" id="summary_username" class="form-control" value="{{ $data->company_certification != null ? $data->company_certification->username : '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="summary_password" id="summary_password" class="form-control" value="{{ $data->company_certification != null ? $data->company_certification->password : '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Certification Number</label>
                                    <input type="text" name="summary_certification_number" id="summary_certification_number" class="form-control" value="{{ $data->company_certification != null ? $data->company_certification->certification_number : '' }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Previous Certification</label>
                                    <select name="summary_previous_certification" id="summary_previous_certification" class="form-control select2">

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
@push('script')
<script>
    $('#completed').change(function(){
        if($(this).val() == 0){
            $('#certification-summary').hide();
        }else{
            $('#certification-summary').show();
        }
    })
    $(document).ready(function(){
        $('#company').change(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'GET',
                url: "{{ route('get-certification-by-company') }}",
                data: {id: $(this).val()},
                success: function(data) {
                    if(data.success){
                        var select = document.getElementById('summary_previous_certification');
                        select.innerHTML = '<option value="">Select Previous Certification</option>';
                        var option_data = data.data;
                        option_data.forEach(function(item) {
                            var option = document.createElement('option');
                            option.value = item.id;
                            option.textContent = item.certification_name + ' - ' + item.certification_number;
                            select.appendChild(option);
                        });
                    }
                }
            });
        })
    });
</script>
@endpush