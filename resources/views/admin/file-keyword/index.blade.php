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
<section class="content">
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Document Keyword</h4>
                </div>
                <!-- /.box-header -->
                <form class="form" method="post" action="{{ route('document.keyword') }}">
                    @csrf
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
                                        <option value="address" {{ $file_value->data_keyword == 'address' ? 'selected' : '' }}>Address</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a href="javascript:;" onclick="removeDocField(this, {{$file_value->id}})" class="btn btn-warning btn-sm mt-25 btn-block">Delete</a>
                            </div>
                        </div>
                        @endforeach
                        <div class="repeater">                   
                            <div data-repeater-list="file_keyword">                            
                                <div data-repeater-item class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>File Keyword</label>
                                            <input type="text" class="form-control" name="keyword">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label>Database Column</label>
                                            <select name="column" id="" class="form-control">
                                                <option value="">Select Column</option>
                                                <option value="director_name">Director Name</option>
                                                <option value="short_name">Short Name</option>
                                                <option value="logo">Logo</option>
                                                <option value="name">Company Name</option>
                                                <option value="version">Version</option>
                                                <option value="address">Address</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input data-repeater-delete type="button" value="Delete" class="btn btn-warning btn-sm mt-25 btn-block"/>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <input data-repeater-create type="button" value="Add Fields" class="btn btn-primary btn-sm"/>
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
</div>
@endsection
@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.repeater/1.2.1/jquery.repeater.min.js" integrity="sha512-foIijUdV0fR0Zew7vmw98E6mOWd9gkGWQBWaoA1EOFAx+pY+N8FmmtIYAVj64R98KeD2wzZh1aHK0JSpKmRH8w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>    
    $(document).ready(function(){
        $('.repeater').repeater({
            // (Optional)
            // start with an empty list of repeaters. Set your first (and only)
            // "data-repeater-item" with style="display:none;" and pass the
            // following configuration flag
            initEmpty: true,
            // (Optional)
            // "defaultValues" sets the values of added items.  The keys of
            // defaultValues refer to the value of the input's name attribute.
            // If a default value is not specified for an input, then it will
            // have its value cleared.
            defaultValues: {
                'text-input': 'foo'
            },
            // (Optional)
            // "show" is called just after an item is added.  The item is hidden
            // at this point.  If a show callback is not given the item will
            // have $(this).show() called on it.
            show: function () {
                $(this).slideDown();
            },
            // (Optional)
            // "hide" is called when a user clicks on a data-repeater-delete
            // element.  The item is still visible.  "hide" is passed a function
            // as its first argument which will properly remove the item.
            // "hide" allows for a confirmation step, to send a delete request
            // to the server, etc.  If a hide callback is not given the item
            // will be deleted.
            hide: function (deleteElement) {
                if(confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            // (Optional)
            // You can use this if you need to manually re-index the list
            // for example if you are using a drag and drop library to reorder
            // list items.
            ready: function (setIndexes) {
                
            },
            // (Optional)
            // Removes the delete button from the first list item,
            // defaults to false.
            isFirstItemUndeletable: true
        });

    });

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
