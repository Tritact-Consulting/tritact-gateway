@extends('layouts.admin-app')
@section('title', 'Consultant List')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Consultant List</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Consultant</li>
                        <li class="breadcrumb-item active" aria-current="page">Consultant list</li>
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
                                    <th>Consultant</th>
                                    <th>Phone</th>
                                    <th>Company</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $value)
                                <tr class="hover-primary">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->name }} <br> {{ $value->email }}</td>
                                    <td>{{ $value->phone }}</td>
                                    <td>
                                        @if($value->companies->isNotEmpty())
                                        @forelse($value->companies as $company)
                                            <div>
                                                <span class="badge badge-info">{{ $company->user ? $company->user->name : '' }}</span>
                                            </div>
                                        @empty
                                        @endforelse
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('consultant.destroy', $value->id) }}" method="POST">
                                            <div class="d-flex">
                                                @csrf
                                                @method('DELETE')
                                                @can('edit consultant')
                                                <a href="{{ route('consultant.edit', $value->id) }}" class="mr-1 waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-5"><i class="fa fa-edit"></i></a>
                                                @endcan
                                                @can('delete consultant')
                                                <button type="submit" class="waves-effect waves-circle btn btn-circle btn-primary-light btn-xs mb-5 show_confirm" data-heading="auditor"><i class="fa fa-trash"></i></button>
                                                @endcan
                                            </div>
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
