<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function sub_cities()
    {
        return $this->hasMany(sub_city::class);
    }
    public function orders()
    {
        return $this->hasMany(Street::class);
    }
    public function bonuses()
    {
        return $this->hasOne(bonus::class);
    }
    public function captain()
    {
        return $this->hasOne(Captain::class);
    }

}