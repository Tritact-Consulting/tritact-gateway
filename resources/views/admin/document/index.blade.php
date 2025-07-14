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
                        <div class="text-right mb-2">
				            <form method="post" id="download_all_form" action="{{ route('documents.delete.all') }}">
				                @csrf
				                <input type="hidden" name="doc[]">
				                <button type="button" class="btn btn-danger btn-sm download_all_form">Delete Selected File</button>
				            </form>
			            </div>
                        <table class="table border-no datatables document-table" id="example1">
                            <thead>
                                <tr>
                                    <th style="width: 60px;">
                                        <div style="position: relative;top: 10px;">
                                            <input type="checkbox" name="document_all" class="form-check-input" id="document-all">
                                            <label for="document-all"></label>
                                        </div>
                                    </th>
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
                                    <td style="vertical-align: sub;padding-top: 22px;">
                                        <input type="checkbox" name="document_id[]" class="form-check-input" id="document-{{ $value->id }}" value="{{ $value->id }}">
                                        <label for="document-{{ $value->id }}"></label>
                                    </td>
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
                                            @can('view doc')
                                            <a href="{{ route('documents.open.office', $value->id) }}"
                                                target="_blank"
                                                class="waves-effect waves-circle btn btn-circle btn-info-light btn-xs mb-5">
                                                    <i class="fa fa-eye"></i>
                                            </a>
                                            @endcan
                                            @can('edit doc')
                                            <a href="{{ route('document.edit', $value->id) }}" class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-5"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @csrf
                                            @method('DELETE')
                                            @can('delete doc')
                                            <button type="submit" class="waves-effect waves-circle btn btn-circle btn-primary-light btn-xs mb-5 show_confirm"><i class="fa fa-trash"></i></button>
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
@push('script')
<script>
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