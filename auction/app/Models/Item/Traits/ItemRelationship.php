<?php

namespace App\Models\Item\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemRelationship
 * @package App\Models\Item\Traits
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
trait ItemRelationship
{
    /**
     * Get the item type that owns the product.
     *
     * Define an inverse one-to-one relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product\Product', 'id');
    }
}
