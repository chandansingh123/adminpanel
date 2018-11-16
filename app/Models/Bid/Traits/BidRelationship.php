<?php

namespace App\Models\Bid\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BidRelationship
 * @package App\Models\Bid\Traits
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
trait BidRelationship
{
    /**
     * Get the customer that owns the bid.
     *
     * Define an inverse one-to-one relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer\Customer', 'customer_id');
    }

    /**
     * Get the product that owns the bid.
     *
     * Define an inverse one-to-one relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product', 'product_id');
    }
}