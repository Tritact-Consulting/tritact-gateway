@extends('layouts.user-app')
@section('title', 'Guide List')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Guide List</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Guides</li>
                        <li class="breadcrumb-item active" aria-current="page">Guide list</li>
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
                        <table class="table border-no datatables document-table" id="example1">
                            <thead>
                                <tr>
                                    <th>SNO</th>
                                    <th>Name</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $value)
                                <tr class="hover-primary">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->name }}</td>
                                    <td>{{ $value->created_at->format('d M, Y') }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @can('download document')
                                            <form action="{{ route('guides.download', $value->id) }}" method="POST">                                
                                                @csrf
                                                <button type="submit" class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-0"><i class="fa fa-download"></i></button>
                                            </form>

                                            <a href="{{ asset($value->file) }}" download class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-0"><i class="fa fa-download"></i></a>
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
    
    $('#document-all').click(function(){
        if($(this).is(':checked')){
            $('.document-table input').each(function(){
                $(this).prop('checked', true);
            });
        }else{
            $('.document-table input').each(function(){
                $(this).prop('checked', false);
            });
        }
    });
    
    $(document).ready(function(){
        $('.download_all_form').click(function(e){
            arrp=[];
            $('input[name="document_id[]"]').each(function(){
                if($(this).is(':checked')){
                    arrp.push($(this).val());
                }
            });
            $('#download_all_form').find('input[name="doc[]"]').val(arrp);
            e.preventDefault();
            $('#download_all_form').submit();
        })
    });
</script>
@endpush