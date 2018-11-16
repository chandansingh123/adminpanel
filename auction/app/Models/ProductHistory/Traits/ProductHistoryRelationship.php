<?php

namespace App\Models\ProductHistory\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class ProductHistoryRelationship
 * @package App\Models\ProductHistory\Traits
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
trait ProductHistoryRelationship
{
    /**
     * Get the history that owns the product.
     *
     * Define an inverse one-to-one relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function history()
    {
        return $this->belongsTo('App\Models\Product\Product', 'product_id');
    }
}
