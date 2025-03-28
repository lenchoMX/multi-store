<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeatureBank extends Model
{
    protected $fillable = ['name', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(Feature::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Feature::class, 'parent_id');
    }
}
