<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auditor extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsToMany(CertificationCategory::class, 'auditor_certification_categories', 'auditor_id', 'cer_cat_id');
    }

    public function category_body(){
        return $this->hasOne(CertificationBody::class, 'id', 'certification_body_id');
    }

}
