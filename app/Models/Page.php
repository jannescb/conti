<?php

namespace App\Models;

use App\Http\Resources\SectionResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function sections()
    {
        return $this->morphMany(Section::class, 'parent');
    }

    public function getContent()
    {
        $resource = SectionResource::collection($this->sections->sortBy('order_column'))
            ->toArray(request());

        return array_values($resource);
    }
}
