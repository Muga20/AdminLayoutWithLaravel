<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Gallery;


class  GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function showGallery()
    {
        $data = array();
        if (Session::has('LoggedUser')) {
            $data = User::where('email', '=', Session::get('LoggedUser'))->first();
        }
        $gallery = Gallery::latest()->paginate(5);;

        return view('user.gallery.show', compact('data', 'gallery'));
    }


    public function createGallery()
    {
        $data = Auth::user();
        return view('user.gallery.create', compact('data'));
    }

    public function storeGallery(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        $name = $request->input('name');
        $slug = Str::slug($name, '-');

        $imagePaths = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imagePath = 'storage/' . $image->store('GalleryImages', 'public');
                $imagePaths[] = $imagePath;
            }
        }

       $gallery = new Gallery();
       $gallery->user_id = Auth::user()->id;
       $gallery->name = $name;
       $gallery->slug = $slug;
       $gallery->image = json_encode($imagePaths);


       $gallery->save();

        return redirect()->back()->with('status', 'Gallery Created Successfully');
    }

    public function deleteGallery(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->back()->with('status', 'Gallery Deleted Successfully');
    }
}
