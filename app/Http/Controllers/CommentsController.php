<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Validation\ValidationException;

class CommentsController extends Controller
{

    public function storeCommentForProperty(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'message' => 'required',
                'email' => 'required|email',
                'property_id' => 'nullable|exists:properties,id',
                'apartment_id' => 'nullable|exists:apartments,id',
            ]);

            $comment = new Comment();
            $comment->property_id = $request->input('property_id');
            $comment->apartment_id = $request->input('apartment_id');
            $comment->name = $request->input('name');
            $comment->email = $request->input('email');
            $comment->message = $request->input('message');

            $comment->save();

            return back()->with('status', 'Comment created successfully');

        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while processing your request');
        }
    }

}
