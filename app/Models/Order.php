<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function captain()
    {
        return $this->belongsTo(Captain::class, 'captain_id', 'id');
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function client()
    {
        return $this->belongsTo(client::class, 'client_id', 'id');
    }
    public function street()
    {
        return $this->belongsTo(Street::class);
    }

}