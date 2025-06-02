@extends('layouts.admin-app')
@section('title', 'Document Keyword')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Document Keyword</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Document</li>
                        <li class="breadcrumb-item active" aria-current="page">Document Keyword</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
 @can('create keyword')
<section class="content">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Add Document Keyword</h4>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger m-20 mb-0">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul class="mt-2 mb-2">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- /.box-header -->
                <form class="form" enctype="multipart/form-data" method="post" action="{{ route('document.keyword') }}">
                    @csrf
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>File Keyword</label>
                                    <input type="text" class="form-control" name="keyword">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Database Column</label>
                                    <select name="column" id="" class="form-control">
                                        <option value="">Select Column</option>
                                        <option value="director_name">Director Name</option>
                                        <option value="short_name">Short Name</option>
                                        <option value="logo">Logo</option>
                                        <option value="name">Company Name</option>
                                        <option value="version">Version</option>
                                        <option value="issue_date">Issue Date</option>
                                        <option value="address">Address</option>
                                        <option value="website">Website</option>
                                        <option value="registration_num">Registration Number</option>
                                        <option value="phone_num">Phone Number</option>
                                        <option value="company_email">Company Email</option>
                                        <option value="signature">Signature</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">                        
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                        <i class="ti-save-alt"></i> Save
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.box -->			
        </div> 
    </div>
</section>
@endcan
@can('edit keyword')
<section class="content pt-0">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Document Keyword</h4>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    @foreach($data as $file_key => $file_value)
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>File Keyword</label>
                                <input type="text" class="form-control" name="old_keyword[{{$file_value->id}}]" value="{{ $file_value->doc_keyword }}">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Database Column</label>
                                <select name="old_column[{{$file_value->id}}]" id="" class="form-control">
                                    <option value="">Select Column</option>
                                    <option value="director_name" {{ $file_value->data_keyword == 'director_name' ? 'selected' : '' }}>Director Name</option>
                                    <option value="short_name" {{ $file_value->data_keyword == 'short_name' ? 'selected' : '' }}>Short Name</option>
                                    <option value="logo" {{ $file_value->data_keyword == 'logo' ? 'selected' : '' }}>Logo</option>
                                    <option value="name" {{ $file_value->data_keyword == 'name' ? 'selected' : '' }}>Company Name</option>
                                    <option value="version" {{ $file_value->data_keyword == 'version' ? 'selected' : '' }}>Version</option>
                                    <option value="issue_date" {{ $file_value->data_keyword == 'issue_date' ? 'selected' : '' }}>Issue Date</option>
                                    <option value="address" {{ $file_value->data_keyword == 'address' ? 'selected' : '' }}>Address</option>
                                    <option value="website" {{ $file_value->data_keyword == 'website' ? 'selected' : '' }}>Website</option>
                                    <option value="registration_num" {{ $file_value->data_keyword == 'registration_num' ? 'selected' : '' }}>Registration Number</option>
                                    <option value="phone_num" {{ $file_value->data_keyword == 'phone_num' ? 'selected' : '' }}>Phone Number</option>
                                    <option value="company_email" {{ $file_value->data_keyword == 'company_email' ? 'selected' : '' }}>Company Email</option>
                                    <option value="signature" {{ $file_value->data_keyword == 'signature' ? 'selected' : '' }}>Signature</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            @can('delete keyword')
                            <a href="javascript:;" onclick="removeDocField(this, {{$file_value->id}})" class="btn btn-warning btn-sm mt-25 btn-block">Delete</a>
                            @endcan
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- /.box -->			
        </div>
    </div>
</div>
@endcan
@endsection
@push('script')
<script>
    function removeDocField(a, id){
        var button = a;
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "{{ route('document.field.delete') }}",
            data : {'id' : id},
            type : 'POST',
            dataType : 'json',
            success : function(result){
                if(result){
                    $(button).parent().parent().remove();
                }
            }
        });
    }
</script>
@endpush
