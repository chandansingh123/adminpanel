<?php

namespace App\Models\Activity\Traits;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ActivityRelationship
 * @package App\Models\Activity\Traits
 * @author Krishna Prasad Timilsina <bikranshu.t@gmail.com>
 */
trait ActivityRelationship
{
    /**
     * Get the activity type that owns the product.
     *
     * Define an inverse one-to-one relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function type()
    {
        return $this->belongsTo('App\Models\ActivityType\ActivityType', 'activity_type_id');
    }
}
