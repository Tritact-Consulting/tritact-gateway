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
                <div class="box-body text-right d-flex" style="justify-content: end;align-items: center;flex-direction: row-reverse;gap: 15px;">
                    @if ($timedin == 0 && $timedout == 0)
                        <form action="{{ route('attendance.timeIn') }}" method="POST">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-success">Check In</button>
                        </form>

                    @elseif($timedin == 1 && $timedout == 0)
                        {{-- If break has not started yet --}}
                        @if ($break_started == 0)
                            <form action="{{ route('attendance.breakStart') }}" method="POST" style="display:inline-block;">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-warning">Start Break</button>
                            </form>
                        @else
                            <form action="{{ route('attendance.breakEnd') }}" method="POST" style="display:inline-block;">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-info">End Break</button>
                            </form>
                        @endif

                        <button type="button" class="btn btn-danger timeout"
                            rel="{{ $check_attendance->timein + 32400 }}">Checkout</button>
                        <h5 class="mb-0"><span id="demo"></span></h5>

                    @else
                        <h5>Your Today's Working Hours are 
                            <b>{{ gmdate('H:i:s', $check_attendance->totalhours) }}</b>
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
@if($check_attendance != null)
<script>
    // Set the date we're counting down to
    var countDownDate = new Date("{{ date('M d,y H:i:s', $check_attendance->timein) }}").getTime();
    
    if(document.getElementById("demo"))
    {
        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();

            // Find the distance between now and the count down date
            var distance = now - countDownDate;
            // Time calculations for days, hours, minutes and seconds
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display the result in the element with id="demo"
            document.getElementById("demo").innerHTML = hours + "h " +
                minutes + "m " + seconds + "s ";

            // If the count down is finished, write some text
            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }
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
        // Display the result in the element with id="demo"
        swal({
            title: "Are you sure you want to Timeout?",
            text: "Hours Remaining (0" + hours + ":" + minutes + ":" + seconds +
                ") .You cannot revert it back!",
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
                data: {
                    type: 'timeout'
                },
                success: function(result) {
                    swal(
                        'Timedout!',
                        'You are timedout successfully!',
                        'success'

                    )
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }

            })
        }, function(result) {
            if (result === 'cancel') {}
        })
    })
</script>
@endif
@endpush