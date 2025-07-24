<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationSummary extends Model
{
    use HasFactory;

    public function consultant(){
        return $this->hasOne(Consultant::class, 'id', 'consultant_id');
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
}
