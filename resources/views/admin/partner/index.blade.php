@extends('layouts.admin-app')
@section('title', 'Partner List')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Partner List</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Partners</li>
                        <li class="breadcrumb-item active" aria-current="page">Partner list</li>
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
                                    <th>Company / Person name</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $key => $value)
                                <tr class="hover-primary">
                                    <td>{{ ++$key }}</td>
                                    <td>{{ $value->company_name }}</td>
                                    <td>{{ $value->contact_name }}</td>
                                    <td>{{ $value->contact_email }}</td>
                                    <td>{{ $value->phone_number }}</td>
                                    <td>
                                        <form action="{{ route('partner.destroy', $value->id) }}" method="post">
                                            @can('edit partner')
                                            <a href="{{ route('partner.edit', $value->id) }}" class="waves-effect waves-circle btn btn-circle btn-danger-light btn-xs mb-5"><i class="fa fa-edit"></i></a>
                                            @endcan
                                            @csrf
                                            @method('DELETE')
                                            @can('delete partner')
                                            <button type="submit" class="waves-effect waves-circle btn btn-circle btn-primary-light btn-xs mb-5 show_confirm" data-heading="partner"><i class="fa fa-trash"></i></button>
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