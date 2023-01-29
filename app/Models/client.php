<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Client extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, HasRoles, Notifiable;

    protected $fillable = [
        'email',
        'password',
    ];

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function envelopes()
    {
        return $this->hasMany(Envelop::class);
    }
    public function user()
    {
        return $this->morphOne(User::class, 'actor', 'actor_type', 'actor_id', 'id');
    }

}