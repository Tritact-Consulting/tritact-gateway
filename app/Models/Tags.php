<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;

    public function documents(){
        return $this->belongsToMany(Documents::class, 'document_tags', 'tag_id');
    }

    public function tags(){
        return $this->belongsToMany(User::class, 'company_tags', 'tag_id');
    }

}
