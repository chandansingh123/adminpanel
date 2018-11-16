<?php

namespace App\Models\BidHistory\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BidHistoryRelationship
 * @package App\Models\BidHistory\Traits
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
trait BidHistoryRelationship
{

    /**
     * Get the history that owns the bid.
     *
     * Define an inverse one-to-one relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function history()
    {
        return $this->belongsTo('App\Models\Bid\Bid', 'bid_id');
    }
}