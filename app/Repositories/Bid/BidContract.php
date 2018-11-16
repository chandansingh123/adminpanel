<?php

namespace App\Repositories\Bid;

use App\Repositories\BaseContract;

/**
 * Interface BidContract
 * @package App\Repositories\Bid
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
interface BidContract extends BaseContract
{

    /**
     * @param integer $customerId
     * @param string $orderBy
     * @param string $sort
     * @return mixed
     */
    public function findBidsByCustomerId($customerId, $orderBy, $sort);
}
