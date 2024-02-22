<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Attachment;
use App\Models\Property;



class AttachmentController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth')->except(['index', 'show']);
    }

    public function showAttachment()
    {
        $attachments = Attachment::latest()->paginate(5);

        return view('user.attachments.show', compact('attachments'));

    }

    public function createAttachment()
    {
        $data = Auth::user();
        $properties = Property::all();
        return view('user.attachments.create', compact('data' , 'properties'));
    }

    public function storeAttachment(Request $request)
    {
        $request->validate([
            'filename' => 'required',
            'file' => 'required|file',
        ]);

        $filename = $request->input('filename');
        $property_id = $request->input('property_id');

        if ($request->hasFile('file')) {
            $file = 'storage/' . $request->file('file')->store('Files', 'public');
        } else {
            return redirect()->back()->withErrors(['file' => 'The file field is required.'])->withInput();
        }

        $attachment = new Attachment();
        $attachment->filename = $filename;
        $attachment->property_id = $property_id;
        $attachment->file = $file;

        $attachment->save();

        return redirect()->back()->with('status', 'Attachment Created Successfully');
    }


    public function deleteAttachment(Attachment $attachment)
    {
       $attachment->delete();
        return redirect()->back()->with('status', 'Attachment Deleted Successfully');
    }
}
