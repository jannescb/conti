<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use AwStudio\DynamicAttributes\HasDynamicAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory, HasDynamicAttributes;

    protected $fillable = ['type', 'parent_id', 'parent_type', 'order_column'];

    /**
     * Get the parent model.
     */
    public function parent()
    {
        return $this->morphTo();
    }

    /**
     * A Section has many attributes.
     *
     * @return HasMany
     */
    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
    
    /**
     * A Section has many Sections.
     *
     * @return MorphMany
     */
    public function sections()
    {
        return $this->morphMany(Section::class, 'parent');
    }
}
