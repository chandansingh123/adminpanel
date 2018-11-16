<?php

namespace App\Models\Item\Traits;

use Illuminate\Support\Facades\Hash;

/**
 * Class ItemAttribute
 * @package App\Models\Item\Traits
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
trait ItemAttribute
{

    /**
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case 0:
                return '<span class="label label-danger">Inactive</span>';
            case 1:
                return '<span class="label label-success">Active</span>';
        }
    }

}
