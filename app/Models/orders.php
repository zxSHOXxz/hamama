<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function client()
    {
        return $this->belongsTo(client::class);
    }
    public function street()
    {
        return $this->belongsTo(City::class);
    }
    public function captain()
    {
        return $this->belongsTo(Captain::class);
    }
}