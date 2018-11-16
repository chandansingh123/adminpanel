<?php

namespace App\Models\ProductClearingPrice\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProductClearingPriceRelationship
 * @package App\Models\ProductClearingPrice\Traits
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
trait ProductClearingPriceRelationship
{
    /**
     * Get the product that owns the product.
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
