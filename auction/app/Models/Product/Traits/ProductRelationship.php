<?php

namespace App\Models\Product\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Class ProductRelationship
 * @package App\Models\Product\Traits
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
trait ProductRelationship
{
    /**
     * Get the item that owns the product.
     *
     * Define an inverse one-to-one relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function item()
    {
        return $this->belongsTo('App\Models\Item\Item', 'item_id');
    }

    /**
     * Get the bid that owns the product.
     *
     * Define an inverse one-to-one relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function bids()
    {
        return $this->hasMany('App\Models\Bid\Bid', 'product_id')->orderBy('bid_price', 'desc')->where('status', '=', 2);
    }

    /**
     * Get the own bid that owns the product.
     *
     * Define an inverse one-to-one relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function myBids()
    {
        return $this->hasOne('App\Models\Bid\Bid', 'product_id')->where('customer_id', '=', Auth::id())->where('status', '<>', 3);
    }

    /**
     * Get the clearing price that owns the product.
     *
     * Define an inverse one-to-one relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function clearingPrice()
    {
        return $this->hasMany('App\Models\ProductClearingPrice\ProductClearingPrice', 'product_id');
    }

    public static function getClearingPrice($product)
    {
        $currentClearingPrice = $product->min_reserved_price;

        $sql = "SELECT bid_price, bid_quantity, @sum := @sum + bid_quantity AS total_qty
                FROM bids
                JOIN ( SELECT @sum:=0 ) AS tx
                WHERE product_id = " . $product->id . " AND status = 2 ORDER BY bid_price DESC, bid_quantity DESC";

        $rows = DB::select($sql);

        if (count($rows) <= 0) {
            return $currentClearingPrice;
        }else if(end($rows)->total_qty <= $product->offer_quantity){
            return $currentClearingPrice;
        } else {
            foreach ($rows as $row) {
                if ($row->total_qty >= $product->offer_quantity) {
                    return $row->bid_price;
                }
            }
        }

    }
}
