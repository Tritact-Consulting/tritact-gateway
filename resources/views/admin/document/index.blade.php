@extends('layouts.admin-app')
@section('title', 'Document List')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Document List</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Document</li>
                        <li class="breadcrumb-item active" aria-current="page">Document list</li>
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
                                    <th>Name</th>
                                    <th>Tags</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $value)
                                <tr class="hover-primary">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>
                                        @foreach($value->tags as $tag)
                                        <span class="badge badge-info badge-sm">{{ $tag->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $value->created_at->format('d M, Y') }}</td>
                                    <td>
                                        <form action="{{ route('document.destroy', $value->id) }}" method="post">
                                            <a href="{{ route('document.show', $value->id) }}" class="waves-effect waves-circle btn btn-circle btn-success-light btn-xs mb-5"><i class="fa fa-eye-slash"></i></a>										
                                            <a href="{{ route('document.edit', $value->id) }}" class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-5"><i class="fa fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="waves-effect waves-circle btn btn-circle btn-primary-light btn-xs mb-5 show_confirm"><i class="fa fa-trash"></i></button>
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