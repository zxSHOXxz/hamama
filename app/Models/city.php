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
        return $this->hasMany(Sub_City::class);
    }
    public function orders()
    {
        return $this->hasMany(Street::class);
    }
    public function bonuses()
    {
        return $this->hasOne(Bonus::class);
    }
    public function captain()
    {
        return $this->hasOne(Captain::class);
    }

}