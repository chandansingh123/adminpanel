<?php

namespace App\Models\BidHistory;

use Illuminate\Database\Eloquent\Model;
use App\Models\BidHistory\Traits\BidHistoryRelationship;

class BidHistory extends Model
{
    use BidHistoryRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bid_id', 'product_id', 'customer_id', 'bid_quantity', 'bid_price', 'total_price', 'status'
    ];
}
