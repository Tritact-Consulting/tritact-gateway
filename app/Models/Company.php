<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function remaining_users(){
        $total_user = $this->total_user;
        $users = count($this->user->user_list);
        return $total_user - $users;       
    }

    public function consultant(){
        return $this->belongsTo(Consultant::class);
    }

}
