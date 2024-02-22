<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;


class CategoryController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth')->except(['index', 'show']);
    }

    public function showCategory()
    {
        $data = array();
        if (Session::has('LoggedUser')) {
        $data = User::where('email', '=', Session::get('LoggedUser'))->first();
    }

        $categories = Category::latest()->paginate(5);;

        return view('user.category.show' ,compact('data' ,'categories'));
    }


    public function createCategory()
    {
        $data = Auth::user();
        return view('user.category.create', compact('data'));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories',
            'image' => 'required|image', // Ensure it's an image
        ]);

        $name = $request->input('name');
        $slug = Str::slug($name, '-');

//        $image = 'storage/' . $request->file('image')->store('CategoryImages', 'public');

        $category = new Category();
        $category->user_id = Auth::user()->id;
        $category->name = $name;
        $category->slug = $slug;
//        $category->image = $image;


        $category->save();

        return redirect()->back()->with('status', 'Category Created Successfully');
    }

    public function editCategory(Category $category)
    {
        $data = array();
        if (Session::has('LoggedUser')) {
        $data = User::where('email', '=', Session::get('LoggedUser'))->first();


    }

        return view('user.category.edit' ,compact('data' ,'category'));
    }


    public function updateCategory(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
        ]);

        // Update name and slug
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('name'));

        // Check if request has a new image
        if ($request->hasFile('image')) {
            // Validate and store the new image
            $request->validate([
                'image' => 'image', // Ensure it's an image
            ]);
            $imagePath = 'storage/' . $request->file('image')->store('CategoryImages', 'public');
            $category->image = $imagePath;
        }

        // Save changes
        $category->user_id = Auth::user()->id;

        $category->save();

        return redirect()->back()->with('status', 'Category Updated Successfully');
    }




    public function deleteCategory(Category $category)
    {
        $category->delete();
        return redirect()->back()->with('status', 'Category Deleted Successfully');
    }
}
