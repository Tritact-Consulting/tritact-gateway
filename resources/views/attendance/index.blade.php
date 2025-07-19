@extends($layout)

@section('title', 'Attendance')
@section('content')
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Attendance List</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Attendance</li>
                        <li class="breadcrumb-item active" aria-current="page">Attendance list</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
@php
$check_attendance = App\Models\Attendances::where('user_id', Auth::user()->id)->latest()->first();
if ($check_attendance == null) {
    $timedin = 0;
    $timedout = 0;
} else {
    if ((time() - $check_attendance->timein) < 40000) {
        if ($check_attendance->timein != NULL && $check_attendance->timeout == NULL) {
            $timedin = 1;
            $timedout = 0;
        } else {
            $timedin = 1;
            $timedout = 1;
        }
    } else {
        $timedin = 0;
        $timedout = 0;
    }
}
$user = App\Models\User::where('id',Auth::user()->id)->first();
@endphp
<!-- /.content -->
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-body text-right">
                    @if ($timedin == 0 && $timedout == 0)
                        <form action="{{ route('attendance.timeIn') }}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-success">Check In</button>
                        </form>
                    @elseif($timedin == 1 && $timedout == 0)
                        <button type="button" class="btn btn-danger timeout"
                            rel="{{ $attendance->timein + 32400 }}">Checkout</button>
                        <h5 class="mb-0"><span id="demo"></span></h5>
                    @else
                        <h5>Your Today's Working Hours are <b>{{ gmdate('H:i:s', $attendance->totalhours) }}</b>
                        </h5>
                    @endif
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
                                @foreach ($attendance as $thisattendance)
                                <tr class="{{ $thisattendance['status'] == 'weekend' ? 'alert alert-danger' : ''}}">
                                    <td>{{ $thisattendance['date'] }}</td>
                                    <td>{{ $thisattendance['day'] }}</td>
                                    <td>{{ $thisattendance['timein'] != '-' ? date('h:i:s A', $thisattendance['timein']) : '-' }}</td>
                                    <td>{{ $thisattendance['timeout'] != '-' ? date('h:i:s A', $thisattendance['timeout']) : '-' }}</td>
                                    <td>{{ $thisattendance['totalhours'] != '-' ? gmdate('H:i:s', $thisattendance['totalhours']) : '-' }}</td>
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection