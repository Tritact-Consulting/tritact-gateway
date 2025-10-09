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
                                    <label>Consultant</label>
                                    <select name="consultant" id="consultant" class="form-control select2">
                                        <option value="">Select Consultant</option>
                                        @foreach($consultants as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }} - {{ $value->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Logo <strong>*</strong></label>
                                    <input type="file" name="logo" class="form-control dropify" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_id">Company ID</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <select name="prefix_company_id" class="input-group-text" id="basic-addon1">
                                                <option value="TCA" title="Tritact Clients">TCA</option>
                                                <option value="PCA" title="Private Clients">PCA</option>
                                            </select>
                                        </div>
                                        <input type="text" name="company_id" id="company_id" class="form-control" value="{{ old('company_id') }}">
                                    </div>
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
                                    <label for="address">Address <strong>*</strong></label>
                                    <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}" required>
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
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Country <strong>*</strong></label>
                                    <select name="country" id="country" class="form-control select2" required>
                                        <option value="">-- Select Country --</option>
                                        <option value="Afghanistan" {{ old('country') == 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                                        <option value="Albania" {{ old('country') == 'Albania' ? 'selected' : '' }}>Albania</option>
                                        <option value="Algeria" {{ old('country') == 'Algeria' ? 'selected' : '' }}>Algeria</option>
                                        <option value="Andorra" {{ old('country') == 'Andorra' ? 'selected' : '' }}>Andorra</option>
                                        <option value="Angola" {{ old('country') == 'Angola' ? 'selected' : '' }}>Angola</option>
                                        <option value="Antigua and Barbuda" {{ old('country') == 'Antigua and Barbuda' ? 'selected' : '' }}>Antigua and Barbuda</option>
                                        <option value="Argentina" {{ old('country') == 'Argentina' ? 'selected' : '' }}>Argentina</option>
                                        <option value="Armenia" {{ old('country') == 'Armenia' ? 'selected' : '' }}>Armenia</option>
                                        <option value="Australia" {{ old('country') == 'Australia' ? 'selected' : '' }}>Australia</option>
                                        <option value="Austria" {{ old('country') == 'Austria' ? 'selected' : '' }}>Austria</option>
                                        <option value="Azerbaijan" {{ old('country') == 'Azerbaijan' ? 'selected' : '' }}>Azerbaijan</option>
                                        <option value="Bahamas" {{ old('country') == 'Bahamas' ? 'selected' : '' }}>Bahamas</option>
                                        <option value="Bahrain" {{ old('country') == 'Bahrain' ? 'selected' : '' }}>Bahrain</option>
                                        <option value="Bangladesh" {{ old('country') == 'Bangladesh' ? 'selected' : '' }}>Bangladesh</option>
                                        <option value="Barbados" {{ old('country') == 'Barbados' ? 'selected' : '' }}>Barbados</option>
                                        <option value="Belarus" {{ old('country') == 'Belarus' ? 'selected' : '' }}>Belarus</option>
                                        <option value="Belgium" {{ old('country') == 'Belgium' ? 'selected' : '' }}>Belgium</option>
                                        <option value="Belize" {{ old('country') == 'Belize' ? 'selected' : '' }}>Belize</option>
                                        <option value="Benin" {{ old('country') == 'Benin' ? 'selected' : '' }}>Benin</option>
                                        <option value="Bhutan" {{ old('country') == 'Bhutan' ? 'selected' : '' }}>Bhutan</option>
                                        <option value="Bolivia" {{ old('country') == 'Bolivia' ? 'selected' : '' }}>Bolivia</option>
                                        <option value="Bosnia and Herzegovina" {{ old('country') == 'Bosnia and Herzegovina' ? 'selected' : '' }}>Bosnia and Herzegovina</option>
                                        <option value="Botswana" {{ old('country') == 'Botswana' ? 'selected' : '' }}>Botswana</option>
                                        <option value="Brazil" {{ old('country') == 'Brazil' ? 'selected' : '' }}>Brazil</option>
                                        <option value="Brunei" {{ old('country') == 'Brunei' ? 'selected' : '' }}>Brunei</option>
                                        <option value="Bulgaria" {{ old('country') == 'Bulgaria' ? 'selected' : '' }}>Bulgaria</option>
                                        <option value="Burkina Faso" {{ old('country') == 'Burkina Faso' ? 'selected' : '' }}>Burkina Faso</option>
                                        <option value="Burundi" {{ old('country') == 'Burundi' ? 'selected' : '' }}>Burundi</option>
                                        <option value="Cabo Verde" {{ old('country') == 'Cabo Verde' ? 'selected' : '' }}>Cabo Verde</option>
                                        <option value="Cambodia" {{ old('country') == 'Cambodia' ? 'selected' : '' }}>Cambodia</option>
                                        <option value="Cameroon" {{ old('country') == 'Cameroon' ? 'selected' : '' }}>Cameroon</option>
                                        <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada</option>
                                        <option value="Central African Republic" {{ old('country') == 'Central African Republic' ? 'selected' : '' }}>Central African Republic</option>
                                        <option value="Chad" {{ old('country') == 'Chad' ? 'selected' : '' }}>Chad</option>
                                        <option value="Chile" {{ old('country') == 'Chile' ? 'selected' : '' }}>Chile</option>
                                        <option value="China" {{ old('country') == 'China' ? 'selected' : '' }}>China</option>
                                        <option value="Colombia" {{ old('country') == 'Colombia' ? 'selected' : '' }}>Colombia</option>
                                        <option value="Comoros" {{ old('country') == 'Comoros' ? 'selected' : '' }}>Comoros</option>
                                        <option value="Congo, Democratic Republic of the" {{ old('country') == 'Congo, Democratic Republic of the' ? 'selected' : '' }}>Congo, Democratic Republic of the</option>
                                        <option value="Congo, Republic of the" {{ old('country') == 'Congo, Republic of the' ? 'selected' : '' }}>Congo, Republic of the</option>
                                        <option value="Costa Rica" {{ old('country') == 'Costa Rica' ? 'selected' : '' }}>Costa Rica</option>
                                        <option value="Croatia" {{ old('country') == 'Croatia' ? 'selected' : '' }}>Croatia</option>
                                        <option value="Cuba" {{ old('country') == 'Cuba' ? 'selected' : '' }}>Cuba</option>
                                        <option value="Cyprus" {{ old('country') == 'Cyprus' ? 'selected' : '' }}>Cyprus</option>
                                        <option value="Czech Republic" {{ old('country') == 'Czech Republic' ? 'selected' : '' }}>Czech Republic</option>
                                        <option value="Denmark" {{ old('country') == 'Denmark' ? 'selected' : '' }}>Denmark</option>
                                        <option value="Djibouti" {{ old('country') == 'Djibouti' ? 'selected' : '' }}>Djibouti</option>
                                        <option value="Dominica" {{ old('country') == 'Dominica' ? 'selected' : '' }}>Dominica</option>
                                        <option value="Dominican Republic" {{ old('country') == 'Dominican Republic' ? 'selected' : '' }}>Dominican Republic</option>
                                        <option value="Ecuador" {{ old('country') == 'Ecuador' ? 'selected' : '' }}>Ecuador</option>
                                        <option value="Egypt" {{ old('country') == 'Egypt' ? 'selected' : '' }}>Egypt</option>
                                        <option value="El Salvador" {{ old('country') == 'El Salvador' ? 'selected' : '' }}>El Salvador</option>
                                        <option value="Equatorial Guinea" {{ old('country') == 'Equatorial Guinea' ? 'selected' : '' }}>Equatorial Guinea</option>
                                        <option value="Eritrea" {{ old('country') == 'Eritrea' ? 'selected' : '' }}>Eritrea</option>
                                        <option value="Estonia" {{ old('country') == 'Estonia' ? 'selected' : '' }}>Estonia</option>
                                        <option value="Eswatini" {{ old('country') == 'Eswatini' ? 'selected' : '' }}>Eswatini</option>
                                        <option value="Ethiopia" {{ old('country') == 'Ethiopia' ? 'selected' : '' }}>Ethiopia</option>
                                        <option value="Fiji" {{ old('country') == 'Fiji' ? 'selected' : '' }}>Fiji</option>
                                        <option value="Finland" {{ old('country') == 'Finland' ? 'selected' : '' }}>Finland</option>
                                        <option value="France" {{ old('country') == 'France' ? 'selected' : '' }}>France</option>
                                        <option value="Gabon" {{ old('country') == 'Gabon' ? 'selected' : '' }}>Gabon</option>
                                        <option value="Gambia" {{ old('country') == 'Gambia' ? 'selected' : '' }}>Gambia</option>
                                        <option value="Georgia" {{ old('country') == 'Georgia' ? 'selected' : '' }}>Georgia</option>
                                        <option value="Germany" {{ old('country') == 'Germany' ? 'selected' : '' }}>Germany</option>
                                        <option value="Ghana" {{ old('country') == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                                        <option value="Greece" {{ old('country') == 'Greece' ? 'selected' : '' }}>Greece</option>
                                        <option value="Grenada" {{ old('country') == 'Grenada' ? 'selected' : '' }}>Grenada</option>
                                        <option value="Guatemala" {{ old('country') == 'Guatemala' ? 'selected' : '' }}>Guatemala</option>
                                        <option value="Guinea" {{ old('country') == 'Guinea' ? 'selected' : '' }}>Guinea</option>
                                        <option value="Guinea-Bissau" {{ old('country') == 'Guinea-Bissau' ? 'selected' : '' }}>Guinea-Bissau</option>
                                        <option value="Guyana" {{ old('country') == 'Guyana' ? 'selected' : '' }}>Guyana</option>
                                        <option value="Haiti" {{ old('country') == 'Haiti' ? 'selected' : '' }}>Haiti</option>
                                        <option value="Honduras" {{ old('country') == 'Honduras' ? 'selected' : '' }}>Honduras</option>
                                        <option value="Hungary" {{ old('country') == 'Hungary' ? 'selected' : '' }}>Hungary</option>
                                        <option value="Iceland" {{ old('country') == 'Iceland' ? 'selected' : '' }}>Iceland</option>
                                        <option value="India" {{ old('country') == 'India' ? 'selected' : '' }}>India</option>
                                        <option value="Indonesia" {{ old('country') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                                        <option value="Iran" {{ old('country') == 'Iran' ? 'selected' : '' }}>Iran</option>
                                        <option value="Iraq" {{ old('country') == 'Iraq' ? 'selected' : '' }}>Iraq</option>
                                        <option value="Ireland" {{ old('country') == 'Ireland' ? 'selected' : '' }}>Ireland</option>
                                        <option value="Israel" {{ old('country') == 'Israel' ? 'selected' : '' }}>Israel</option>
                                        <option value="Italy" {{ old('country') == 'Italy' ? 'selected' : '' }}>Italy</option>
                                        <option value="Jamaica" {{ old('country') == 'Jamaica' ? 'selected' : '' }}>Jamaica</option>
                                        <option value="Japan" {{ old('country') == 'Japan' ? 'selected' : '' }}>Japan</option>
                                        <option value="Jordan" {{ old('country') == 'Jordan' ? 'selected' : '' }}>Jordan</option>
                                        <option value="Kazakhstan" {{ old('country') == 'Kazakhstan' ? 'selected' : '' }}>Kazakhstan</option>
                                        <option value="Kenya" {{ old('country') == 'Kenya' ? 'selected' : '' }}>Kenya</option>
                                        <option value="Kiribati" {{ old('country') == 'Kiribati' ? 'selected' : '' }}>Kiribati</option>
                                        <option value="Kuwait" {{ old('country') == 'Kuwait' ? 'selected' : '' }}>Kuwait</option>
                                        <option value="Kyrgyzstan" {{ old('country') == 'Kyrgyzstan' ? 'selected' : '' }}>Kyrgyzstan</option>
                                        <option value="Laos" {{ old('country') == 'Laos' ? 'selected' : '' }}>Laos</option>
                                        <option value="Latvia" {{ old('country') == 'Latvia' ? 'selected' : '' }}>Latvia</option>
                                        <option value="Lebanon" {{ old('country') == 'Lebanon' ? 'selected' : '' }}>Lebanon</option>
                                        <option value="Lesotho" {{ old('country') == 'Lesotho' ? 'selected' : '' }}>Lesotho</option>
                                        <option value="Liberia" {{ old('country') == 'Liberia' ? 'selected' : '' }}>Liberia</option>
                                        <option value="Libya" {{ old('country') == 'Libya' ? 'selected' : '' }}>Libya</option>
                                        <option value="Liechtenstein" {{ old('country') == 'Liechtenstein' ? 'selected' : '' }}>Liechtenstein</option>
                                        <option value="Lithuania" {{ old('country') == 'Lithuania' ? 'selected' : '' }}>Lithuania</option>
                                        <option value="Luxembourg" {{ old('country') == 'Luxembourg' ? 'selected' : '' }}>Luxembourg</option>
                                        <option value="Madagascar" {{ old('country') == 'Madagascar' ? 'selected' : '' }}>Madagascar</option>
                                        <option value="Malawi" {{ old('country') == 'Malawi' ? 'selected' : '' }}>Malawi</option>
                                        <option value="Malaysia" {{ old('country') == 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                                        <option value="Maldives" {{ old('country') == 'Maldives' ? 'selected' : '' }}>Maldives</option>
                                        <option value="Mali" {{ old('country') == 'Mali' ? 'selected' : '' }}>Mali</option>
                                        <option value="Malta" {{ old('country') == 'Malta' ? 'selected' : '' }}>Malta</option>
                                        <option value="Marshall Islands" {{ old('country') == 'Marshall Islands' ? 'selected' : '' }}>Marshall Islands</option>
                                        <option value="Mauritania" {{ old('country') == 'Mauritania' ? 'selected' : '' }}>Mauritania</option>
                                        <option value="Mauritius" {{ old('country') == 'Mauritius' ? 'selected' : '' }}>Mauritius</option>
                                        <option value="Mexico" {{ old('country') == 'Mexico' ? 'selected' : '' }}>Mexico</option>
                                        <option value="Micronesia" {{ old('country') == 'Micronesia' ? 'selected' : '' }}>Micronesia</option>
                                        <option value="Moldova" {{ old('country') == 'Moldova' ? 'selected' : '' }}>Moldova</option>
                                        <option value="Monaco" {{ old('country') == 'Monaco' ? 'selected' : '' }}>Monaco</option>
                                        <option value="Mongolia" {{ old('country') == 'Mongolia' ? 'selected' : '' }}>Mongolia</option>
                                        <option value="Montenegro" {{ old('country') == 'Montenegro' ? 'selected' : '' }}>Montenegro</option>
                                        <option value="Morocco" {{ old('country') == 'Morocco' ? 'selected' : '' }}>Morocco</option>
                                        <option value="Mozambique" {{ old('country') == 'Mozambique' ? 'selected' : '' }}>Mozambique</option>
                                        <option value="Myanmar" {{ old('country') == 'Myanmar' ? 'selected' : '' }}>Myanmar</option>
                                        <option value="Namibia" {{ old('country') == 'Namibia' ? 'selected' : '' }}>Namibia</option>
                                        <option value="Nauru" {{ old('country') == 'Nauru' ? 'selected' : '' }}>Nauru</option>
                                        <option value="Nepal" {{ old('country') == 'Nepal' ? 'selected' : '' }}>Nepal</option>
                                        <option value="Netherlands" {{ old('country') == 'Netherlands' ? 'selected' : '' }}>Netherlands</option>
                                        <option value="New Zealand" {{ old('country') == 'New Zealand' ? 'selected' : '' }}>New Zealand</option>
                                        <option value="Nicaragua" {{ old('country') == 'Nicaragua' ? 'selected' : '' }}>Nicaragua</option>
                                        <option value="Niger" {{ old('country') == 'Niger' ? 'selected' : '' }}>Niger</option>
                                        <option value="Nigeria" {{ old('country') == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                                        <option value="North Korea" {{ old('country') == 'North Korea' ? 'selected' : '' }}>North Korea</option>
                                        <option value="North Macedonia" {{ old('country') == 'North Macedonia' ? 'selected' : '' }}>North Macedonia</option>
                                        <option value="Norway" {{ old('country') == 'Norway' ? 'selected' : '' }}>Norway</option>
                                        <option value="Oman" {{ old('country') == 'Oman' ? 'selected' : '' }}>Oman</option>
                                        <option value="Pakistan" {{ old('country') == 'Pakistan' ? 'selected' : '' }}>Pakistan</option>
                                        <option value="Palau" {{ old('country') == 'Palau' ? 'selected' : '' }}>Palau</option>
                                        <option value="Palestine" {{ old('country') == 'Palestine' ? 'selected' : '' }}>Palestine</option>
                                        <option value="Panama" {{ old('country') == 'Panama' ? 'selected' : '' }}>Panama</option>
                                        <option value="Papua New Guinea" {{ old('country') == 'Papua New Guinea' ? 'selected' : '' }}>Papua New Guinea</option>
                                        <option value="Paraguay" {{ old('country') == 'Paraguay' ? 'selected' : '' }}>Paraguay</option>
                                        <option value="Peru" {{ old('country') == 'Peru' ? 'selected' : '' }}>Peru</option>
                                        <option value="Philippines" {{ old('country') == 'Philippines' ? 'selected' : '' }}>Philippines</option>
                                        <option value="Poland" {{ old('country') == 'Poland' ? 'selected' : '' }}>Poland</option>
                                        <option value="Portugal" {{ old('country') == 'Portugal' ? 'selected' : '' }}>Portugal</option>
                                        <option value="Qatar" {{ old('country') == 'Qatar' ? 'selected' : '' }}>Qatar</option>
                                        <option value="Romania" {{ old('country') == 'Romania' ? 'selected' : '' }}>Romania</option>
                                        <option value="Russia" {{ old('country') == 'Russia' ? 'selected' : '' }}>Russia</option>
                                        <option value="Rwanda" {{ old('country') == 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
                                        <option value="Saint Kitts and Nevis" {{ old('country') == 'Saint Kitts and Nevis' ? 'selected' : '' }}>Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia" {{ old('country') == 'Saint Lucia' ? 'selected' : '' }}>Saint Lucia</option>
                                        <option value="Saint Vincent and the Grenadines" {{ old('country') == 'Saint Vincent and the Grenadines' ? 'selected' : '' }}>Saint Vincent and the Grenadines</option>
                                        <option value="Samoa" {{ old('country') == 'Samoa' ? 'selected' : '' }}>Samoa</option>
                                        <option value="San Marino" {{ old('country') == 'San Marino' ? 'selected' : '' }}>San Marino</option>
                                        <option value="Sao Tome and Principe" {{ old('country') == 'Sao Tome and Principe' ? 'selected' : '' }}>Sao Tome and Principe</option>
                                        <option value="Saudi Arabia" {{ old('country') == 'Saudi Arabia' ? 'selected' : '' }}>Saudi Arabia</option>
                                        <option value="Senegal" {{ old('country') == 'Senegal' ? 'selected' : '' }}>Senegal</option>
                                        <option value="Serbia" {{ old('country') == 'Serbia' ? 'selected' : '' }}>Serbia</option>
                                        <option value="Seychelles" {{ old('country') == 'Seychelles' ? 'selected' : '' }}>Seychelles</option>
                                        <option value="Sierra Leone" {{ old('country') == 'Sierra Leone' ? 'selected' : '' }}>Sierra Leone</option>
                                        <option value="Singapore" {{ old('country') == 'Singapore' ? 'selected' : '' }}>Singapore</option>
                                        <option value="Slovakia" {{ old('country') == 'Slovakia' ? 'selected' : '' }}>Slovakia</option>
                                        <option value="Slovenia" {{ old('country') == 'Slovenia' ? 'selected' : '' }}>Slovenia</option>
                                        <option value="Solomon Islands" {{ old('country') == 'Solomon Islands' ? 'selected' : '' }}>Solomon Islands</option>
                                        <option value="Somalia" {{ old('country') == 'Somalia' ? 'selected' : '' }}>Somalia</option>
                                        <option value="South Africa" {{ old('country') == 'South Africa' ? 'selected' : '' }}>South Africa</option>
                                        <option value="South Korea" {{ old('country') == 'South Korea' ? 'selected' : '' }}>South Korea</option>
                                        <option value="South Sudan" {{ old('country') == 'South Sudan' ? 'selected' : '' }}>South Sudan</option>
                                        <option value="Spain" {{ old('country') == 'Spain' ? 'selected' : '' }}>Spain</option>
                                        <option value="Sri Lanka" {{ old('country') == 'Sri Lanka' ? 'selected' : '' }}>Sri Lanka</option>
                                        <option value="Sudan" {{ old('country') == 'Sudan' ? 'selected' : '' }}>Sudan</option>
                                        <option value="Suriname" {{ old('country') == 'Suriname' ? 'selected' : '' }}>Suriname</option>
                                        <option value="Sweden" {{ old('country') == 'Sweden' ? 'selected' : '' }}>Sweden</option>
                                        <option value="Switzerland" {{ old('country') == 'Switzerland' ? 'selected' : '' }}>Switzerland</option>
                                        <option value="Syria" {{ old('country') == 'Syria' ? 'selected' : '' }}>Syria</option>
                                        <option value="Taiwan" {{ old('country') == 'Taiwan' ? 'selected' : '' }}>Taiwan</option>
                                        <option value="Tajikistan" {{ old('country') == 'Tajikistan' ? 'selected' : '' }}>Tajikistan</option>
                                        <option value="Tanzania" {{ old('country') == 'Tanzania' ? 'selected' : '' }}>Tanzania</option>
                                        <option value="Thailand" {{ old('country') == 'Thailand' ? 'selected' : '' }}>Thailand</option>
                                        <option value="Timor-Leste" {{ old('country') == 'Timor-Leste' ? 'selected' : '' }}>Timor-Leste</option>
                                        <option value="Togo" {{ old('country') == 'Togo' ? 'selected' : '' }}>Togo</option>
                                        <option value="Tonga" {{ old('country') == 'Tonga' ? 'selected' : '' }}>Tonga</option>
                                        <option value="Trinidad and Tobago" {{ old('country') == 'Trinidad and Tobago' ? 'selected' : '' }}>Trinidad and Tobago</option>
                                        <option value="Tunisia" {{ old('country') == 'Tunisia' ? 'selected' : '' }}>Tunisia</option>
                                        <option value="Turkey" {{ old('country') == 'Turkey' ? 'selected' : '' }}>Turkey</option>
                                        <option value="Turkmenistan" {{ old('country') == 'Turkmenistan' ? 'selected' : '' }}>Turkmenistan</option>
                                        <option value="Tuvalu" {{ old('country') == 'Tuvalu' ? 'selected' : '' }}>Tuvalu</option>
                                        <option value="Uganda" {{ old('country') == 'Uganda' ? 'selected' : '' }}>Uganda</option>
                                        <option value="Ukraine" {{ old('country') == 'Ukraine' ? 'selected' : '' }}>Ukraine</option>
                                        <option value="United Arab Emirates" {{ old('country') == 'United Arab Emirates' ? 'selected' : '' }}>United Arab Emirates</option>
                                        <option value="United Kingdom" {{ old('country') == 'United Kingdom' ? 'selected' : '' }}>United Kingdom</option>
                                        <option value="United States" {{ old('country') == 'United States' ? 'selected' : '' }}>United States</option>
                                        <option value="Uruguay" {{ old('country') == 'Uruguay' ? 'selected' : '' }}>Uruguay</option>
                                        <option value="Uzbekistan" {{ old('country') == 'Uzbekistan' ? 'selected' : '' }}>Uzbekistan</option>
                                        <option value="Vanuatu" {{ old('country') == 'Vanuatu' ? 'selected' : '' }}>Vanuatu</option>
                                        <option value="Vatican City" {{ old('country') == 'Vatican City' ? 'selected' : '' }}>Vatican City</option>
                                        <option value="Venezuela" {{ old('country') == 'Venezuela' ? 'selected' : '' }}>Venezuela</option>
                                        <option value="Vietnam" {{ old('country') == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                                        <option value="Yemen" {{ old('country') == 'Yemen' ? 'selected' : '' }}>Yemen</option>
                                        <option value="Zambia" {{ old('country') == 'Zambia' ? 'selected' : '' }}>Zambia</option>
                                        <option value="Zimbabwe" {{ old('country') == 'Zimbabwe' ? 'selected' : '' }}>Zimbabwe</option>
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
                                    <label>Categories</label>
                                    <select class="form-control select2" name="categories[]" multiple="multiple">
                                        <option value="all">All</option>
                                        @foreach($categories as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="version">Version <strong>*</strong></label>
                                    <input type="text" name="version" id="version" class="form-control" value="{{ old('version') }}" required>
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
                                    <input type="date" name="issue_date" id="issue_date" class="form-control" value="{{ old('issue_date') }}" required>
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
                                    <input type="date" name="policy_date" id="policy_date" class="form-control" value="{{ old('policy_date') }}">
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
                                    <label for="registration_num">Registration Number <strong>*</strong>
                                        <div class="tooltip right-tooltip">
                                            <i class="fa fa-exclamation-circle"></i>
                                            <span class="tooltiptext">Companies House Registration Number</span>
                                        </div>
                                    </label>
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
                                        <option value="{{ $value->id }}">{{ $value->company_name }}</option>
                                        @endforeach
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
<script>
$(document).ready(function () {
    function toggleFields() {
        let consultant = $("#consultant").val();
        if (consultant) {
            $(".col-md-6, .col-md-12, .col-md-4, .col-lg-6")
                .hide()
                .find("input, select, textarea")
                .each(function () {
                    // Store original required in data attr
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

    $("#consultant").on("change", function () {
        toggleFields();
    });
});
</script>
@endpush