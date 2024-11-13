<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyTags extends Model
{
    use HasFactory;

    public function tag(){
        return $this->hasOne(Tags::class, 'id');
    }

    public function user(){
        return $this->belongsToMany(Users::class);
    }
}
