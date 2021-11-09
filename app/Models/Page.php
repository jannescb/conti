<?php

namespace App\Models;

use Astrotomic\Fileable\Concerns\HasFiles;
use Astrotomic\Fileable\Contracts\Fileable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements Fileable
{
    use HasFactory, HasFiles;

    protected $fillable = [
        'name',
        'content',
        'slug',
    ];

    protected $casts = [
        'content' => 'json',
    ];
}
