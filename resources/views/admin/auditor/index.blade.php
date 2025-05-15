@extends('layouts.admin-app')
@section('title', 'Auditor List')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Auditor List</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Auditor</li>
                        <li class="breadcrumb-item active" aria-current="page">Auditor list</li>
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
                                    <th>Certification Body</th>
                                    <th>Certification Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $value)
                                <tr class="hover-primary">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->name }} <br> {{ $value->email }} <br> {{ $value->phone }}</td>
                                    <td>
                                        <span class="badge badge-primary">{{ $value->category_body->name }}</span>
                                    </td>
                                    <td>
                                        @foreach($value->category as $category)
                                        <span class="badge badge-info badge-sm">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <form action="{{ route('auditor.destroy', $value->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a href="{{ route('auditor.edit', $value->id) }}" class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-5"><i class="fa fa-edit"></i></a>
                                            <button type="submit" class="waves-effect waves-circle btn btn-circle btn-primary-light btn-xs mb-5 show_confirm" data-heading="auditor"><i class="fa fa-trash"></i></button>
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
