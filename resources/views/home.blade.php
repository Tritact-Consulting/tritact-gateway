@extends('layouts.user-app')
@section('title', 'Dashboard')
@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        @if(Auth::user()->hasRole('company'))
        <div class="col-xxxl-3 col-lg-6 col-12">
            <div class="box">
                <div class="box-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <i class="fa fa-users mr-20" aria-hidden="true" style="font-size: 40px"></i>
                        </div>
                        <div>
                            <h2 class="my-0 font-weight-700">{{ Auth::user()->get_total_users() }}</h2>
                            <p class="text-fade mb-0">Total Users</p>
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
                            <h2 class="my-0 font-weight-700">{{ Auth::user()->get_total_tags() }}</h2>
                            <p class="text-fade mb-0">Total Tags</p>
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
                            <p class="text-fade mb-0">Total Guides</p>
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
                            <p class="text-fade mb-0">Total Documents</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    @if($assign_audit != null)
    <div class="row">
        <div class="col-12">
			<div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Audit</h4>
                </div>
			    <div class="box-body">
				    <div class="table-responsive rounded card-table">
                        <table class="table border-no datatables" id="example1">
                            <thead>
                                <tr>
                                    <th>SNO</th>
                                    <th>Certification Type</th>
                                    <th>Certification Body</th>
                                    <th>Audit Type</th>
                                    <th>Status</th>
                                    <th>Certificate Issued</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($assign_audit as $key => $value)
                                <tr class="hover-primary">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->category->name }}</td>
                                    <td>{{ $value->body != null ? $value->body->name : ''}}</td>
                                    <td>{{ $value->audit_type }}</td>
                                    <td>
                                        <span class="badge badge-pill badge-{{ $value->get_status_class() }}">{{ $value->get_status() }}</span>
                                    </td>
                                    <td>
                                        {{ $value->completed == 0 ? 'NO' : 'YES' }}
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
    @if($auditor_expire != null)
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
                                    <th>Certification Type</th>
                                    <th>Certification Body</th>
                                    <th>Certificate Number</th>
                                    <th>Audit Type</th>
                                    <th>Expiry Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($auditor_expire as $key => $value)
                                <tr class="{{ $value->getRemainingDays() }}">
                                    <td>{{ $value->certificate->name }}</td>
                                    <td>{{ $value->body != null ? $value->body->name : '' }}</td>
                                    <td>{{ $value->certification_number != null ? $value->certification_number : '' }}</td>
                                    <td>{{ $value->certification_name }}</td>
                                    <td>{{ $value->expire_date }}</td>
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
</section>
@endsection
