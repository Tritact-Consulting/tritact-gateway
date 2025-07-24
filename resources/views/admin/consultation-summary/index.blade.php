@extends('layouts.admin-app')
@section('title', 'Consultation Summary List')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Consultation Summary List</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Consultation Summary</li>
                        <li class="breadcrumb-item active" aria-current="page">Consultation Summary list</li>
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
                        <table class="table border-no" id="example1">
                            <thead>
                                <tr>
                                    <th>SNO</th>
                                    <th>Auditor</th>
                                    <th>Company</th>
                                    <th>Certification Type</th>
                                    <th>Certification Body</th>
                                    <th>Audit Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $value)
                                <tr class="hover-primary">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->consultant->name }}</td>
                                    <td>{{ $value->company->name }}</td>
                                    <td>{{ $value->category != null ? $value->category->name : '' }}</td>
                                    <td>{{ $value->body != null ? $value->body->name : '' }}</td>
                                    <td>{{ $value->audit_type }}</td>
                                    <td>
                                        <div class="d-flex">
                                            @can('edit consultation summary')
                                            <a href="{{ route('consultation-summary.edit', $value->id) }}" class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-5"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @can('delete consultation summary')
                                            <form action="{{ route('consultation-summary.destroy', $value->id) }}" method="POST">
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
