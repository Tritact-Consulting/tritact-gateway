@extends('layouts.admin-app')
@section('title', 'Certificate Management')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Certificate Management</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Company</li>
                        <li class="breadcrumb-item active" aria-current="page">Certificate Management</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="content">
    @can('create assign certification')
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Add Certificate</h4>
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
                <form class="form" enctype="multipart/form-data" method="post" action="{{ route('company.certification.add') }}">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Company <strong>*</strong></label>
                                    <select name="company" id="company" class="form-control select2" required>
                                        <option value="">Select Company</option>
                                        @foreach($user as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Certification Type<strong>*</strong></label>
                                    <select name="certification_category" id="certification_category" class="form-control select2" required>
                                        <option value="">Select Certification Type </option>
                                        @foreach($certification as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
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
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Auditor</label>
                                    <select name="auditor" id="auditor" class="form-control">
                                        <option value="">Select Auditor</option>
                                        @foreach($auditors as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Audit Type <strong>*</strong></label>
                                    <input type="text" name="certification_name" id="certification_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Issue Date</label>
                                    <input type="date" name="issue_date" id="issue_date" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Expiry Date</label>
                                    <input type="date" name="expire_date" id="expire_date" class="form-control">
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
                                    <input type="date" name="next_audit_due_date" id="next_audit_due_date" class="form-control">
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
                                    <input type="text" name="username" id="username" class="form-control">
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
                                    <input type="text" name="password" id="password" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Certification Number</label>
                                    <input type="text" name="certification_number" id="certification_number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Previous Certification</label>
                                    <select name="previous_certification" id="previous_certification" class="form-control select2">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Assigned To<strong>*</strong></label>
                                    <select name="assigned_to" id="assigned_to" class="form-control select2" required>
                                        <option value="">Select User </option>
                                        @foreach($assigned_to as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control select2">
                                        <option value="">Select Status </option>
                                        <option value="0">Assigned</option>
                                        <option value="1">Discontinued</option>
                                        <option value="2">In-Progress</option>
                                        <option value="3">Completed</option>
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
    @endcan
    @can('view assign certification')
    @php
        $modals = []; // store modals to render later
        $groupedData = $data->groupBy(function($item) {
            $companyId = (int) ($item->company_id ?? $item->user_id ?? 0);
            $certTypeId = (int) ($item->certification_category_id ?? $item->certificate->id ?? 0);
            return $companyId . '-' . $certTypeId;
        });
    @endphp
    <div class="row">
        <div class="col-12">
			<div class="box">
			    <div class="box-body">
                    <form action="{{ route('company.certification.assign') }}" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <select name="company_name" id="search_company_name" class="form-control select2">
                                        <option value="">All Companies</option>
                                        @foreach($user as $key => $value)
                                        <option value="{{ $value->id }}" {{ app('request')->input('company_name') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Certification Type</label>
                                    <select name="certification_type" id="search_certification_type" class="form-control select2">
                                        <option value="">All Type</option>
                                        @foreach($certification as $key => $value)
                                        <option value="{{ $value->id }}" {{ app('request')->input('certification_type') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Certification Body</label>
                                    <select name="certification_body" id="search_certification_body" class="form-control select2">
                                        <option value="">All Body</option>
                                        @foreach($certification_body as $key => $value)
                                        <option value="{{ $value->id }}" {{ app('request')->input('certification_body') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Certificate Number</label>
                                    <input type="text" name="certificate_number" id="search_certificate_number" class="form-control" value="{{ app('request')->input('certificate_number') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Audit Type</label>
                                    <input type="text" name="audit_type" id="search_audit_type" class="form-control" value="{{ app('request')->input('audit_type') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control select2">
                                        <option value="" {{ app('request')->input('status') === null ? 'selected' : '' }}>All Status</option>
                                        <option value="0" {{ app('request')->input('status') === 0 ? 'selected' : '' }}>Assigned</option>
                                        <option value="1" {{ app('request')->input('status') === 1 ? 'selected' : '' }}>Discontinued</option>
                                        <option value="2" {{ app('request')->input('status') === 2 ? 'selected' : '' }}>In-Progress</option>
                                        <option value="3" {{ app('request')->input('status') === 3 ? 'selected' : '' }}>Completed</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group text-right mb-0 mt-4">
                                    <button class="btn btn-primary btn-sm" type="submit">Search</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
				    <div class="table-responsive rounded card-table">
                        <table class="table border-no" id="example1">
                            <thead>
                                <tr>
                                    <th>Company<br>Name</th>
                                    <th>Certification Type</th>
                                    <th>Certification<br>Body</th>
                                    <th>Certificate No.</th>
                                    <th>Audit Type</th>
                                    <th>Expiry Date</th>
                                    <th>Assigned To</th>
                                    <th>Status</th>
                                    <th>Previous Records</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($groupedData as $groupKey => $records)
                                    @php
                                        $sorted = $records->sortByDesc(function($item) {
                                            return $item->next_audit_due_date ?? $item->expire_date;
                                        });
                                        $latest = $sorted->first();
                                        $olderRecords = $sorted->slice(1);
                                    @endphp

                                    <tr class="hover-primary">
                                        <td>{{ $latest->user->name }}</td>
                                        <td>{{ $latest->certificate->name }}</td>
                                        <td>{{ $latest->body?->name }}</td>
                                        <td>{{ $latest->certification_number }}</td>
                                        <td>{{ $latest->certification_name }}</td>
                                        <td>{{ $latest->expire_date }}</td>
                                        <td>{{ $latest->assignedUser?->name ?? 'N/A' }}</td>
                                        <td>
                                            @if($latest->status_badge)
                                                <span class="{{ $latest->status_badge['class'] }}">
                                                    {{ $latest->status_badge['label'] }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($olderRecords->count() > 0)
                                               <button class="btn btn-sm"
                                                        style="background-color: #1e88e5; color: #fff; border-radius: 20px; padding: 5px 14px; font-weight: 500;"
                                                        data-toggle="modal"
                                                        data-target="#recordsModal{{ str_replace('-', '_', $groupKey) }}">
                                                    View All
                                                </button>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                @can('edit assign certification')
                                                <a href="{{ route('company.certification.edit', $latest->id) }}" class="mr-1 btn btn-circle btn-danger-light btn-xs">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @endcan
                                                @can('delete assign certification')
                                                <form action="{{ route('company.certification.destroy', $latest->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-circle btn-primary-light btn-xs show_confirm" data-heading="certification">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>

                                    @if($olderRecords->count() > 0)
                                        @php
                                        $modalId = 'recordsModal' . str_replace('-', '_', $groupKey);
                                        $modals[] = view('partials.previous-certification-modal', compact('latest', 'olderRecords', 'modalId'))->render();
                                        @endphp
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        {!! implode("\n", $modals) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
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