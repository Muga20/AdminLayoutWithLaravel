<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Property;
use App\Models\Amenities;
use App\Models\AmenityProperty;
use App\Models\Apartment;
use App\Models\PropertySlider;





class PropertyController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth')->except(['index', 'show']);
    }


    public function showProperty() {

        $users = Auth::user();
        $properties = Property::latest()->paginate(5);
        $category = Category::all();

        return view('user.property.show', compact('properties', 'users' , 'category'));
    }


    public function showApartment() {

        $users = Auth::user();
        $properties = Apartment::with('amenities')->latest()->paginate(5);
        $category = Category::all();

        return view('user.property.showApartment',compact('properties', 'users' , 'category'));
    }



    public function createProperty() {

        $users = Auth::user();
        $categories = Category::all();
        return view('user.property.create', compact('users' , 'categories' ));

    }

    public function createPropertyAp() {

        $users = Auth::user();
        $categories = Category::all();
        $amenities = Amenities::all();
        return view('user.property.createApartment',  compact('users' , 'categories' , 'amenities'));

    }


    public function storeProperty(Request $request)
  {

    // Generate slug from the name
    $slug = Str::slug($request->input('name'), '-');

    // Create new Property instance
    $property = new Property();

    // Set properties from request
    $property->name = $request->input('name');
    $property->selling_price = $request->input('selling_price');
    $property->description = $request->input('description');
    $property->slug = $slug;
    $property->measurement = $request->input('measurement');
    $property->location = $request->input('location');
    $property->category_id = $request->input('category_id');

    // Manually set data for specific properties

    $property->reviews = "null";

    // Set default value for status
    $property->status = true;

    // Handle image upload
    $imagePaths = [];
    if ($request->hasFile('image')) {
        foreach ($request->file('image') as $image) {
            $imagePath = 'storage/' . $image->store('EventImages', 'public');
            $imagePaths[] = $imagePath;
        }
    }

    // Encode image paths to JSON
    $property->image = json_encode($imagePaths);
    $property->user_id = Auth::user()->id;


    // Save the property
    $property->save();

    return redirect()->back()->with('status', 'Property Created Successfully');
  }


  public function storePropertyAP(Request $request)
  {
      // Generate slug from the name
      $slug = Str::slug($request->input('name'), '-');

      // Create new Property instance
      $property = new Apartment();

      $property->name = $request->input('name');
      $property->selling_price = $request->input('selling_price');
      $property->description = $request->input('description');
      $property->slug = $slug;
      $property->measurement = $request->input('measurement');
      $property->location = $request->input('location');
      $property->category_id = $request->input('category_id');

      // Manually set data for specific properties
      $property->number_of_bedrooms = $request->input('number_of_bedrooms');
      $property->all_rooms = $request->input('all_rooms');
      $property->number_of_kitchen = $request->input('number_of_kitchen');
      $property->number_of_bathrooms = $request->input('number_of_bathrooms');
      $property->reviews = "null";

      // Set default value for status
      $property->status = true;

      // Handle image upload
      $imagePaths = [];
      if ($request->hasFile('image')) {
          foreach ($request->file('image') as $image) {
              $imagePath = 'storage/' . $image->store('PropertyImages', 'public');
              $imagePaths[] = $imagePath;
          }
      }

      // Encode image paths to JSON
      $property->image = json_encode($imagePaths);
      $property->user_id = Auth::user()->id;

      // Save the property
      $property->save();

      $this->createAmenity($property, $request->input('amenity_id'));


      return redirect()->back()->with('status', 'Property Created Successfully');
  }

  public function createAmenity(Apartment $apartment, $amenity_ids)
  {
      foreach ($amenity_ids as $amenity_id) {

          $amenity = new AmenityProperty();

          $amenity->property_id = $apartment->id;
          $amenity->amenity_id = $amenity_id;

          // Save the amenity
          $amenity->save();
      }
  }


  public function editProperty(Property $property) {

    $users = Auth::user();
    $category = Category::all();

    return view('user.property.edit',  compact('users' , 'category' , 'property'));

}


