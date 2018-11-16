<?php

namespace App\Models\TopBid;

use Illuminate\Database\Eloquent\Model;

class TopBid extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'quantity', 'price'
    ];
}
