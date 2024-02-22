<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Amenities;


class AmenitiesController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth')->except(['index', 'show']);
    }

    public function showAmenities()
    {
        $data = array();
        if (Session::has('LoggedUser')) {
        $data = User::where('email', '=', Session::get('LoggedUser'))->first();
    }

        $amenity = Amenities::latest()->paginate(5);;

        return view('user.amenities.show' ,compact('data' ,'amenity'));
    }


    public function createAmenities()
    {
        $data = Auth::user();
        return view('user.amenities.create', compact('data'));
    }

    public function storeAmenities(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $name = $request->input('name');
        $slug = Str::slug($name, '-');

        $amenity = new Amenities();
        $amenity->user_id = Auth::user()->id;
        $amenity->name = $name;
        $amenity->slug = $slug;



        $amenity->save();

        return redirect()->back()->with('status', 'Amenities Created Successfully');
    }

    public function editAmenities(Amenities $amenity)
    {
        $data = array();
        if (Session::has('LoggedUser')) {
        $data = User::where('email', '=', Session::get('LoggedUser'))->first();


    }

        return view('user.amenities.edit' ,compact('data' ,'amenity'));
    }


    public function updateAmenities(Request $request, Amenities $amenity)
    {
        $request->validate([
            'name' => 'required|unique:amenities,name,' . $amenity->id,
        ]);

        // Update name and slug
        $amenity->name = $request->input('name');
        $amenity->slug = Str::slug($request->input('name'));


        // Save changes
        $amenity->user_id = Auth::user()->id;
        $amenity->save();

        return redirect()->back()->with('status', 'Amenities Updated Successfully');
    }




    public function deleteAmenities(Amenities $amenity)
    {
        $amenity->delete();
        return redirect()->back()->with('status', 'Amenities Deleted Successfully');
    }
}
