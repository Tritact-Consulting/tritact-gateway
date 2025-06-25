<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignAudit extends Model
{
    use HasFactory;

    public function auditor(){
        return $this->hasOne(Auditor::class, 'id', 'auditor_id');
    }

    public function company(){
        return $this->hasOne(User::class, 'id', 'company_id');
    }

    public function category(){
        return $this->hasOne(CertificationCategory::class, 'id', 'certification_category_id');
    }

    public function body(){
        return $this->hasOne(CertificationBody::class, 'id', 'certification_body_id');
    }

    public function get_status(){
        if($this->status == 0){
            return 'Upcoming';
        }else if($this->status == 1){
            return 'In progress';
        }else if($this->status == 2){
            return 'Completed';
        }else if($this->status == 3){
            return 'Cancelled';
        }
    }

    public function get_status_class(){
        if($this->status == 0){
            return 'info';
        }else if($this->status == 1){
            return 'primary';
        }else if($this->status == 2){
            return 'success';
        }else if($this->status == 3){
            return 'warning';
        }
    }

    public function company_certification(){
        return $this->hasOne(CompanyCertification::class, 'id', 'company_certificate_id');
    }
}
