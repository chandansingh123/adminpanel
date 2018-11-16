<?php

namespace App\Models\Activity;

use Illuminate\Database\Eloquent\Model;
use App\Models\Activity\Traits\ActivityAttribute;
use App\Models\Activity\Traits\ActivityRelationship;

class Activity extends Model
{
    use ActivityAttribute,
        ActivityRelationship;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'activity_date', 'file_name', 'status'
    ];
}
