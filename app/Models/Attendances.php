<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'timein', 'timeout', 'date', 'totalhours'];

    public function breaks()
    {
        return $this->hasMany(BreakModel::class, 'attendance_id', 'id');
    }

}
