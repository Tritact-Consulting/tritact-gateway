@extends('layouts.admin-app')
@section('title', 'Add Company')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Add Company</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Company</li>
                        <li class="breadcrumb-item active" aria-current="page">Add Company</li>
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
                    <h4 class="box-title">Add Company form</h4>
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
                <form class="form" enctype="multipart/form-data" method="post" action="{{ route('company.store') }}">
                    @csrf
                    <input type="hidden" name="email_temp" value="" id="email_temp">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Logo <strong>*</strong></label>
                                    <input type="file" name="logo" class="form-control dropify" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name <strong>*</strong></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>E-mail <strong>*</strong></label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password <strong>*</strong></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password">
                                                <i class="fa fa-fw field-icon fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirm Password <strong>*</strong></label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text toggle-password">
                                                <i class="fa fa-fw field-icon fa-eye"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Director name <strong>*</strong></label>
                                    <input type="text" class="form-control" name="director_name" value="{{ old('director_name') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Short name <strong>*</strong></label>
                                    <input type="text" class="form-control" name="short_name" value="{{ old('short_name') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Total Users <strong>*</strong></label>
                                    <input type="number" class="form-control" name="total_user" value="{{ old('total_user') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status <strong>*</strong></label>
                                    <select class="form-control" name="status" required>
                                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Active</option>
                                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Deactive</option>
                                    </select>                                   
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tags <strong>*</strong></label>
                                    <select class="form-control select2" name="tags[]" multiple="multiple" required>
                                        <option value="all">All</option>
                                        @foreach($tags as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Categories <strong>*</strong></label>
                                    <select class="form-control select2" name="categories[]" multiple="multiple">
                                        <option value="all">All</option>
                                        @foreach($categories as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="version">Version <strong>*</strong></label>
                                    <input type="text" name="version" id="version" class="form-control" value="{{ old('version') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="issue_date">Issue Date <strong>*</strong></label>
                                    <input type="date" name="issue_date" id="issue_date" class="form-control" value="{{ old('issue_date') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="website">Website <strong>*</strong></label>
                                    <input type="text" name="website" id="website" class="form-control" value="{{ old('website') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="registration_num">Registration Number <strong>*</strong></label>
                                    <input type="text" name="registration_num" id="registration_num" class="form-control" value="{{ old('registration_num') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone_num">Phone Number <strong>*</strong></label>
                                    <input type="text" name="phone_num" id="phone_num" class="form-control" value="{{ old('phone_num') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_email">Company Email <strong>*</strong></label>
                                    <input type="email" name="company_email" id="company_email" class="form-control" value="{{ old('company_email') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="logo_width">Logo Width <strong>*</strong>
                                        <div class="tooltip">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span class="tooltiptext">If you have same size of logo (width and height are equal) then width = 120<br>If your logo width is greater then your logo height than width = 100<br>If your logo height is greater then your logo width than width = 70</span>
                                        </div>
                                    </label>
                                    <input type="number" name="logo_width" id="logo_width" class="form-control" value="{{ old('logo_width') }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="logo_height">Logo Height <strong>*</strong>
                                        <div class="tooltip right-tooltip">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span class="tooltiptext">If you have same size of logo (width and height are equal) then height = 120<br>If your logo width is greater then your logo height than height = 70<br>If your logo height is greater then your logo width than height = 100</span>
                                        </div>
                                    </label>
                                    <input type="number" name="logo_height" id="logo_height" class="form-control" value="{{ old('logo_height') }}" required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="credentials">Send Credentials Via Email</label>
                                            <select name="credentials" id="credentials" class="form-control">
                                                <option value="0">NO</option>
                                                <option value="1">YES</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="sender_email">Sender Email Address</label>
                                            <input type="email" name="sender_email" id="sender_email" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group email_template_wrapper">
                                    <label for="email_template">Email Content</label>
                                    <div class="email_template form-control" contenteditable="true">
                                        <p>Hi <span class="username"></span>,</p>
                                        <p>Welcome to {!! config('app.name', 'Laravel') !!}!</p>
                                        <p>Here are your login credentials:</p>
                                        <p>Email: <span class="email"></span><br>Password: <span class="password"></span></p>
                                        <p>You can log in here: {{ $_SERVER['SERVER_NAME'] }}</p>
                                        <p>For security reasons, we recommend that you log in and update your password as soon as possible.</p>
                                        <p>If you have any trouble accessing your account, feel free to reply to this email or contact our support team at support@tritact.co.uk or 02080773222.</p>
                                        <br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_id">Company ID</label>
                                    <input type="text" name="company_id" id="company_id" class="form-control" value="{{ old('company_id') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="adding_certification">Adding Certification</label>
                                    <select name="adding_certification" id="adding_certification" class="form-control">
                                        <option value="0">NO</option>
                                        <option value="1">YES</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-rounded btn-primary btn-outline">
                            <i class="ti-save-alt"></i> Save Company
                        </button>
                    </div>
                </form>
            </div>
            <!-- /.box -->			
        </div> 
    </div>
</section>
@endsection
@push('style')
<style>
    .email_template_wrapper{
        display: none;
    }
</style>
@endpush

@push('script')
<script>
    $(document).ready(function(){
        $(".toggle-password").click(function() {
            $(this).find('i').toggleClass("fa-eye fa-eye-slash");
            var input = $(this).parent().parent().parent().find('input');
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    });

    $('#name').on('keyup',function(){
        $('.email_template .username').text($(this).val());
    });

    $('#email').on('keyup',function(){
        $('.email_template .email').text($(this).val());
        $('#sender_email').val($(this).val());
    });

    $('#password').on('keyup',function(){
        $('.email_template .password').text($(this).val());
    });

    $('#credentials').change(function(){
        if($(this).val() == 1){
            $('.email_template_wrapper').show();
        }else{
            $('.email_template_wrapper').hide();
        }
    });

    $('.form').submit(function(e){
        $('#email_temp').val($('.email_template').html());
        return true;
    })
</script>
@endpush