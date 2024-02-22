<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = ['event_id'];

    // Define the relationship with the Event model
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }
}