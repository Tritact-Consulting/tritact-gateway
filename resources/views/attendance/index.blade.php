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
                        <li class="breadcrumb-item">Attendance</li>
                        <li class="breadcrumb-item active">Attendance list</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

@php
$check_attendance = App\Models\Attendances::with('breaks')->where('user_id', Auth::id())->latest()->first();

$timedin = $timedout = 0;
$break_started = 0;

if ($check_attendance) {
    if ((time() - $check_attendance->timein) < 40000) {
        if ($check_attendance->timein && !$check_attendance->timeout) {
            $timedin = 1;
            $timedout = 0;
        } else {
            $timedin = 1;
            $timedout = 1;
        }
    }

    // detect if an active break exists
    $activeBreak = $check_attendance->breaks->whereNull('break_end')->first();
    if ($activeBreak) {
        $break_started = 1;
    }
}

$user = App\Models\User::find(Auth::id());
@endphp

<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-body text-right d-flex" style="justify-content: end; align-items: center; flex-direction: row-reverse; gap: 15px;">
                    @if ($timedin == 0 && $timedout == 0)
                        {{-- Check In --}}
                        <form action="{{ route('attendance.timeIn') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Check In</button>
                        </form>

                    @elseif ($timedin == 1 && $timedout == 0)
                        {{-- Break buttons --}}
                        @if ($break_started == 0)
                            <form action="{{ route('attendance.breakStart') }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-warning">Start Break</button>
                            </form>
                        @else
                            <form action="{{ route('attendance.breakEnd') }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-info">End Break</button>
                            </form>
                        @endif

                        {{-- Checkout --}}
                        <button type="button" class="btn btn-danger timeout" rel="{{ $check_attendance->timein + 32400 }}">Checkout</button>
                        <h5 class="mb-0"><span id="demo"></span></h5>

                    @else
                        <h5>Your Today's Working Hours are <b>{{ $todayWorked }}</b></h5>
                    @endif
                </div>
            </div>

            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Today's Attendance</h4>
                </div>
                <div class="box-body">
                    <div class="table-responsive rounded card-table">
                        <table class="table table-striped border-no document-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Day</th>
                                    <th>Time In</th>
                                    <th>Time Out</th>
                                    <th>Breaks</th>
                                    <th>Working Hours</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $today = date('d-M-Y');
                                    $todayRecord = collect($attendance)->firstWhere('date', $today);
                                @endphp

                                @if($todayRecord)
                                    <tr>
                                        <td>{{ $todayRecord['date'] }}</td>
                                        <td>{{ $todayRecord['day'] }}</td>
                                        <td>{{ $todayRecord['timein'] ?? '-' }}</td>
                                        <td>{{ $todayRecord['timeout'] ?? '-' }}</td>
                                        <td>
                                            @if (!empty($todayRecord['breaks']) && is_array($todayRecord['breaks']) && count($todayRecord['breaks']) > 0)
                                                @foreach ($todayRecord['breaks'] as $break)
                                                    {{ $break['start'] ?? '-' }} - {{ $break['end'] ?? '-' }}<br>
                                                @endforeach
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>{{ $todayRecord['totalhours'] ?? '-' }}</td>
                                        <td>{{ $todayRecord['status'] }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center">No attendance record for today</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="box-body">
                    <div class="table-responsive rounded card-table">
                        <table class="table table-striped border-no document-table" id="example1">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Day</th>
                                    <th>Timein</th>
                                    <th>Timeout</th>
                                    <th>Breaks</th>
                                    <th>Working Hours</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($attendance as $thisattendance)
                                <tr class="{{ $thisattendance['status'] == 'Weekend' ? 'alert alert-danger' : '' }} {{ $thisattendance['status'] == 'Today' ? 'alert alert-info' : '' }}">
                                    <td>{{ $thisattendance['date'] }}</td>
                                    <td>{{ substr($thisattendance['day'], 0, 3) }}</td>
                                    <td>{{ $thisattendance['timein'] ?? '-' }}</td>
                                    <td>{{ $thisattendance['timeout'] ?? '-' }}</td>
                                    <td>
                                        @if (!empty($thisattendance['breaks']) && is_array($thisattendance['breaks']) && count($thisattendance['breaks']) > 0)
                                            @foreach ($thisattendance['breaks'] as $break)
                                                {{ $break['start'] ?? '-' }} - {{ $break['end'] ?? '-' }}<br>
                                            @endforeach
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $thisattendance['totalhours'] ?? '-' }}</td>
                                    <td>
                                        <span>{{ $thisattendance['status'] }}</span>
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
@if($check_attendance)
<script>
    var countDownDate = new Date("{{ date('M d, Y H:i:s', $check_attendance->timein) }}").getTime();

    if (document.getElementById("demo")) {
        setInterval(function() {
            var now = new Date().getTime();
            var distance = now - countDownDate;

            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("demo").innerHTML = hours + "h " + minutes + "m " + seconds + "s";
        }, 1000);
    }
</script>

<script type="text/javascript">
    $(document).on('click', '.timeout', function(e) {
        e.preventDefault();
        var timein = $(this).attr('rel') + "000";
        var now = new Date().getTime();
        var remaining = timein - now;

        var hours = Math.floor((remaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((remaining % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((remaining % (1000 * 60)) / 1000);

        Swal.fire({
            title: "Are you sure you want to Timeout?",
            text: "Hours Remaining (0" + hours + ":" + minutes + ":" + seconds + "). You cannot revert it back!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes!'
        }).then(function() {
            $.ajax({
                url: "{{ route('attendance.timeOut') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: { type: 'timeout' },
                success: function(result) {
                    Swal.fire('Timed out!', 'You are timed out successfully!', 'success');
                    setTimeout(function() { location.reload(); }, 2000);
                }
            });
        });
    });
</script>
@endif
@endpush
