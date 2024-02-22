<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Swiper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Property;
use Carbon\Carbon;


class DashController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function dashboard()
    {
        $swiper = Swiper::all();
        $data = Auth::user();

        $propertiesAddedCounts = [];
        $propertiesBoughtCounts = [];

        for ($i = 1; $i <= 12; $i++) {
            $propertiesAddedCount = Property::whereMonth('created_at', '=', $i)->count();
            $propertiesBoughtCount = Property::whereMonth('created_at', '=', $i)
                ->where('status', false)
                ->count();

            $propertiesAddedCounts[] = $propertiesAddedCount;
            $propertiesBoughtCounts[] = $propertiesBoughtCount;
        }

        $property = Property::latest()->paginate(5);

        // Retrieve comments for today's date
        $todayComments = Comment::with('property', 'apartment')
            ->whereDate('created_at', Carbon::today())
            ->paginate(5);

        return view('user.dash.show', compact('swiper', 'data', 'property', 'propertiesAddedCounts', 'propertiesBoughtCounts', 'todayComments'));
    }

    public function getCommentsCount()
    {
        $today = Carbon::today();
        $comments = Comment::whereDate('created_at', $today)->get();
        $count = $comments->count();
        return response()->json(['count' => $count, 'comments' => $comments]);
    }

    public function createSwiper()
    {
        $data = Auth::user();
        return view('user.sliders.create', compact('data'));
    }

    public function showSwiper()
    {
        $data = Auth::user();
        $swiper = Swiper::all();

        return view('user.sliders.show', compact('data', 'swiper'));
    }


    public function calendar()
    {
        $events = Event::all();
        return view('user.dash.calender' , compact('events'));
    }



    public function storeSwiper(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required',
        ]);

        $title = $request->input('title');
        $slug = Str::slug($title, '-');

        $imagePaths = [];
        if ($request->hasFile('image')) {
          foreach ($request->file('image') as $image) {
              $imagePath = 'storage/' . $image->store('EventImages', 'public');
              $imagePaths[] = $imagePath;
          }
        }

        $swiper = new Swiper();

        $swiper->user_id = Auth::user()->id;
        $swiper->title = $title;
        $swiper->slug = $slug;
        $swiper->image = json_encode($imagePaths);

        $swiper->save();

        return redirect()->back()->with('status', 'Swiper Created Successfully');
    }




}
