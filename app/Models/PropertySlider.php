<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertySlider extends Model
{
    use HasFactory;

    protected $fillable = ['property_id'];

    // Define the relationship with the Event model
    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
}
