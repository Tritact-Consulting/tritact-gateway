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
				    <div class="table-responsive rounded card-table">
                        <table class="table border-no datatables" id="example1">
                            <thead>
                                <tr>
                                    <th>SNO</th>
                                    <th>Auditor</th>
                                    <th>Company</th>
                                    <th>Certification Type</th>
                                    <th>Certification Body</th>
                                    <th>Audit Type</th>
                                    <th>Status</th>
                                    <th>Certificate Issued</th>
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
                                    <td>
                                        {{ $value->completed == 0 ? 'NO' : 'YES' }}
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
</section>
@endsection
