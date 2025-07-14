@extends('layouts.admin-app')
@section('title', 'Document List - ' . $user->name)
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Document List - {{ $user->name }}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Document</li>
                        <li class="breadcrumb-item active" aria-current="page">Document list - {{ $user->name }}</li>
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
                    <form method="GET" action="{{ route('company.dashboard', $user->id) }}" id="tag-form">
                        <ul class="tag-wrapper">
                            @foreach($get_tags as $key => $value)
                            <li>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <input value="{{ $value->id }}" class="form-check-input" type="checkbox" name="tags[]" id="tag-{{ $value->id }}" {{ request()->get('tags') != null ? in_array($value->id, request()->get('tags')) ? 'checked' : '' : '' }}>
                                        <label for="tag-{{ $value->id }}">{{ $value->name }}</label>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </form>
                </div>
            </div>
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
                                    <td rowspan="{{ count($value->supportive_document(Auth::user()->id)) + 1 }}" style="vertical-align: sub;padding-top: 22px;">{{ ++$key }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>
                                        @foreach($value->tags as $tag)
                                        <span class="badge badge-info badge-sm">{{ $tag->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $value->created_at->format('d M, Y') }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <form action="{{ route('company.dashboard.documents.download', ['id' => $value->id, 'supportive' => 0, 'company_id' => $user->id]) }}" method="POST">
                                                <a href="{{ route('documents.open.office', $value->id) }}"
                                                    target="_blank"
                                                    class="waves-effect waves-circle btn btn-circle btn-info-light btn-xs mb-5">
                                                        <i class="fa fa-eye"></i>
                                                </a>
                                                @csrf
                                                <button type="submit" class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-0"><i class="fa fa-download"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @foreach($value->supportive_document(Auth::user()->id) as $support_key => $support_value)
                                <tr class="bg-light">
                                    <td>{{ $value->name }} {{ $support_value->version }}</td>
                                    <td>
                                        @foreach($value->tags as $tag)
                                        <span class="badge badge-info badge-sm">{{ $tag->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $support_value->created_at->format('d M, Y') }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <form action="{{ route('company.dashboard.documents.download', ['id' => $support_value->id, 'supportive' => 1, 'company_id' => $user->id]) }}" method="POST">                                
                                                @csrf
                                                <button type="submit" class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-0"><i class="fa fa-download"></i></button>
                                            </form>
                                            <span class="ml-3">{{ date('d M, Y', strtotime($support_value->issue_date)) }}</span>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
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
@push('script')
<script>
    $(document).ready(function(){
        $('input[name="tags[]"]').click(function() {
            $('#tag-form').submit();
        });
    });
</script>
@endpush