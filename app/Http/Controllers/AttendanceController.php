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
        $layout = auth()->user()->hasRole('admin') ? 'layouts.admin-app' : 'layouts.user-app';
        return view('attendance.index', compact('attendance', 'layout'));
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
        $shift = '9:00:00 AM - 6:00:00 PM';
        $timein = time();
        if (date('H:i', $timein) >= '00:00' && date('H:i', $timein) <= '06:00') {
            $date = strtotime(date('d-M-Y')) - 86400;
        } else {
            $date = strtotime(date('d-M-Y'));
        }
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

    public function allAttendance(Request $request){
        $users = User::permission('view attendance')->get();

        $userdata = null;
        if($request->user != null){
            $userdata = User::find($request->user);
        }
        $month = 1;
        if($request->month != null){
            $month = $request->month;
        }
        $year = 1;
        if($request->year != null){
            $year = $request->year;
        }

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

        return view('admin.attendance.index', compact('users', 'attendance', 'userdata'));
    }
    
}
