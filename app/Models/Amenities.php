<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenities extends Model
{
    use HasFactory;


    public function user(){
        return $this->belongsTo(User::class);
    }
// In your Amenity model
  public function properties()
  {
    return $this->belongsToMany(Property::class, 'amenity_property', 'amenity_id', 'property_id');
   }

  // In your Property model
   public function amenities()
  {
    return $this->belongsToMany(Amenity::class, 'amenity_property', 'property_id', 'amenity_id');
  }

  public function apartments()
  {
      return $this->belongsToMany(Apartment::class, 'amenity_properties');
  }

}
