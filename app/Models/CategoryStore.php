<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoryStore extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id',
        'category_id',
        'parent_id',
        'is_featured',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'store_id' => 'integer',
        'category_id' => 'integer',
        'parent_id' => 'integer',
        'is_featured' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(CategoryStore::class);
    }

    public function productStores(): BelongsToMany
    {
        return $this->belongsToMany(ProductStore::class);
    }


    public function children(): HasMany
    {
        return $this->hasMany(CategoryStore::class, 'parent_id');
    }

    public function getFullPath()
    {
        $path = $this->category->slug;
        $parent = $this->parent;
        while ($parent) {
            $path = $parent->category->slug . '/' . $path;
            $parent = $parent->parent;
        }
        return $path;
    }
}
