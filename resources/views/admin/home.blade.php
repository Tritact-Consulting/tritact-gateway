@extends('layouts.admin-app')
@section('title', 'Dashboard')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-building mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $company_count }}</h2>
                            <p class="text-fade mb-0">Companies</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-tags mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $tag_count }}</h2>
                            <p class="text-fade mb-0">Tags</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-users mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $user_count }}</h2>
                            <p class="text-fade mb-0">Users</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-th-list mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $document_count }}</h2>
                            <p class="text-fade mb-0">Documents</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-book mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $guide_count }}</h2>
                            <p class="text-fade mb-0">Guides</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-bar-chart mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $cert_body_count }}</h2>
                            <p class="text-fade mb-0">Certification Body</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-user mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $auditor_count }}</h2>
                            <p class="text-fade mb-0">Auditors</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-share mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ $assign_certification_count }}</h2>
                            <p class="text-fade mb-0">Assign Certificate</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($assigned_audit != null)
    <div class="row">
        <div class="col-12">
			<div class="box">
			    <div class="box-body">
				    <div class="table-responsive rounded card-table">
                        <table class="table border-no datatables" id="example1">
                            <thead>
                                <tr>
                                    <th>Company</th>
                                    <th>Category</th>
                                    <th>Audit Name</th>
                                    <th>Start/End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assigned_audit as $key => $value)
                                <tr class="hover-primary">
                                    <td>{{ $value->company->name }}</td>
                                    <td>{{ $value->category->name }}</td>
                                    <td>{{ $value->audit_name }}</td>
                                    <td>{{ $value->audit_start_date }}<br>{{ $value->audit_end_date }}</td>
                                    <td>
                                        <span class="badge badge-pill badge-{{ $value->get_status_class() }}">{{ $value->get_status() }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('assigned-audit.show', $value->id) }}" class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-5"><i class="fa fa-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($assign_audit != null)
    <div class="row">
        <div class="col-12">
			<div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Live Audit</h4>
                </div>
			    <div class="box-body">
				    <div class="table-responsive rounded card-table">
                        <table class="table border-no datatables" id="example1">
                            <thead>
                                <tr>
                                    <th>SNO</th>
                                    <th>User</th>
                                    <th>Company</th>
                                    <th>Audit Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assign_audit as $key => $value)
                                <tr class="hover-primary">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->user->name }}</td>
                                    <td>{{ $value->company->name }}</td>
                                    <td>{{ $value->audit_name }}</td>
                                    <td>
                                        <span class="badge badge-pill badge-{{ $value->get_status_class() }}">{{ $value->get_status() }}</span>
                                    </td>
                                    <td>
                                        <form action="{{ route('assign-audit.destroy', $value->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            @can('edit assign audit')
                                            <a href="{{ route('assign-audit.edit', $value->id) }}" class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-5"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('delete assign audit')
                                            <button type="submit" class="waves-effect waves-circle btn btn-circle btn-primary-light btn-xs mb-5 show_confirm" data-heading="audit"><i class="fa fa-trash"></i></button>
                                            @endcan
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @can('view assign certification')
    <div class="row">
        <div class="col-12">
			<div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Certification Summary</h4>
                </div>
			    <div class="box-body">
				    <div class="table-responsive rounded card-table">
                        <table class="table border-no datatables-expire" id="example1">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Certification Category</th>
                                    <th>Audit Type</th>
                                    <th>Auditor</th>
                                    <th>Expire Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($auditor_expire as $key => $value)
                                <tr class="{{ $value->getRemainingDays() }}">
                                    <td>{{ $value->user->name }}</td>
                                    <td>{{ $value->certificate->name }}</td>
                                    <td>{{ $value->certification_name }}</td>
                                    <td>{{ $value->auditor != null ? $value->auditor->name : '' }}</td>
                                    <td>{{ $value->expire_date }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route('company.certification.edit', $value->id) }}" class="mr-1 waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-5"><i class="fa fa-edit"></i></a>
                                            <form action="{{ route('company.certification.destroy', $value->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="waves-effect waves-circle btn btn-circle btn-primary-light btn-xs mb-5 show_confirm" data-heading="certification"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
</section>
<!-- /.content -->
@endsection
@push('script')
<script>
    if($('.datatables-expire').length != 0){
        $('.datatables-expire').DataTable({
            order: [[5, 'asc']]
        });
    }
</script>
@endpush