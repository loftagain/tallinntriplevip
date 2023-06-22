<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\BlogEntry;

class BlogController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    // Perform authorization checks to ensure the user is an admin
    if (!Auth::check() || !Auth::user()->hasRole('admin')) {
        abort(403); // Unauthorized access
    }

    // Validate the request data
    $validatedData = $request->validate([
        'content' => 'required',
  
    ]);

    // Create a new blog entry
    $blogEntry = BlogEntry::create([
        'content' => $validatedData['content'],
   
    ]);

    // Redirect back to the /wall view
    return redirect('wall');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BlogEntry $blog)
{
    // Perform authorization checks to ensure the user is an admin
    if (!Auth::user()->hasRole('admin')) {
        abort(403); // Unauthorized access
    }

    // Validate the request data
    $validatedData = $request->validate([
        'content' => 'required',
    ]);

    // Update the blog entry
    $blog->update([
        'content' => $validatedData['content'],
    ]);

    // Return a response indicating the update was successful
    return response()->json(['message' => 'Blog post updated successfully']);
}


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        // Add authorization logic here to check if the user has admin role or appropriate permissions to delete the blog post

        $blog->delete();

        return response()->json(['message' => 'Blog post deleted successfully']);
    }
}
