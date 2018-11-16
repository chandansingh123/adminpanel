<?php

namespace App\Models\Bid;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bid\Traits\BidAttribute;
use App\Models\Bid\Traits\BidRelationship;

class Bid extends Model
{
    use BidAttribute,
        BidRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id', 'customer_id', 'bid_quantity', 'bid_price', 'total_price', 'status'
    ];
}
