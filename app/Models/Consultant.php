<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultant extends Model
{
    use HasFactory;

    public function category_body(){
        return $this->hasOne(ConsultationBody::class, 'id', 'consultation_body_id');
    }
}
