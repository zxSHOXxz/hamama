<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Client extends Authenticatable
{
    use HasFactory, HasRoles;

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function user()
    {
        return $this->morphOne(User::class, 'actor', 'actor_type', 'actor_id', 'id');
    }

}