<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;

    public function tags(){
        return $this->belongsToMany(Tags::class, 'document_tags', 'document_id', 'tag_id');
    }
}
