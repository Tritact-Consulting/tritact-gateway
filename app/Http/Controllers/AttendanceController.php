<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\CompanyCertification;
use App\Models\CertificationCategory;
use App\Models\Auditor;
use App\Models\Category;
use App\Models\Attendances;
use App\Models\BreakModel;
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
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;
        $timezone = $user->timezone ?? 'UTC'; // fallback if not set

        $layout = $user->hasRole('admin') ? 'layouts.admin-app' : 'layouts.user-app';

        // Current month boundaries in UTC
        $monthStart = Carbon::now($timezone)->startOfMonth()->timezone('UTC')->timestamp;
        $monthEnd   = Carbon::now($timezone)->endOfMonth()->timezone('UTC')->timestamp;

        // Attendance for current month
        $attendanceRecords = Attendances::with('breaks')
            ->where('user_id', $userId)
            ->whereBetween('date', [$monthStart, $monthEnd])
            ->get()
            ->keyBy(function ($a) use ($timezone) {
                return Carbon::createFromTimestamp($a->date, 'UTC')->setTimezone($timezone)->format('Y-m-d');
            });

        $dates = [];
        $current = $monthStart;

        while ($current <= $monthEnd) {
            $dateKey = Carbon::createFromTimestamp($current, 'UTC')->setTimezone($timezone)->format('Y-m-d');
            $dayName = Carbon::createFromTimestamp($current, 'UTC')->setTimezone($timezone)->format('l');
            $isToday = $dateKey === Carbon::now($timezone)->format('Y-m-d');

            if (isset($attendanceRecords[$dateKey])) {
                $a = $attendanceRecords[$dateKey];
                $status = $a->status;

                $dates[] = [
                    'date'       => Carbon::createFromTimestamp($a->date, 'UTC')->setTimezone($timezone)->format('d-M-Y'),
                    'day'        => substr($dayName, 0, 3),
                    'timein'     => $a->timein ? Carbon::createFromTimestamp($a->timein, 'UTC')->setTimezone($timezone)->format('h:i A') : null,
                    'timeout'    => $a->timeout ? Carbon::createFromTimestamp($a->timeout, 'UTC')->setTimezone($timezone)->format('h:i A') : null,
                    'breaks'     => $a->breaks->map(function ($b) use ($timezone) {
                        return [
                            'start' => $b->break_start ? Carbon::createFromTimestamp($b->break_start, 'UTC')->setTimezone($timezone)->format('h:i:s A') : null,
                            'end'   => $b->break_end ? Carbon::createFromTimestamp($b->break_end, 'UTC')->setTimezone($timezone)->format('h:i:s A') : null,
                        ];
                    })->toArray(),
                    'totalhours' => $a->timein && $a->timeout
                        ? gmdate('H:i', ($a->timeout - $a->timein) - $a->breaks->sum('break_total'))
                        : null,
                    'status'     => $status,
                    'name'       => $a->name,
                ];
            } else {
                if ($dayName === 'Saturday' || $dayName === 'Sunday') {
                    $status = 'Weekend';
                } elseif ($isToday) {
                    $status = 'Today';
                } else {
                    $status = 'Absent';
                }

                $dates[] = [
                    'date'       => Carbon::createFromTimestamp($current, 'UTC')->setTimezone($timezone)->format('d-M-Y'),
                    'day'        => substr($dayName, 0, 3),
                    'timein'     => null,
                    'timeout'    => null,
                    'breaks'     => collect(),
                    'totalhours' => null,
                    'status'     => $status,
                    'name'       => null,
                ];
            }

            $current = strtotime('+1 day', $current);
        }

        $check_attendance = Attendances::with('breaks')
            ->where('user_id', $userId)
            ->latest()
            ->first();

        $break_started = $check_attendance && $check_attendance->breaks->whereNull('break_end')->first() ? 1 : 0;

        if (!$check_attendance) {
            $timedin = 0;
            $timedout = 0;
        } else {
            if ((time() - $check_attendance->timein) < 40000) {
                if ($check_attendance->timein && !$check_attendance->timeout) {
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

        $todayWorked = '-';
        if ($check_attendance && $check_attendance->timein && $check_attendance->timeout) {
            $workedSeconds = ($check_attendance->timeout - $check_attendance->timein)
                - $check_attendance->breaks->sum(function ($b) {
                    return $b->break_end && $b->break_start
                        ? $b->break_end - $b->break_start
                        : 0;
                });

            $hours   = floor($workedSeconds / 3600);
            $minutes = floor(($workedSeconds % 3600) / 60);
            $todayWorked = "{$hours}h {$minutes}m";
        }

        return view('attendance.index', [
            'attendance'      => $dates,
            'check_attendance'=> $check_attendance,
            'timedin'         => $timedin,
            'timedout'        => $timedout,
            'todayWorked'     => $todayWorked,
            'break_started'   => $break_started,
            'layout'          => $layout
        ]);
    }



    public function store(Request $request){
        

    }

    public function edit($id){
        
    }

    public function update(Request $request, $id){
       
    }

    public function destroy($id){
        
    }

    public function timeIn()
    {
        $user = Auth::user();
        $userid = $user->id;
        $timezone = $user->timezone ?? 'UTC';
        $now = Carbon::now($timezone);
        $date = $now->copy()->startOfDay()->timezone('UTC');
        $timein = $now->copy()->timezone('UTC');
        Attendances::updateOrCreate(
            [
                'user_id' => $userid,
                'date'    => $date->timestamp,
            ],
            [
                'timein'  => $timein->timestamp,
            ]
        );
        return redirect()->back()->with('success', 'Timed In Successfully!');
    }

    public function timeOut()
    {
        $user = Auth::user();
        $userid = $user->id;
        $timezone = $user->timezone ?? 'UTC';

        // Current time in user's timezone
        $now = Carbon::now($timezone);

        // Today's date in UTC
        $date = $now->copy()->startOfDay()->timezone('UTC');

        // Get last attendance record
        $timeinRecord = Attendances::where('user_id', $userid)->latest()->first();

        if (!$timeinRecord) {
            return redirect()->back()->with('error', 'No time-in record found!');
        }

        // Store timeout in UTC
        $timeoutUTC = $now->copy()->timezone('UTC')->timestamp;

        // Calculate total hours in seconds (UTC-based)
        $totalSeconds = $timeoutUTC - $timeinRecord->timein;

        // Update record
        Attendances::where([
            'user_id' => $userid,
            'date'    => $timeinRecord->date
        ])->update([
            'timeout'    => $timeoutUTC,
            'totalhours' => $totalSeconds
        ]);

        return redirect()->back()->with('success', 'Timed Out Successfully!');
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
        $userId = Auth::id();

        $startOfDay = strtotime(date('Y-m-d 00:00:00'));
        $endOfDay   = $startOfDay + 86399;

        // Get today's attendance record
        $todayAttendance = Attendances::where('user_id', $userId)
            ->whereBetween('date', [$startOfDay, $endOfDay])
            ->first();

        if (!$todayAttendance) {
            return redirect()->back()->with('error', 'You must check in first.');
        }

        // Check if there's already an active (unended) break
        $activeBreak = BreakModel::where('attendance_id', $todayAttendance->id)
            ->whereNull('break_end')
            ->first();

        if ($activeBreak) {
            return redirect()->back()->with('error', 'You already have an active break.');
        }

        // Start a new break
        BreakModel::create([
            'attendance_id' => $todayAttendance->id,
            'break_start'   => time(),
        ]);

        return redirect()->back()->with('success', 'Break started.');
    }


    public function breakEnd(Request $request)
    {
        $userId = Auth::id();

        $startOfDay = strtotime(date('Y-m-d 00:00:00'));
        $endOfDay   = $startOfDay + 86399;

        // Get today's attendance
        $todayAttendance = Attendances::where('user_id', $userId)
            ->whereBetween('date', [$startOfDay, $endOfDay])
            ->first();

        if (!$todayAttendance) {
            return redirect()->back()->with('error', 'No attendance record found.');
        }

        // Get active break
        $activeBreak = BreakModel::where('attendance_id', $todayAttendance->id)
            ->whereNull('break_end')
            ->first();

        if (!$activeBreak) {
            return redirect()->back()->with('error', 'No active break found.');
        }

        $breakEnd = time();
        $breakDuration = $breakEnd - $activeBreak->break_start;

        // End the break
        $activeBreak->update([
            'break_end'   => $breakEnd,
            'break_total' => $breakDuration
        ]);

        return redirect()->back()->with('success', 'Break ended.');
    }


}
