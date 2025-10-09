@extends('layouts.admin-app')
@section('title', 'Edit Company ' . $data->name )
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Edit Company - {{ $data->name }}</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Company</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Company - {{ $data->name }}</li>
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
                    <h4 class="box-title">Edit Company form</h4>
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
                <form class="form" enctype="multipart/form-data" method="post" action="{{ route('company.update', $data->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Consultant</label>
                                    <select name="consultant" id="consultant" class="form-control select2">
                                        <option value="">Select Consultant</option>
                                        @foreach($consultants as $key => $value)
                                        <option value="{{ $value->id }}" {{ $data->company->consultant_id == $value->id ? 'selected' : '' }}>{{ $value->name }} - {{ $value->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Logo <strong>*</strong></label>
                                    <input type="file" name="logo" class="form-control dropify" data-default-file="{{ asset($data->company->logo) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_id">Company ID</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <select name="prefix_company_id" class="input-group-text" id="basic-addon1">
                                                <option value="TCA" title="Tritact Clients" {{ $data->company->prefix_company_id == 'TCA' ? 'selected' : '' }}>TCA</option>
                                                <option value="PCA" title="Private Clients" {{ $data->company->prefix_company_id == 'PCA' ? 'selected' : '' }}>PCA</option>
                                            </select>
                                        </div>
                                        <input type="text" name="company_id" id="company_id" class="form-control" value="{{ old('company_id', $data->company->company_id) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name <strong>*</strong></label>
                                    <input type="text" class="form-control" name="name" value="{{ $data->name }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>E-mail <strong>*</strong></label>
                                    <input type="email" class="form-control" name="email" value="{{ $data->email }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password (Leave Empty)</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password">
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
                                    <label>Confirm Password (Leave Empty)</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password_confirmation">
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
                                    <input type="text" class="form-control" name="director_name" value="{{ $data->company->director_name }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Short name <strong>*</strong></label>
                                    <input type="text" class="form-control" name="short_name" value="{{ $data->company->short_name }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Total Users <strong>*</strong></label>
                                    <input type="number" class="form-control" name="total_user" value="{{ $data->company->total_user }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $data->company->address) }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status <strong>*</strong></label>
                                    <select class="form-control" name="status" required>
                                        <option value="0" {{ $data->company->status == 0 ? 'selected' : '' }}>Active</option>
                                        <option value="1" {{ $data->company->status == 1 ? 'selected' : '' }}>Deactive</option>
                                    </select>                                   
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Country <strong>*</strong></label>
                                    <select name="country" id="country" class="form-control select2" required>
                                        <option value="">-- Select Country --</option>
                                        <option value="Afghanistan" {{ old('country', $data->company->country ?? '') == 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                                        <option value="Albania" {{ old('country', $data->company->country ?? '') == 'Albania' ? 'selected' : '' }}>Albania</option>
                                        <option value="Algeria" {{ old('country', $data->company->country ?? '') == 'Algeria' ? 'selected' : '' }}>Algeria</option>
                                        <option value="Andorra" {{ old('country', $data->company->country ?? '') == 'Andorra' ? 'selected' : '' }}>Andorra</option>
                                        <option value="Angola" {{ old('country', $data->company->country ?? '') == 'Angola' ? 'selected' : '' }}>Angola</option>
                                        <option value="Argentina" {{ old('country', $data->company->country ?? '') == 'Argentina' ? 'selected' : '' }}>Argentina</option>
                                        <option value="Armenia" {{ old('country', $data->company->country ?? '') == 'Armenia' ? 'selected' : '' }}>Armenia</option>
                                        <option value="Australia" {{ old('country', $data->company->country ?? '') == 'Australia' ? 'selected' : '' }}>Australia</option>
                                        <option value="Austria" {{ old('country', $data->company->country ?? '') == 'Austria' ? 'selected' : '' }}>Austria</option>
                                        <option value="Azerbaijan" {{ old('country', $data->company->country ?? '') == 'Azerbaijan' ? 'selected' : '' }}>Azerbaijan</option>
                                        <option value="Bahrain" {{ old('country', $data->company->country ?? '') == 'Bahrain' ? 'selected' : '' }}>Bahrain</option>
                                        <option value="Bangladesh" {{ old('country', $data->company->country ?? '') == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                        <option value="Belarus" {{ old('country', $data->company->country ?? '') == 'Belarus' ? 'selected' : '' }}>Belarus</option>
                                        <option value="Belgium" {{ old('country', $data->company->country ?? '') == 'Belgium' ? 'selected' : '' }}>Belgium</option>
                                        <option value="Bhutan" {{ old('country', $data->company->country ?? '') == 'Bhutan' ? 'selected' : '' }}>Bhutan</option>
                                        <option value="Bolivia" {{ old('country', $data->company->country ?? '') == 'Bolivia' ? 'selected' : '' }}>Bolivia</option>
                                        <option value="Bosnia and Herzegovina" {{ old('country', $data->company->country ?? '') == 'Bosnia and Herzegovina' ? 'selected' : '' }}>Bosnia and Herzegovina</option>
                                        <option value="Botswana" {{ old('country', $data->company->country ?? '') == 'Botswana' ? 'selected' : '' }}>Botswana</option>
                                        <option value="Brazil" {{ old('country', $data->company->country ?? '') == 'Brazil' ? 'selected' : '' }}>Brazil</option>
                                        <option value="Brunei" {{ old('country', $data->company->country ?? '') == 'Brunei' ? 'selected' : '' }}>Brunei</option>
                                        <option value="Bulgaria" {{ old('country', $data->company->country ?? '') == 'Bulgaria' ? 'selected' : '' }}>Bulgaria</option>
                                        <option value="Cambodia" {{ old('country', $data->company->country ?? '') == 'Cambodia' ? 'selected' : '' }}>Cambodia</option>
                                        <option value="Cameroon" {{ old('country', $data->company->country ?? '') == 'Cameroon' ? 'selected' : '' }}>Cameroon</option>
                                        <option value="Canada" {{ old('country', $data->company->country ?? '') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                        <option value="Chile" {{ old('country', $data->company->country ?? '') == 'Chile' ? 'selected' : '' }}>Chile</option>
                                        <option value="China" {{ old('country', $data->company->country ?? '') == 'China' ? 'selected' : '' }}>China</option>
                                        <option value="Colombia" {{ old('country', $data->company->country ?? '') == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                                        <option value="Costa Rica" {{ old('country', $data->company->country ?? '') == 'Costa Rica' ? 'selected' : '' }}>Costa Rica</option>
                                        <option value="Croatia" {{ old('country', $data->company->country ?? '') == 'Croatia' ? 'selected' : '' }}>Croatia</option>
                                        <option value="Cuba" {{ old('country', $data->company->country ?? '') == 'Cuba' ? 'selected' : '' }}>Cuba</option>
                                        <option value="Cyprus" {{ old('country', $data->company->country ?? '') == 'Cyprus' ? 'selected' : '' }}>Cyprus</option>
                                        <option value="Czech Republic" {{ old('country', $data->company->country ?? '') == 'Czech Republic' ? 'selected' : '' }}>Czech Republic</option>
                                        <option value="Denmark" {{ old('country', $data->company->country ?? '') == 'Denmark' ? 'selected' : '' }}>Denmark</option>
                                        <option value="Dominican Republic" {{ old('country', $data->company->country ?? '') == 'Dominican Republic' ? 'selected' : '' }}>Dominican Republic</option>
                                        <option value="Ecuador" {{ old('country', $data->company->country ?? '') == 'Ecuador' ? 'selected' : '' }}>Ecuador</option>
                                        <option value="Egypt" {{ old('country', $data->company->country ?? '') == 'Egypt' ? 'selected' : '' }}>Egypt</option>
                                        <option value="El Salvador" {{ old('country', $data->company->country ?? '') == 'El Salvador' ? 'selected' : '' }}>El Salvador</option>
                                        <option value="Estonia" {{ old('country', $data->company->country ?? '') == 'Estonia' ? 'selected' : '' }}>Estonia</option>
                                        <option value="Ethiopia" {{ old('country', $data->company->country ?? '') == 'Ethiopia' ? 'selected' : '' }}>Ethiopia</option>
                                        <option value="Finland" {{ old('country', $data->company->country ?? '') == 'Finland' ? 'selected' : '' }}>Finland</option>
                                        <option value="France" {{ old('country', $data->company->country ?? '') == 'France' ? 'selected' : '' }}>France</option>
                                        <option value="Germany" {{ old('country', $data->company->country ?? '') == 'Germany' ? 'selected' : '' }}>Germany</option>
                                        <option value="Ghana" {{ old('country', $data->company->country ?? '') == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                                        <option value="Greece" {{ old('country', $data->company->country ?? '') == 'Greece' ? 'selected' : '' }}>Greece</option>
                                        <option value="Hong Kong" {{ old('country', $data->company->country ?? '') == 'Hong Kong' ? 'selected' : '' }}>Hong Kong</option>
                                        <option value="Hungary" {{ old('country', $data->company->country ?? '') == 'Hungary' ? 'selected' : '' }}>Hungary</option>
                                        <option value="India" {{ old('country', $data->company->country ?? '') == 'India' ? 'selected' : '' }}>India</option>
                                        <option value="Indonesia" {{ old('country', $data->company->country ?? '') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                        <option value="Iran" {{ old('country', $data->company->country ?? '') == 'Iran' ? 'selected' : '' }}>Iran</option>
                                        <option value="Iraq" {{ old('country', $data->company->country ?? '') == 'Iraq' ? 'selected' : '' }}>Iraq</option>
                                        <option value="Ireland" {{ old('country', $data->company->country ?? '') == 'Ireland' ? 'selected' : '' }}>Ireland</option>
                                        <option value="Israel" {{ old('country', $data->company->country ?? '') == 'Israel' ? 'selected' : '' }}>Israel</option>
                                        <option value="Italy" {{ old('country', $data->company->country ?? '') == 'Italy' ? 'selected' : '' }}>Italy</option>
                                        <option value="Japan" {{ old('country', $data->company->country ?? '') == 'Japan' ? 'selected' : '' }}>Japan</option>
                                        <option value="Jordan" {{ old('country', $data->company->country ?? '') == 'Jordan' ? 'selected' : '' }}>Jordan</option>
                                        <option value="Kenya" {{ old('country', $data->company->country ?? '') == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                                        <option value="Kuwait" {{ old('country', $data->company->country ?? '') == 'Kuwait' ? 'selected' : '' }}>Kuwait</option>
                                        <option value="Lebanon" {{ old('country', $data->company->country ?? '') == 'Lebanon' ? 'selected' : '' }}>Lebanon</option>
                                        <option value="Libya" {{ old('country', $data->company->country ?? '') == 'Libya' ? 'selected' : '' }}>Libya</option>
                                        <option value="Luxembourg" {{ old('country', $data->company->country ?? '') == 'Luxembourg' ? 'selected' : '' }}>Luxembourg</option>
                                        <option value="Malaysia" {{ old('country', $data->company->country ?? '') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                                        <option value="Mexico" {{ old('country', $data->company->country ?? '') == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                                        <option value="Morocco" {{ old('country', $data->company->country ?? '') == 'Morocco' ? 'selected' : '' }}>Morocco</option>
                                        <option value="Nepal" {{ old('country', $data->company->country ?? '') == 'Nepal' ? 'selected' : '' }}>Nepal</option>
                                        <option value="Netherlands" {{ old('country', $data->company->country ?? '') == 'Netherlands' ? 'selected' : '' }}>Netherlands</option>
                                        <option value="New Zealand" {{ old('country', $data->company->country ?? '') == 'New Zealand' ? 'selected' : '' }}>New Zealand</option>
                                        <option value="Nigeria" {{ old('country', $data->company->country ?? '') == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                                        <option value="Norway" {{ old('country', $data->company->country ?? '') == 'Norway' ? 'selected' : '' }}>Norway</option>
                                        <option value="Oman" {{ old('country', $data->company->country ?? '') == 'Oman' ? 'selected' : '' }}>Oman</option>
                                        <option value="Pakistan" {{ old('country', $data->company->country ?? '') == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                        <option value="Panama" {{ old('country', $data->company->country ?? '') == 'Panama' ? 'selected' : '' }}>Panama</option>
                                        <option value="Peru" {{ old('country', $data->company->country ?? '') == 'Peru' ? 'selected' : '' }}>Peru</option>
                                        <option value="Philippines" {{ old('country', $data->company->country ?? '') == 'Philippines' ? 'selected' : '' }}>Philippines</option>
                                        <option value="Poland" {{ old('country', $data->company->country ?? '') == 'Poland' ? 'selected' : '' }}>Poland</option>
                                        <option value="Portugal" {{ old('country', $data->company->country ?? '') == 'Portugal' ? 'selected' : '' }}>Portugal</option>
                                        <option value="Qatar" {{ old('country', $data->company->country ?? '') == 'Qatar' ? 'selected' : '' }}>Qatar</option>
                                        <option value="Romania" {{ old('country', $data->company->country ?? '') == 'Romania' ? 'selected' : '' }}>Romania</option>
                                        <option value="Russia" {{ old('country', $data->company->country ?? '') == 'Russia' ? 'selected' : '' }}>Russia</option>
                                        <option value="Saudi Arabia" {{ old('country', $data->company->country ?? '') == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
                                        <option value="Singapore" {{ old('country', $data->company->country ?? '') == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                                        <option value="South Africa" {{ old('country', $data->company->country ?? '') == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                                        <option value="South Korea" {{ old('country', $data->company->country ?? '') == 'South Korea' ? 'selected' : '' }}>South Korea</option>
                                        <option value="Spain" {{ old('country', $data->company->country ?? '') == 'Spain' ? 'selected' : '' }}>Spain</option>
                                        <option value="Sri Lanka" {{ old('country', $data->company->country ?? '') == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                                        <option value="Sweden" {{ old('country', $data->company->country ?? '') == 'Sweden' ? 'selected' : '' }}>Sweden</option>
                                        <option value="Switzerland" {{ old('country', $data->company->country ?? '') == 'Switzerland' ? 'selected' : '' }}>Switzerland</option>
                                        <option value="Thailand" {{ old('country', $data->company->country ?? '') == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                                        <option value="Turkey" {{ old('country', $data->company->country ?? '') == 'Turkey' ? 'selected' : '' }}>Turkey</option>
                                        <option value="Ukraine" {{ old('country', $data->company->country ?? '') == 'Ukraine' ? 'selected' : '' }}>Ukraine</option>
                                        <option value="United Arab Emirates" {{ old('country', $data->company->country ?? '') == 'United Arab Emirates' ? 'selected' : '' }}>United Arab Emirates</option>
                                        <option value="United Kingdom" {{ old('country', $data->company->country ?? '') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                                        <option value="United States" {{ old('country', $data->company->country ?? '') == 'United States' ? 'selected' : '' }}>United States</option>
                                        <option value="Vietnam" {{ old('country', $data->company->country ?? '') == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                                        <option value="Zimbabwe" {{ old('country', $data->company->country ?? '') == 'Zimbabwe' ? 'selected' : '' }}>Zimbabwe</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Tags <strong>*</strong></label>
                                    <select class="form-control select2" name="tags[]" multiple="multiple" required>
                                        <option value="all">All</option>
                                        @foreach($tags as $key => $value)
                                        <option value="{{ $value->id }}" {{ in_array($value->id, $data->tags->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Categories</label>
                                    <select class="form-control select2" name="categories[]" multiple="multiple">
                                        <option value="all">All</option>
                                        @foreach($categories as $key => $value)
                                        <option value="{{ $value->id }}" {{ in_array($value->id, $data->categories->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="version">Version <strong>*</strong></label>
                                    <input type="text" name="version" id="version" class="form-control" value="{{ old('version', $data->company->version) }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="issue_date">Issue Date <strong>*</strong>
                                        <div class="tooltip">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span class="tooltiptext">This date will appear in the footer of each document</span>
                                        </div>
                                    </label>
                                    <input type="date" name="issue_date" id="issue_date" class="form-control" value="{{  old('issue_data', date('Y-m-d', strtotime($data->company->issue_date))) }}" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="policy_date">Policy Issue Date
                                        <div class="tooltip right-tooltip">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span class="tooltiptext">Date appears on policy documents</span>
                                        </div>
                                    </label>
                                    <input type="date" name="policy_date" id="policy_date" class="form-control" value="{{ $data->company->policy_date != null ? date('Y-m-d', strtotime($data->company->policy_date)) : '' }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="website">Website <strong>*</strong></label>
                                    <input type="text" name="website" id="website" class="form-control" value="{{ old('website', $data->company->website) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="registration_num">Registration Number <strong>*</strong>
                                    <div class="tooltip right-tooltip">
                                        <i class="fa fa-exclamation-circle"></i>
                                        <span class="tooltiptext">Companies House Registration Number</span>
                                    </div>
                                    </label>
                                    <input type="text" name="registration_num" id="registration_num" class="form-control" value="{{ old('registration_num', $data->company->registration_num) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone_num">Phone Number <strong>*</strong></label>
                                    <input type="text" name="phone_num" id="phone_num" class="form-control" value="{{ old('phone_num', $data->company->phone_num) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_email">Company Email <strong>*</strong></label>
                                    <input type="email" name="company_email" id="company_email" class="form-control" value="{{ old('company_email', $data->company->company_email) }}" required>
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
                                    <input type="number" name="logo_width" id="logo_width" class="form-control" value="{{ old('logo_width', $data->company->logo_width) }}" required>
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
                                    <input type="number" name="logo_height" id="logo_height" class="form-control" value="{{ old('logo_height', $data->company->logo_height) }}" required>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="referred_by">Partner</label>
                                    <select name="referred_by" id="referred_by" class="form-control">
                                        <option value="">Select Partner</option>
                                        @foreach($partners as $key => $value)
                                        <option value="{{ $value->id }}" {{ $data->company->referred_by == $value->id ? 'selected' : ''}}>{{ $value->company_name }}</option>
                                        @endforeach
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
@endsection
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

    $(document).ready(function () {
        function toggleFields() {
            let consultant = $("#consultant").val();
            if (consultant) {
                $(".col-md-6, .col-md-12, .col-md-4, .col-lg-6")
                    .hide()
                    .find("input, select, textarea")
                    .each(function () {
                        if ($(this).attr("required")) {
                            $(this).data("wasRequired", true);
                            $(this).removeAttr("required");
                        }
                    });

                let fieldsToShow = [
                    "#consultant",
                    "input[name='name']",
                    "input[name='logo']",
                    "input[name='email']",
                    "input[name='phone_num']",
                    "select[name='country']"
                ];

                fieldsToShow.forEach(function (selector) {
                    let $field = $(selector).closest("[class^='col-md'], .col-lg-6");
                    $field.show();
                    $field.find("input, select, textarea").each(function () {
                        if ($(this).data("wasRequired")) {
                            $(this).attr("required", "required");
                        }
                    });
                });
            } else {
                $(".col-md-6, .col-md-12, .col-md-4, .col-lg-6")
                    .show()
                    .find("input, select, textarea")
                    .each(function () {
                        if ($(this).data("wasRequired")) {
                            $(this).attr("required", "required");
                        }
                    });
            }
        }

        toggleFields();
        $("#consultant").on("change", toggleFields);
    });
</script>
@endpush
