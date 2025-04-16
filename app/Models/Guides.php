<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guides extends Model
{
    use HasFactory;

    public function categories(){
        return $this->belongsToMany(Category::class, 'guide_category', 'guide_id', 'category_id')->where('status', 0);
    }

}
