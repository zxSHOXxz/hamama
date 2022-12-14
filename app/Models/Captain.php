<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Captain extends Model
{
    use HasFactory;
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    public function sub_city()
    {
        return $this->belongsTo(sub_city::class, 'sub_city_id', 'id');
    }
    public function user()
    {
        return $this->morphOne(User::class, 'actor', 'actor_type', 'actor_id', 'id');
    }
}