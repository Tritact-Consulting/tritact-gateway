<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignAudit extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function company(){
        return $this->hasOne(User::class, 'id', 'company_id');
    }

    public function get_status(){
        if($this->status == 0){
            return 'Upcoming';
        }
    }

    public function get_status_class(){
        if($this->status == 0){
            return 'info';
        }
    }
}