public function updateProperty(Request $request , Property $property)
{
    // Generate slug from the name
    $slug = Str::slug($request->input('name'), '-');

    // Create new Property instance
    $property->name = $request->filled('name') ? $request->input('name') : $property->name;
    $property->selling_price = $request->filled('selling_price') ? $request->input('selling_price') : $property->selling_price;
    $property->description = $request->filled('description') ? $request->input('description') : $property->description;
    $property->slug = $request->filled('name') ? Str::slug($request->input('name'), '-') : $property->slug;
    $property->measurement = $request->filled('measurement') ? $request->input('measurement') : $property->measurement;
    $property->location = $request->filled('location') ? $request->input('location') : $property->location;
    $property->category_id = $request->filled('category_id') ? $request->input('category_id') : $property->category_id;



    // You might want to check if 'reviews' field exists in your request before updating it
    $property->reviews = 'null';


    // Set default value for status
    $property->status = true;

    // Handle image upload only if there's a new image
    if ($request->hasFile('image')) {
        $imagePaths = [];
        foreach ($request->file('image') as $image) {
            $imagePath = 'storage/' . $image->store('PropertyImages', 'public');
            $imagePaths[] = $imagePath;
        }
        // Encode image paths to JSON
        $property->image = json_encode($imagePaths);
    }

    $property->user_id = Auth::user()->id;

    // Save the property
    $property->save();

    return redirect()->back()->with('status', 'Property Updated Successfully');
}

public function editPropertyAp(Property $property) {

    $users = Auth::user();
    $category = Category::all();
    $amenities = Amenities::all();

    return view('user.property.editApartmentAp',
                 compact('users' , 'category' , 'amenities' , 'property'));

}

public function updatePropertyAp(Request $request, Apartment $property)
{
    // Validate the request data if needed

    // Update the existing property
    $property->name = $request->filled('name') ? $request->input('name') : $property->name;
    $property->selling_price = $request->filled('selling_price') ? $request->input('selling_price') : $property->selling_price;
    $property->description = $request->filled('description') ? $request->input('description') : $property->description;
    $property->slug = $request->filled('name') ? Str::slug($request->input('name'), '-') : $property->slug;
    $property->measurement = $request->filled('measurement') ? $request->input('measurement') : $property->measurement;
    $property->location = $request->filled('location') ? $request->input('location') : $property->location;
    $property->category_id = $request->filled('category_id') ? $request->input('category_id') : $property->category_id;

    // Manually set data for specific properties if they are present in the request
    $property->number_of_bedrooms = $request->filled('number_of_bedrooms') ? $request->input('number_of_bedrooms') : $property->number_of_bedrooms;
    $property->all_rooms = $request->filled('all_rooms') ? $request->input('all_rooms') : $property->all_rooms;
    $property->number_of_kitchen = $request->filled('number_of_kitchen') ? $request->input('number_of_kitchen') : $property->number_of_kitchen;
    $property->number_of_bathrooms = $request->filled('number_of_bathrooms') ? $request->input('number_of_bathrooms') : $property->number_of_bathrooms;

    // You might want to check if 'reviews' field exists in your request before updating it
    // $property->reviews = 'null'; // If 'reviews' is a field in the property table, you can decide how to handle it.

    // Set default value for status
    $property->status = true;

    // Handle image upload only if there's a new image
    if ($request->hasFile('image')) {
        $imagePaths = [];
        foreach ($request->file('image') as $image) {
            $imagePath = 'storage/' . $image->store('PropertyImages', 'public');
            $imagePaths[] = $imagePath;
        }
        // Encode image paths to JSON
        $property->image = json_encode($imagePaths);
    }

    $property->user_id = Auth::user()->id;

    // Save the updated property
    $property->save();

    // Handle updating amenities
    $amenity_ids = $request->input('amenity_ids', []);
    $this->updateAmenities($property, $amenity_ids);

    return redirect()->back()->with('status', 'Property Updated Successfully');
}


public function updateAmenities(Apartment $property, $amenity_ids)
{
    // Sync the amenities for the apartment
    $property->amenities()->sync($amenity_ids);
}


public function deletePropertyAp(Apartment $property)
{
    $property->delete();
    return redirect()->back()->with('status', 'Apartment Deleted Successfully');
}


public function deleteProperty(Property $property)
{
    $property->delete();
    return redirect()->back()->with('status', 'Property Deleted Successfully');
}



public function addPropertyToSlide(Request $request, $property){

    $slider = PropertySlider::create([
        'property_id' => $property,
    ]);

    return redirect()->back()->with('success', 'Property added to slider successfully');
}

public function showPropertySlider()
{
    $properties = PropertySlider::with('property')->latest()->paginate(5);

    return view('user.property.slider', compact('properties'));
}

    public function deletePropertySlider(PropertySlider $slider)
    {
        $slider->delete();
        return redirect()->back()->with('status', 'Property Deleted Successfully');
    }

}
