<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductStore extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id',
        'product_id',
        'image_id',
        'description_id',
        'short_description_id',
        'status',
        'price',
        'currency_id',
        'stock',
        'view',
        'rating_value',
        'review_count',
        'comment_count',
        'primary_category_store_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'store_id' => 'integer',
        'product_id' => 'integer',
        'image_id' => 'integer',
        'description_id' => 'integer',
        'short_description_id' => 'integer',
        'price' => 'decimal:2',
        'currency_id' => 'integer',
        'stock' => 'integer',
        'view' => 'integer',
        'rating_value' => 'integer',
        'review_count' => 'integer',
        'comment_count' => 'integer',
        'primary_category_store_id' => 'integer',
    ];

    public function categoryStores(): BelongsToMany
    {
        return $this->belongsToMany(CategoryStore::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }

    public function description(): BelongsTo
    {
        return $this->belongsTo(Description::class);
    }

    public function shortDescription(): BelongsTo
    {
        return $this->belongsTo(ShortDescription::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function primaryCategoryStore(): BelongsTo
    {
        return $this->belongsTo(CategoryStore::class);
    }


    public function getPrimaryCategoryUrl()
    {
        $primaryCategoryStore = $this->primaryCategoryStore ?? $this->categoryStores()->first();
        if (!$primaryCategoryStore || !$primaryCategoryStore->category) {
            return route('product.show', ['path' => 'sin-categoria', 'productSlug' => $this->product->slug]);
        }
        return route('product.show', [
            'path' => $primaryCategoryStore->getFullPath(),
            'productSlug' => $this->product->slug,
        ]);
    }
}
