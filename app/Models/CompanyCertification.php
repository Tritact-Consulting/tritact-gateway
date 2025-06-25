<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCertification extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function certificate(){
        return $this->hasOne(CertificationCategory::class, 'id', 'certifications_id');
    }

    public function auditor(){
        return $this->hasOne(Auditor::class, 'id', 'auditor_id');
    }
    
    public function body(){
        return $this->hasOne(CertificationBody::class, 'id', 'certification_body_id');
    }

    public function getRemainingDays(){
        $remaining = \Carbon\Carbon::now()->diffInDays($this->expire_date, false);
        $remaining = $remaining + 2;
        if($remaining <= 30){
            return 'alert alert-red ' . $remaining;
        }else if(($remaining > 30) && ($remaining <= 90)){
            return 'alert alert-warning ' . $remaining;
        }else if($remaining > 90){
            return 'alert alert-success ' . $remaining;
        }
    }
}
