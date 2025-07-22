@extends('layouts.admin-app')

@section('title', 'All Attendance')
@section('content')
<style>
    .select2-container .select2-selection--single .select2-selection__rendered{
        text-align: left;
    }
</style>
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Attendance List</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">All Attendance</li>
                        <li class="breadcrumb-item active" aria-current="page">All Attendance list</li>
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
                <div class="box-body text-right">
                    <form action="{{ route('all-attendance.index') }}" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="user" id="user" class="form-control select2">
                                    <option value="">Select User</option>
                                    @foreach($users as $key => $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="month" id="month" class="form-control select2">
                                    <option value="1" {{ now()->month == 1 ? 'selected' : '' }}>January</option>
                                    <option value="2" {{ now()->month == 2 ? 'selected' : '' }}>February</option>
                                    <option value="3" {{ now()->month == 3 ? 'selected' : '' }}>March</option>
                                    <option value="4" {{ now()->month == 4 ? 'selected' : '' }}>April</option>
                                    <option value="5" {{ now()->month == 5 ? 'selected' : '' }}>May</option>
                                    <option value="6" {{ now()->month == 6 ? 'selected' : '' }}>June</option>
                                    <option value="7" {{ now()->month == 7 ? 'selected' : '' }}>July</option>
                                    <option value="8" {{ now()->month == 8 ? 'selected' : '' }}>August</option>
                                    <option value="9" {{ now()->month == 9 ? 'selected' : '' }}>September</option>
                                    <option value="10" {{ now()->month == 10 ? 'selected' : '' }}>October</option>
                                    <option value="11" {{ now()->month == 11 ? 'selected' : '' }}>November</option>
                                    <option value="12" {{ now()->month == 12 ? 'selected' : '' }}>December</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <select name="year" id="year" class="form-control select2">
                                    <option value="2025">2025</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-primary btn-sm" style="width: 100%;">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
			<div class="box">
			    <div class="box-body">
				    <div class="table-responsive rounded card-table">
                        <table class="table table-striped border-no document-table" id="example1">
                            <thead>
                                <tr>
                                    <th>Day</th>
                                    <th>Date</th>
                                    <th>Timein</th>
                                    <th>Timeout</th>
                                    <th>Working Hours</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($attendance))
                                @foreach ($attendance as $thisattendance)
                                <tr class="{{ $thisattendance['status'] == 'weekend' ? 'alert alert-danger' : ''}} {{ $thisattendance['status'] == 'today' ? 'alert alert-info' : ''}}">
                                    <td>{{ $thisattendance['date'] }}</td>
                                    <td>{{ $thisattendance['day'] }}</td>
                                    <td>{{ $thisattendance['timein'] != '-' ? $thisattendance['timein'] : '-' }}</td>
                                    <td>{{ $thisattendance['timeout'] != '-' ? $thisattendance['timeout'] : '-' }}</td>
                                    <td>{{ $thisattendance['totalhours'] != '-' ? $thisattendance['totalhours'] : '-' }}</td>
                                    <td>
                                        @if ($thisattendance['status'] == 'late' || $thisattendance['status'] == 'early')
                                        {{ ucwords($thisattendance['status']) }} Check
                                        {{ $thisattendance['status'] == 'late' ? 'In' : 'Out' }}
                                        @else
                                        <span>{{ $thisattendance['name'] }} </span>
                                        @endif
                                    </td>
                                    <td></td>
                                </tr>
                                @endforeach
                                @endif
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

@endpush