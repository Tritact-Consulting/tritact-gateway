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
        $userdata = User::find(Auth::user()->id);
        $month = date('m');
        $year = date('Y');
        $date = '01-'.$month.'-'.$year;
        $id = Auth::user()->id;
        $firstday = strtotime(date('Y-m-01', strtotime($date)));
        $lastday = strtotime(date('Y-m-t', strtotime($date)));

        $attendance = [];
        $totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        for ($i = $firstday; $i <= $lastday; $i += 86400) {
            $perdayattendance = Attendances::where([['user_id', '=', $id], ['date', '=', $i]])->first();
            $day = date('l', $i);
            if ($perdayattendance == NULL) {
                if ($i > strtotime(date('d-M-Y'))) {
                    $data = ['status' => 'future', 'timein' => '-', 'timeout' => '-', 'totalhours' => '-', 'date' => date('d-M-Y', $i), 'day' => $day, 'name' => ''];
                }else {
                    if (date('D', $i) == 'Sat' || date('D', $i) == 'Sun') {
                        $data = ['status' => 'weekend', 'timein' => '-', 'timeout' => '-', 'totalhours' => '-', 'date' => date('d-M-Y', $i), 'day' => $day, 'name' => 'Weekend'];
                    } else {
                        $data = ['status' => 'absent', 'timein' => '-', 'timeout' => '-', 'totalhours' => '-', 'date' => date('d-M-Y', $i), 'day' => $day, 'name' => 'Absent'];
                    }
                }
            } elseif ($perdayattendance->date == strtotime(date('d-M-Y')) && $perdayattendance->timeout == NULL) {
                $data = ['status' => 'today', 'timein' => date('h:i:s A', $perdayattendance->timein), 'timeout' => '-', 'totalhours' => '-', 'date' => date('d-M-Y', $i), 'day' => $day, 'name' => 'Today'];
            } elseif ($perdayattendance->timeout == NULL && $perdayattendance->timein != NULL) {
                $data = ['status' => 'forgettotimeout', 'timein' => date('h:i:s A', $perdayattendance->timein), 'timeout' => '-', 'totalhours' => '-', 'date' => date('d-M-Y', $i), 'day' => $day, 'name' => 'Forgot to Timeout'];
            } else {
                $data = ['status' => 'present', 'timein' => date('h:i:s A', $perdayattendance->timein), 'timeout' => date('h:i:s A', $perdayattendance->timeout), 'totalhours' => gmdate('H:i:s', $perdayattendance->totalhours), 'date' => date('d-M-Y', $i), 'day' => $day, 'name' => 'Present'];

                if ($data['timein'] != null) {

                    $timeIn = Carbon::createFromTimestamp($perdayattendance->timein);
                    $shiftStartTime = Carbon::parse('9:00');

                    $shiftStartTimeWithGrace = $shiftStartTime->addMinutes(20);

                    if ($timeIn->format('H:i:s') > $shiftStartTimeWithGrace->format('H:i:s')) {
                        $data['name'] = 'Late Check In';
                    } else if ($perdayattendance->totalhours < (9 * 3600)) {
                        $data['name'] = 'Early Check Out';
                    }
                }
                //present
            }
            array_push($attendance, $data);
        }
        $startOfDay = strtotime(date('Y-m-d 00:00:00'));
        $endOfDay = $startOfDay + 86399;

        $todayAttendance = Attendances::where('user_id', $id)
            ->whereBetween('date', [$startOfDay, $endOfDay])
            ->first();
        $timedin = ($todayAttendance && $todayAttendance->timein) ? 1 : 0;
        $timedout = ($todayAttendance && $todayAttendance->timeout) ? 1 : 0;
        $break_started = ($todayAttendance && $todayAttendance->break_start && !$todayAttendance->break_end) ? 1 : 0;
        $layout = auth()->user()->hasRole('admin') ? 'layouts.admin-app' : 'layouts.user-app';
        return view('attendance.index', compact(
            'attendance', 
            'layout', 
            'timedin', 
            'timedout', 
            'break_started', 
            'todayAttendance'
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
