<?php

namespace App\Models\Activity\Traits;

use Illuminate\Support\Facades\Hash;

/**
 * Class ActivityAttribute
 * @package App\Models\Activity\Traits
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
trait ActivityAttribute
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
