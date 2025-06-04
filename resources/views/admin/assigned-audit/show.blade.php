@extends('layouts.admin-app')
@section('title', 'Assigned Audit - ' . $data->audit_name)
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Assigned Audit - {{ $data->audit_name }}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Assigned Audit</li>
                        <li class="breadcrumb-item active" aria-current="page">Assigned Audit - {{ $data->audit_name }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-12">
			<div class="box">
			    <div class="box-body">
				    <div class="table-responsive rounded card-table">
                        <table class="table border-no">
                            <tbody>
                                <tr>
                                    <th>Company</th>
                                    <td>{{ $data->company->name }}</td>
                                </tr>
                                <tr>
                                    <th>Audit name</th>
                                    <td>{{ $data->audit_name }}</td>
                                </tr>
                                <tr>
                                    <th>Category</th>
                                    <td>{{ $data->category->name }}</td>
                                </tr>
                                <tr>
                                    <th>Start Date</th>
                                    <td>{{ $data->audit_start_date }}</td>
                                </tr>
                                <tr>
                                    <th>End Date</th>
                                    <td>{{ $data->audit_end_date }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <form action="{{ route('assigned-audit.update', $data->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" id="status" class="form-control">
                                                <option value="0" {{ $data->status == 0 ? 'selected' : '' }}>Upcoming</option>
                                                <option value="1" {{ $data->status == 1 ? 'selected' : '' }}>In progress</option>
                                                <option value="2" {{ $data->status == 2 ? 'selected' : '' }}>Completed</option>
                                            </select>
                                            <button type="submit" class="btn btn-rounded btn-primary btn-outline mt-3"><i class="ti-save-alt"></i> Update</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection