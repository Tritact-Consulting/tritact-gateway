@extends('layouts.admin-app')
@section('title', 'Edit Certificate - ' . $data->id)
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Edit Certificate - {{ $data->id }}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Company</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Certificate - {{ $data->id }}</li>
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
                    <h4 class="box-title">Edit Certificate</h4>
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
                <form class="form" enctype="multipart/form-data" method="post" action="{{ route('company.certification.update', $data->id) }}">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Company <strong>*</strong></label>
                                    <select name="company" id="company" class="form-control select2" required>
                                        <option value="">Select Company</option>
                                        @foreach($user as $key => $value)
                                        <option value="{{ $value->id }}" {{ $data->user_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Certification Type<strong>*</strong></label>
                                    <select name="certification" id="certification" class="form-control select2" required>
                                        <option value="">Select Certification Type</option>
                                        @foreach($certification as $key => $value)
                                        <option value="{{ $value->id }}" {{ $data->certifications_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Certification Body<strong>*</strong></label>
                                    <select name="certification_body" id="certification_body" class="form-control select2" required>
                                        <option value="">Select Certification Body </option>
                                        @foreach($certification_body as $key => $value)
                                        <option value="{{ $value->id }}" {{ $data->certification_body_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Auditor <strong>*</strong></label>
                                    <select name="auditor" id="auditor" class="form-control" required>
                                        <option value="">Select Auditor</option>
                                        @foreach($auditors as $key => $value)
                                        <option value="{{ $value->id }}" {{ $data->auditor_id == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Audit Type <strong>*</strong></label>
                                    <input type="text" name="certification_name" id="certification_name" class="form-control" value="{{ $data->certification_name }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Issue Date</label>
                                    <input type="date" name="issue_date" id="issue_date" class="form-control" value="{{ $data->issue_date }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Expiry Date</label>
                                    <input type="date" name="expire_date" id="expire_date" class="form-control" value="{{ $data->expire_date }}">
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
                                    <input type="date" name="next_audit_due_date" id="next_audit_due_date" class="form-control" value="{{ $data->next_audit_due_date }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Username
                                        <div class="tooltip right-tooltip">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span class="tooltiptext">
                                                You may need to provide the username for certifications such as SafeContractor, CHAS, Constructionline, and Cyber Essentials. 
                                                If you don’t know the username, you can leave this field empty.
                                            </span>
                                        </div>
                                    </label>
                                    <input type="text" name="username" id="username" class="form-control" value="{{ $data->username }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Password
                                        <div class="tooltip">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span class="tooltiptext">
                                                You may need to provide the password for certifications such as SafeContractor, CHAS, Constructionline, and Cyber Essentials. 
                                                If you don’t know the password, you can leave this field empty.
                                            </span>
                                        </div>
                                    </label>
                                    <input type="text" name="password" id="password" class="form-control" value="{{ $data->password }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Certification Number</label>
                                    <input type="text" name="certification_number" id="certification_number" class="form-control" value="{{ $data->certification_number }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Previous Certification</label>
                                    <select name="previous_certification" id="previous_certification" class="form-control select2">
                                        <option value="">Select Previous Certification</option>
                                        @foreach($preview_data as $key => $value)
                                            <option value="{{ $value->id }}" {{ $value->id == $data->previous_certification ? 'selected' : '' }}>
                                                {{ $value->certification_name }} {{ $value->certification_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Assigned To<strong>*</strong></label>
                                    <select name="assigned_to" id="assigned_to" class="form-control select2" required>
                                        <option value="">Select User</option>
                                        @foreach($assigned_to as $key => $value)
                                            <option value="{{ $value->id }}" {{ $data->assigned_to == $value->id ? 'selected' : '' }}>
                                                {{ $value->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control select2">
                                        <option value="" {{ $data->status === null ? 'selected' : '' }}>Select Status</option>
                                        <option value="0" {{ $data->status === 0 ? 'selected' : '' }}>Assigned</option>
                                        <option value="1" {{ $data->status === 1 ? 'selected' : '' }}>Discontinued</option>
                                        <option value="2" {{ $data->status === 2 ? 'selected' : '' }}>In-Progress</option>
                                        <option value="3" {{ $data->status === 3 ? 'selected' : '' }}>Completed</option>
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
                        var select = document.getElementById('previous_certification');
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