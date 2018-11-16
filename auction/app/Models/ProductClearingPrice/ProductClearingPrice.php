<?php

namespace App\Models\ProductClearingPrice;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductClearingPrice\Traits\ProductClearingPriceRelationship;

class ProductClearingPrice extends Model
{
    use ProductClearingPriceRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'clearing_price'
    ];
}
