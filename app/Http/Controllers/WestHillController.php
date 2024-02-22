<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Gallery;
use App\Models\PropertySlider;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Blog;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;


class WestHillController extends Controller
{
    public function index()
    {
        $home = config('home');
        $categories = Category::latest()->paginate(5);
        $blogs = Blog::latest()->paginate(5);

        $cheapProperty = Property::orderBy('selling_price')->paginate(3);
        $expensiveProperty = Property::orderBy('selling_price', 'desc')->paginate(3);

        $property = Property::latest()->paginate(5);
        $properties = PropertySlider::with('property')->latest()->paginate(5);
        $backgroundImages = Property::latest()->pluck('image')->first();
        $backgroundImagesArray = json_decode($backgroundImages);
        $backgroundImage = !empty($backgroundImagesArray) ? $backgroundImagesArray[0] : null;


        return view('westhill.index', compact('categories', 'blogs', 'property', 'properties', 'backgroundImage' , 'cheapProperty' ,'expensiveProperty' ,'home'));
    }


    public function about ()
    {

        return view('westhill.about');
    }

    public function events ()
    {
        $user_id = session('user_id');
        $users = User::where('id', '!=', $user_id)->get();
        $events = Event::latest()->paginate(10);

        return view('westhill.events' , compact('users' , 'events'));
    }

    public function gallery ()
    {
        $gallery = Gallery::latest()->paginate(5);
        return view('westhill.gallery' , compact('gallery'));
    }

    public function singleGallery ($galleries = null)
    {
        $galleries = Gallery::where('slug', $galleries)->firstOrFail();
        return view('westhill.constants.singleGallery' , compact('galleries'));
    }

    public function awards()
    {
        return view('westhill.awards' );
    }

    public function faqs()
    {

        $faq = config('faq');

        return view('westhill.faqs' , compact('faq'));
    }

    public function videos ()
    {

        return view('westhill.videos');
    }

    public function contact()
    {

        return view('westhill.contact');
    }

    public  function diaspora()
    {
       return view('westhill.diaspora');
    }

    public function property(Request $request)
    {
        $keyword = $request->input('keyword');
        $sortBy = $request->input('sort_by');
        $query = Property::query();
        if ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('location', 'like', '%' . $keyword . '%');
        }
        switch ($sortBy) {
            case 'location':
                $query->orderBy('location');
                break;
            case 'price_least':
                $query->orderBy('selling_price');
                break;
            case 'price_expensive':
                $query->orderByDesc('selling_price');
                break;
            default:
                $query->latest(); // Default sorting
                break;
        }

        $properties = $query->paginate(15);
        $propertiesCount = $properties->total();
        $categories = Category::latest()->paginate(5);

        return view('westhill.property',
                  compact('categories', 'properties', 'propertiesCount'));
    }

    public function blog()
    {
        $blogs = Blog::latest()->paginate(1);
        $category = Category::all();
        $categories = Category::latest()->paginate(5);
        $locationsWithCount = Property::groupBy('location')
            ->select('location', DB::raw('COUNT(*) as property_count'))
            ->get();
        $gallery = Gallery::latest()->paginate(5);

        return view('westhill.blogs' , compact('blogs' , 'categories' ,'category' ,'locationsWithCount' ,'gallery' ));
    }

    public function singleBlog($blog = null)
    {
        $blog = Blog::where('slug', $blog)->firstOrFail();
        $category = Category::all();
        $categories = Category::latest()->paginate(5);
        $blogs = Blog::latest()->paginate(5);
        $locationsWithCount = Property::groupBy('location')
            ->select('location', DB::raw('COUNT(*) as property_count'))
            ->get();
        $gallery = Gallery::latest()->paginate(5);


        return view('westhill.constants.singleBlog',
                             compact('blog' , 'categories' ,'category' ,'blogs' ,'locationsWithCount' ,'gallery' ));
    }

    public function singleProperty( $property = null ){

        $property = Property::where('slug', $property)->firstOrFail();
//        $attachments = DB::table('attachments')->where('property_id', $property->id)->get();
        $category = Category::all();
        $categories = Category::latest()->paginate(5);
        $properties = Property::latest()->paginate(5);
        $locationsWithCount = Property::groupBy('location')
            ->select('location', DB::raw('COUNT(*) as property_count'))
            ->get();
        return view('westhill.constants.singleProperty' ,
                              compact('property' , 'category' , 'categories' , 'properties' ,'locationsWithCount' ));
    }


}
