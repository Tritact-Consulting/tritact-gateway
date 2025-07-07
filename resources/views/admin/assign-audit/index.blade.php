@extends('layouts.admin-app')
@section('title', 'Assign Audit List')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Assign Audit List</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Assign Audit</li>
                        <li class="breadcrumb-item active" aria-current="page">Assign Audit list</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
<section class="content">
    <div class="row">
        <div class="col-12">
			<div class="box">
			    <div class="box-body">
                    <form action="{{ route('assign-audit.index') }}" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Auditor Name</label>
                                    <select name="auditor_name" id="search_auditor_name" class="form-control select2">
                                        <option value="">All Auditors</option>
                                        @foreach($auditors as $key => $value)
                                        <option value="{{ $value->id }}" {{ app('request')->input('auditor_name') == $value->id ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <select name="company_name" id="search_company_name" class="form-control select2">
                                        <option value="">All Companies</option>
                                        @foreach($company as $key => $value)
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
                                        @foreach($certification_category as $key => $value)
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
                                    <label>Audit Type</label>
                                    <input type="text" name="audit_type" id="search_audit_type" class="form-control" value="{{ app('request')->input('audit_type') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="status" id="search_status" class="form-control">
                                        <option value="" {{ app('request')->input('status') == null ? 'selected' : '' }}>All Status</option>
                                        <option value="0" {{ app('request')->input('status') != null ? app('request')->input('status') == 0 ? 'selected' : '' : '' }}>Upcoming</option>
                                        <option value="1" {{ app('request')->input('status') != null ? app('request')->input('status') == 1 ? 'selected' : '' : ''}}>In progress</option>
                                        <option value="2" {{ app('request')->input('status') != null ? app('request')->input('status') == 2 ? 'selected' : '' : ''}}>Completed</option>
                                        <option value="3" {{ app('request')->input('status') != null ? app('request')->input('status') == 3 ? 'selected' : '' : '' }}>Cancelled</option>
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
                                    <th>SNO</th>
                                    <th>Auditor</th>
                                    <th>Company</th>
                                    <th>Certification Type</th>
                                    <th>Certification Body</th>
                                    <th>Audit Type</th>
                                    <th>Status</th>
                                    <th>Audit Dates</th>
                                    <th>Certified</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $value)
                                <tr class="hover-primary">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->auditor->name }}</td>
                                    <td>{{ $value->company->name }}</td>
                                    <td>{{ $value->category != null ? $value->category->name : '' }}</td>
                                    <td>{{ $value->body != null ? $value->body->name : '' }}</td>
                                    <td>{{ $value->audit_type }}</td>
                                    <td>
                                        <span class="badge badge-pill badge-{{ $value->get_status_class() }}">{{ $value->get_status() }}</span>
                                    </td>
                                    <td>{{ $value->audit_start_date }}<br>{{ $value->audit_end_date }}</td>
                                    <td>
                                        {{ $value->completed == 0 ? 'NO' : 'YES' }}
                                    </td>
                                    <td>
                                        <div>
                                            @can('edit assign audit')
                                            <a href="{{ route('assign-audit.edit', $value->id) }}" class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-5"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('delete assign audit')
                                            <form action="{{ route('assign-audit.destroy', $value->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="waves-effect waves-circle btn btn-circle btn-primary-light btn-xs mb-5 show_confirm" data-heading="audit"><i class="fa fa-trash"></i></button>
                                            </form>
                                            @endcan
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
</section>
@endsection
