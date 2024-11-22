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

    public function supportive_document($user_id){
        return $this->hasMany(SupportiveDocument::class, 'document_id', 'id')->where('user_id', $user_id)->orderBy('id', 'desc')->get();
    }
    
}
