<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Traits\ProductAttribute;
use App\Models\Product\Traits\ProductRelationship;

class Product extends Model
{
    use ProductAttribute,
        ProductRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'item_id', 'delivery_date', 'closed_date', 'description', 'offer_quantity', 'min_reserved_price', 'status'
    ];
}
