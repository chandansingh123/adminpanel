<?php

namespace App\Models\Bid\Traits;

use Illuminate\Support\Facades\Hash;

/**
 * Class BidAttribute
 * @package App\Models\Bid\Traits
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
trait BidAttribute
{

    /**
     * @return string
     */
    public function getStatusLabelAttribute()
    {
        switch ($this->status) {
            case 1:
                return '<span class="badge badge-warning">Pending</span>';
            case 2:
                return '<span class="badge badge-success">Confirmed</span>';
            case 3:
                return '<span class="badge badge-danger">Cancelled</span>';
        }
    }

    /**
     * @return string
     */
    public function getStatusNameAttribute()
    {
        switch ($this->status) {
            case 1:
                return 'Pending';
            case 2:
                return 'Confirmed';
            case 3:
                return 'Cancelled';
        }
    }

}
