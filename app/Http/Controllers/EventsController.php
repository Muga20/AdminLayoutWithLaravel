<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Slider;

class EventsController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth')->except(['index', 'show']);
    }


    public function showEvents() {

        $user_id = session('user_id');
        $users = User::where('id', '!=', $user_id)->get();
        $events = Event::latest()->paginate(5);

        return view('user.events.show', compact('events', 'users'));
    }

    public function showEventsSlider()
    {
        $events = Slider::with('event')->latest()->paginate(5);

        return view('user.events.slider', compact('events'));
    }


    public function createEvents(){
        $data = Auth::user();

        return view('user.events.create', compact( 'data'));
    }


    public function storeEvents(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'location' => 'required|string',
            'date' => 'required|date',
            'startTime' => 'required|string',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $user_id = Auth::user()->id;

        $eventId = Event::count() + 1;

        $slug = Str::slug($request->input('title'), '-') . '-' . $eventId;

        $imagePaths = [];
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $imagePath = 'storage/' . $image->store('EventImages', 'public');
                $imagePaths[] = $imagePath;
            }
        }

        $eventData = [
            'title' => $request->input('title'),
            'slug' => $slug,
            'description' => $request->input('description'),
            'user_id' => $user_id,
            'image' => json_encode($imagePaths),
            'price' => $request->input('price'),
            'location' => $request->input('location'),
            'date' => $request->input('date'),
            'startTime' => $request->input('startTime')
        ];

        Event::create($eventData);

        return redirect()->back()->with('status', 'Event Created Successfully');
    }


    public function addToSlide(Request $request, $eventId){

        $slider = Slider::create([
            'event_id' => $eventId,
        ]);

        return redirect()->back()->with('success', 'Event added to slider successfully');
    }



    // public function updateEvents(Request $request, Events $blog)
    // {
    //     $request->validate([
    //         'title' => 'required',
    //         'description' => 'required',
    //         'image' => 'image',
    //         'body' => 'required'
    //     ]);

    //     $title = $request->input('title');
    //     $description = $request->input('description');
    //     $category_id = $request->input('category_id');
    //     $body = $request->input('body');

    //     // Update the blog attributes that the user wants to modify
    //     $blog->title = $title;
    //     $blog->description = $description;
    //     $blog->category_id = $category_id;
    //     $blog->body = $body;

    //     // Check if a new image was uploaded
    //     if ($request->hasFile('image')) {
    //         // Remove old image
    //         $blog->deleteImage();

    //         // Store the new image
    //         $image = 'storage/' . $request->file('image')->store('BlogImages', 'public');
    //         $blog->image = $image;
    //     }

    //     $blog->save();

    //     return redirect()->back()->with('status', 'Post Edited Successfully');
    // }

    public function deleteEvents(Event $event){
        $event->delete();
        return redirect()->back()->with('status', 'Post Delete Successfully');
    }


    public function deleteEventsSlider(Slider $event){
        $event->delete();
        return redirect()->back()->with('status', 'Post Delete Successfully');
    }


}
