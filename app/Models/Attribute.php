<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    //TODO: use Fileable

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
