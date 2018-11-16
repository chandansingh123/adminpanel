<?php

namespace App\Models\Customer\Traits;

use Illuminate\Support\Facades\Hash;

/**
 * Class CustomerAttribute
 * @package App\Models\Customer\Traits
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
trait CustomerAttribute
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
