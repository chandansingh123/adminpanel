<?php

namespace App\Models\Product\Traits;

use Illuminate\Support\Facades\Hash;

/**
 * Class ProductAttribute
 * @package App\Models\Product\Traits
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
trait ProductAttribute
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
