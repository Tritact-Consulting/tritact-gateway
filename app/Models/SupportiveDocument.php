<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportiveDocument extends Model
{
    use HasFactory;

    public function document(){
        return $this->hasOne(Documents::class, 'id', 'document_id');
    }

}
