<?php

namespace App\Models\Gallery;

use Illuminate\Database\Eloquent\Model;
use App\Models\Gallery\Traits\GalleryAttribute;
use App\Models\Gallery\Traits\GalleryRelationship;

class Gallery extends Model
{
    use GalleryAttribute,
        GalleryRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'description', 'file_name', 'status'
    ];
}
