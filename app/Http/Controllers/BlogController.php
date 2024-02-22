<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Tags;
use Illuminate\Support\Facades\Storage;


class BlogController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth')->except(['index', 'show']);
    }


    public function showBlogs(){

        $data = Auth::user();
        $user_id = session('user_id');
        $users = User::where('id', '!=', $user_id)->get();
        $categories = Category::all();
        $blogs = Blog::latest()->paginate(5);
        return view('user.blogs.show', compact('blogs', 'categories' , 'users' ,'data'));

    }

    public function createBlogs()
    {

            $user = Auth::user();
            $categories = Category::all();
            $tags = $user->tags;

            return view('user.blogs.create', compact('categories', 'tags'));
    }



    public function storeBlogs(Request $request){

        // dd('request' , $request);

       $request->validate([
           'title' => 'required',
           'description' => 'required',
           'image' => 'required | image',
           'body' => 'required',
           'category_id' => 'required'
       ]);



       $title = $request->input('title');

       $category_id = $request->input('category_id');
       $description =$request->input('description');
       if(Blog::latest()->first() !== null){
        $blogId = Blog::latest()->first()->id + 1;
       } else{
           $blogId = 1;
       }

       $slug = Str::slug($title, '-') . '-' . $blogId;
       $user_id = Auth::user()->id;
       $body = $request->input('body');

       //File upload
       $image = 'storage/' . $request->file('image')->store('BlogImages', 'public');

       $blog = new Blog();
       $blog->title = $title;
       $blog->category_id = $category_id;
       $blog->slug = $slug;
       $blog->description = $description;
       $blog->user_id = $user_id;
       $blog->body = $body;
       $blog->image = $image;

       $blog->save();

       return redirect()->back()->with('status', 'Post Created Successfully');
    }


    public function editBlogs(Blog $blog){

        $data = Auth::User();
        $categories = Category::all();

        return view('user.blogs.edit', compact('blog' , 'categories' ,'data'));
    }

    // public function updateBlogs(Request $request, Blog $blog)
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


    public function updateBlogs(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image',
            'body' => 'required'
        ]);

        // Update the blog attributes
        $blog->title = $request->input('title');
        $blog->description = $request->input('description');
        $blog->category_id = $request->input('category_id');
        $blog->body = $request->input('body');

        // Check if a new image was uploaded
        if ($request->hasFile('image')) {
            // Validate and store the new image
            $request->validate([
                'image' => 'image', // Ensure it's an image
            ]);
            $imagePath = $request->file('image')->store('BlogImages', 'public');
            $blog->image = 'storage/' . $imagePath;

            // Delete the old image if it exists
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
        }

        // Save changes
        // $blog->user_id = Auth::user()->id;
        $blog->save();

        return redirect()->back()->with('status', 'Post Edited Successfully');
    }





    public function deleteBlogs(Blog $blog){
        $blog->delete();
        return redirect()->back()->with('status', 'Post Delete Successfully');
    }
}
