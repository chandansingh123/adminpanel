<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item\Traits\ItemAttribute;
use App\Models\Item\Traits\ItemRelationship;

class Item extends Model
{
    use ItemAttribute,
        ItemRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'file_name', 'status'
    ];
}
