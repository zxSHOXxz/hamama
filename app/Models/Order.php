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
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
    public function sub_city()
    {
        return $this->belongsTo(Sub_City::class);
    }

}