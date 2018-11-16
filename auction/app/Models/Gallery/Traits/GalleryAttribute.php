<?php

namespace App\Models\Gallery\Traits;

use Illuminate\Support\Facades\Hash;

/**
 * Class GalleryAttribute
 * @package App\Models\Gallery\Traits
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
trait GalleryAttribute
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
