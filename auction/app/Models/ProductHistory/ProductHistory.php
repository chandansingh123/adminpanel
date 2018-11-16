<?php

namespace App\Models\ProductHistory;

use Illuminate\Database\Eloquent\Model;
use App\Models\ProductHistory\Traits\ProductHistoryRelationship;

class ProductHistory extends Model
{
    use ProductHistoryRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'name', 'item_id', 'delivery_date', 'closed_date', 'description', 'offer_quantity', 'min_reserved_price', 'status'
    ];
}
