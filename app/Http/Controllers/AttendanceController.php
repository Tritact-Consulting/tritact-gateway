<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\CompanyCertification;
use App\Models\CertificationCategory;
use App\Models\Auditor;
use App\Models\Category;
use App\Models\Attendances;
use App\Models\User;
use File;
use Illuminate\Support\Str;
use Response;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $userId = Auth::id();
        $month = date('m');
        $year  = date('Y');

        $firstday = strtotime("$year-$month-01");
        $lastday  = strtotime(date('Y-m-t', $firstday));

        // Fetch all records for the month in one query
        $records = Attendances::where('user_id', $userId)
            ->whereBetween('date', [$firstday, $lastday])
            ->get()
            ->keyBy('date');

        $attendance = [];

        for ($dayTs = $firstday; $dayTs <= $lastday; $dayTs += 86400) {
            $perday = $records->get($dayTs);
            $dayName = date('l', $dayTs);

            // Default break values
            $break_start = $perday && $perday->break_start ? date('h:i:s A', $perday->break_start) : '-';
            $break_end   = $perday && $perday->break_end   ? date('h:i:s A', $perday->break_end)   : '-';

            // Calculate totalhours minus break duration
            $breakDuration = ($perday && $perday->break_start && $perday->break_end)
                ? $perday->break_end - $perday->break_start
                : 0;

            $workedSeconds = ($perday && $perday->totalhours)
                ? max($perday->totalhours - $breakDuration, 0)
                : 0;

            $totalhours = $workedSeconds > 0 ? gmdate('H:i:s', $workedSeconds) : '-';

            // Determine status and fill data
            if (!$perday) {
                if ($dayTs > strtotime(date('d-M-Y'))) {
                    $attendance[] = [
                        'status'      => 'future',
                        'timein'      => '-',
                        'timeout'     => '-',
                        'totalhours'  => '-',
                        'break_start' => '-',
                        'break_end'   => '-',
                        'date'        => date('d-M-Y', $dayTs),
                        'day'         => $dayName,
                        'name'        => ''
                    ];
                } elseif (in_array(date('D', $dayTs), ['Sat', 'Sun'])) {
                    $attendance[] = [
                        'status'      => 'weekend',
                        'timein'      => '-',
                        'timeout'     => '-',
                        'totalhours'  => '-',
                        'break_start' => '-',
                        'break_end'   => '-',
                        'date'        => date('d-M-Y', $dayTs),
                        'day'         => $dayName,
                        'name'        => 'Weekend'
                    ];
                } else {
                    $attendance[] = [
                        'status'      => 'absent',
                        'timein'      => '-',
                        'timeout'     => '-',
                        'totalhours'  => '-',
                        'break_start' => '-',
                        'break_end'   => '-',
                        'date'        => date('d-M-Y', $dayTs),
                        'day'         => $dayName,
                        'name'        => 'Absent'
                    ];
                }
            } elseif ($perday->date == strtotime(date('d-M-Y')) && !$perday->timeout) {
                $attendance[] = [
                    'status'      => 'today',
                    'timein'      => $perday->timein ? date('h:i:s A', $perday->timein) : '-',
                    'timeout'     => '-',
                    'totalhours'  => '-',
                    'break_start' => $break_start,
                    'break_end'   => $break_end,
                    'date'        => date('d-M-Y', $dayTs),
                    'day'         => $dayName,
                    'name'        => 'Today'
                ];
            } elseif (!$perday->timeout && $perday->timein) {
                $attendance[] = [
                    'status'      => 'forgettotimeout',
                    'timein'      => date('h:i:s A', $perday->timein),
                    'timeout'     => '-',
                    'totalhours'  => '-',
                    'break_start' => $break_start,
                    'break_end'   => $break_end,
                    'date'        => date('d-M-Y', $dayTs),
                    'day'         => $dayName,
                    'name'        => 'Forgot to Timeout'
                ];
            } else {
                $attendance[] = [
                    'status'      => 'present',
                    'timein'      => date('h:i:s A', $perday->timein),
                    'timeout'     => date('h:i:s A', $perday->timeout),
                    'totalhours'  => $totalhours,
                    'break_start' => $break_start,
                    'break_end'   => $break_end,
                    'date'        => date('d-M-Y', $dayTs),
                    'day'         => $dayName,
                    'name'        => 'Present'
                ];
            }
        }

        // Get today's attendance
        $startOfDay = strtotime(date('Y-m-d 00:00:00'));
        $endOfDay   = $startOfDay + 86399;
        $todayAttendance = Attendances::where('user_id', $userId)
            ->whereBetween('date', [$startOfDay, $endOfDay])
            ->first();

        $timedin       = ($todayAttendance && $todayAttendance->timein) ? 1 : 0;
        $timedout      = ($todayAttendance && $todayAttendance->timeout) ? 1 : 0;
        $break_started = ($todayAttendance && $todayAttendance->break_start && !$todayAttendance->break_end) ? 1 : 0;

        $todayWorked = '-';
        if ($todayAttendance && $todayAttendance->totalhours) {
            $breakDuration = ($todayAttendance->break_start && $todayAttendance->break_end)
                ? $todayAttendance->break_end - $todayAttendance->break_start
                : 0;
            $workedSeconds = max($todayAttendance->totalhours - $breakDuration, 0);
            $todayWorked = gmdate('H:i:s', $workedSeconds);
        }

        $layout = auth()->user()->hasRole('admin') ? 'layouts.admin-app' : 'layouts.user-app';

        return view('attendance.index', compact(
            'attendance',
            'layout',
            'timedin',
            'timedout',
            'break_started',
            'todayAttendance',
            'todayWorked'
        ));
    }


    public function store(Request $request){
        

    }

    public function edit($id){
        
    }

    public function update(Request $request, $id){
       
    }

    public function destroy($id){
        
    }

    public function timeIn(){
        $userid = Auth::user()->id;
        $timein = time();
        // if (date('H:i', $timein) >= '00:00' && date('H:i', $timein) <= '06:00') {
        //     $date = strtotime(date('d-M-Y')) - 86400;
        // }
        // else {
        //     $date = strtotime(date('d-M-Y'));
        // }
        $date = strtotime(date('d-M-Y'));
        $timein = Attendances::updateOrCreate([
            'user_id' => $userid,
            'date' => $date,
        ], [
            'timein' => $timein,
        ]);

        $successmessage = 'Timed In Successfuly!';
        return redirect()->back()->with('success', $successmessage);
    }

    public function timeOut()
    {
        $userid = Auth::user()->id;
        $timeout = time();
        $date = strtotime(date('d-M-Y'));
        $timein = Attendances::where('user_id', $userid)->latest()->first();
        $timeout = Attendances::where(['user_id' => $userid, 'date' => $timein->date])->update(['timeout' => $timeout, 'totalhours' => ($timeout - ($timein->timein))]);
        $successmessage = 'Timed Out Successfuly!';

        return redirect()->back()->with('success', $successmessage);
    }

    public function allAttendance(Request $request)
    {
        $users = User::permission('view attendance')->get();
        $selectedUser = null;

        if ($request->user) {
            $selectedUser = User::find($request->user);
        }

        // If no date filter is applied, show today's date
        $today = strtotime(date('Y-m-d'));

        // If filters are applied, get the full month's attendance
        $filtering = $request->has('month') || $request->has('year');

        $month = $request->month ?? date('m');
        $year = $request->year ?? date('Y');
        $date = '01-' . $month . '-' . $year;
        $firstDay = strtotime(date('Y-m-01', strtotime($date)));
        $lastDay = strtotime(date('Y-m-t', strtotime($date)));

        $attendance = [];

        foreach ($users as $user) {
            $records = [];

            if ($filtering) {
                // full month logic
                for ($i = $firstDay; $i <= $lastDay; $i += 86400) {
                    $records[] = $this->getAttendanceRecord($user, $i);
                }
            } else {
                // today's attendance only
                $records[] = $this->getAttendanceRecord($user, $today);
            }

            $attendance[] = [
                'user' => $user,
                'records' => $records,
            ];
        }

        return view('admin.attendance.index', compact('users', 'attendance', 'selectedUser'));
    }

    private function getAttendanceRecord($user, $timestamp)
    {
        $record = Attendances::where('user_id', $user->id)->where('date', $timestamp)->first();
        $day = date('l', $timestamp);

        if (!$record) {
            if ($timestamp > strtotime(date('Y-m-d'))) {
                return ['timein' => '-', 'timeout' => '-', 'totalhours' => '-', 'status' => 'Future', 'user' => $user->name];
            }

            if (date('D', $timestamp) == 'Sat' || date('D', $timestamp) == 'Sun') {
                return ['timein' => '-', 'timeout' => '-', 'totalhours' => '-', 'status' => 'Weekend', 'user' => $user->name];
            }

            return ['timein' => '-', 'timeout' => '-', 'totalhours' => '-', 'status' => 'Absent', 'user' => $user->name];
        }

        if ($record->timeout === null && $record->date == strtotime(date('Y-m-d'))) {
            return ['timein' => date('h:i:s A', $record->timein), 'timeout' => '-', 'totalhours' => '-', 'status' => 'Today', 'user' => $user->name];
        }

        if ($record->timeout === null && $record->timein !== null) {
            return ['timein' => date('h:i:s A', $record->timein), 'timeout' => '-', 'totalhours' => '-', 'status' => 'Forgot to Timeout', 'user' => $user->name];
        }

        $status = 'Present';
        $timeIn = Carbon::createFromTimestamp($record->timein);
        $shiftStartTime = Carbon::parse('9:00')->addMinutes(20);

        if ($timeIn->format('H:i:s') > $shiftStartTime->format('H:i:s')) {
            $status = 'Late Check In';
        } elseif ($record->totalhours < (9 * 3600)) {
            $status = 'Early Check Out';
        }

        return [
            'timein' => date('h:i:s A', $record->timein),
            'timeout' => date('h:i:s A', $record->timeout),
            'totalhours' => gmdate('H:i:s', $record->totalhours),
            'status' => $status,
            'user' => $user->name,
        ];
    }

    public function breakStart(Request $request)
    {
        $userid = Auth::id();
        $date = strtotime(date('d-M-Y'));
        $attendance = Attendances::where('user_id', $userid)
            ->where('date', $date)
            ->first();
        // If no attendance record exists, create one
        if (!$attendance) {
            return redirect()->back()->with('error', 'You must check in before starting a break.');
        }

        $attendance->break_start = time();
        $attendance->break_end = null; // reset in case of previous data
        $attendance->save();

        return redirect()->back()->with('success', 'Break started!');
    }

    public function breakEnd(Request $request)
    {
        $userid = Auth::id();
        $date = strtotime(date('d-M-Y'));

        $attendance = Attendances::where('user_id', $userid)
            ->where('date', $date)
            ->first();

        if (!$attendance || !$attendance->break_start) {
            return redirect()->back()->with('error', 'No active break found.');
        }

        $attendance->break_end = time();
        $attendance->break_total += ($attendance->break_end - $attendance->break_start);
        $attendance->save();

        return redirect()->back()->with('success', 'Break ended!');
    }

}
