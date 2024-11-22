@extends('layouts.user-app')
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
                    <form method="GET" action="{{ route('documents.index') }}" id="tag-form">
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
                                            @can('download document')		
                                            <form action="{{ route('documents.download', $value->id) }}" method="POST">                                
                                                @csrf
                                                <button type="submit" class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-0"><i class="fa fa-download"></i></button>
                                            </form>
                                            @endcan
                                            @if(Auth::user()->is_company == 1)
                                            <a href="javascript:;" onclick="changeVersion('{{ $value->name }}', {{ $value->id }})" class="ml-2 btn btn-success btn-sm">Supportive Document</a>
                                            @endif
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
                                            @can('download document')		
                                            <form action="{{ route('documents.download', ['id' => $support_value->id, 'supportive' => 1]) }}" method="POST">                                
                                                @csrf
                                                <button type="submit" class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-0"><i class="fa fa-download"></i></button>
                                            </form>
                                            @endcan
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
<!-- Modal -->
<div class="modal modal-right fade" id="modal-right" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Version - <span>{{ old('document_name') }}</span></h5>
                <button type="button" class="close" data-dismiss="modal">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                <div class="alert alert-danger mb-20">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul class="mt-2 mb-2">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form class="form" method="post" action="{{ route('documents.store') }}" enctype="multipart/form-data" id="submit-version">
                    @csrf
                    <input type="hidden" name="document_id" id="document_id" value="{{ old('document_id') }}">
                    <input type="hidden" name="document_name" id="document_name" value="{{ old('document_name') }}">
                    <div class="form-group">
                        <label>Version <strong>*</strong></label>
                        <input type="text" class="form-control" name="version" value="{{ old('version') }}" required>
                    </div>
                    <div class="form-group">
                        <label>Issue Date <strong>*</strong></label>
                        <input type="date" class="form-control" name="issue_date" value="{{ old('issue_date') }}" required>
                    </div>
                    <div class="form-group">
                        <label>File <strong>*</strong></label>
                        <input type="file" class="form-control" name="file" value="{{ old('file') }}" required>
                    </div>
                    <div class="form-group">
                        <p class="alert alert-info">You need to upload a new file if you want to change the Version.</p>
                    </div>
                </form>
            </div>
            <div class="modal-footer modal-footer-uniform">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary float-right" id="save-changes">Save changes</button>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->
@endsection
@push('script')
<script>
    @if ($errors->any())
    $('#modal-right').modal('show');
    @endif
    $(document).ready(function(){
        $('input[name="tags[]"]').click(function() {
            $('#tag-form').submit();
        });
    });

    function changeVersion(a, b){
        $('#document_id').val(b);
        $('#document_name').val(a);
        $('.modal-title span').text(a);
        $('#modal-right').modal('show');
    }

    $('#save-changes').click(function(){
        $('#submit-version').submit();
    });
</script>
@endpush