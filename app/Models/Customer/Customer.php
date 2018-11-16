<?php

namespace App\Models\Customer;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Customer\Traits\CustomerAttribute;
use App\Models\Customer\Traits\CustomerRelationship;

class Customer extends Authenticatable
{

    use Notifiable,
        CustomerAttribute,
        CustomerRelationship;

    protected $guard = 'web';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'first_name', 'last_name', 'address', 'email', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
