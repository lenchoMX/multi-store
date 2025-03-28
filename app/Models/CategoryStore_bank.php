<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class CategoryStoreBank extends Model
{
    use HasFactory;

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function productStores(): BelongsToMany
    {
        return $this->belongsToMany(ProductStore::class);
    }

    //////////////////////////////////
    

    public function children()
    {
        return $this->hasMany(CategoryStore::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(CategoryStore::class, 'parent_id');
    }
}
