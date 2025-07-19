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
                    $shiftStartTime = Carbon::parse($userdata->shift()->starting_time);

                    $shiftStartTimeWithGrace = $shiftStartTime->addMinutes($userdata->shift()->grace_time);

                    if ($timeIn->format('H:i:s') > $shiftStartTimeWithGrace->format('H:i:s')) {
                        $data['name'] = 'Late Check In';
                    } else if ($perdayattendance->totalhours < ($userdata->shift()->shift_hours * 3600)) {
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
    
}
