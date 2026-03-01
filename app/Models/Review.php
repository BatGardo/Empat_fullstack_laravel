<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'rating', 'product_id'];

    /**
     * Many-to-one: review belongs to a product
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
