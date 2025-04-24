<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyCategories extends Model
{
    use HasFactory;

    public function category(){
        return $this->hasOne(Category::class, 'id');
    }

    public function user(){
        return $this->belongsToMany(Users::class);
    }
}
