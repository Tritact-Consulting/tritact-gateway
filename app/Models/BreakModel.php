<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BreakModel extends Model
{
    use HasFactory;

    protected $table = 'breaks'; // Table name

    protected $fillable = [
        'attendance_id',
        'break_start',
        'break_end',
        'break_total'
    ];

    /**
     * Relationship: Each break belongs to one attendance record.
     */
    public function attendance()
    {
        return $this->belongsTo(Attendance::class, 'attendance_id', 'id');
    }

}
