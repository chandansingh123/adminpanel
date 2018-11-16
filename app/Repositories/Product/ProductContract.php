<?php

namespace App\Repositories\Product;

use App\Repositories\BaseContract;

/**
 * Interface ProductContract
 * @package App\Repositories\Product
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
interface ProductContract extends BaseContract
{

    /**
     * Retrieve data of repository
     *
     * param int $id
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findByItemId($id);
}
