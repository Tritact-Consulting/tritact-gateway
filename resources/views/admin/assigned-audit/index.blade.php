@extends('layouts.admin-app')
@section('title', 'Assigned Audit List')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Assigned Audit List</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Assigned Audit</li>
                        <li class="breadcrumb-item active" aria-current="page">Assigned Audit list</li>
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
				    <div class="table-responsive rounded card-table">
                        <table class="table border-no datatables" id="example1">
                            <thead>
                                <tr>
                                    <th>SNO</th>
                                    <th>Company</th>
                                    <th>Category</th>
                                    <th>Audit Name</th>
                                    <th>Start/End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $value)
                                <tr class="hover-primary">
                                    <td>{{ ++$key }}</td>
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
</section>
@endsection
