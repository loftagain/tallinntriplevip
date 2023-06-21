<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
{
    // Get the current month and year
    $currentMonth = now()->format('m');
    $currentYear = now()->format('Y');

    // Retrieve the posts posted during the current month and year
    $posts = Post::whereMonth('submitted_at', $currentMonth)
                 ->whereYear('submitted_at', $currentYear)
                 ->orderBy('submitted_at', 'desc')
                 ->get();

    return view('vote', compact('posts'));
}

    public function __construct()
    {
        $this->middleware('auth'); // Apply the 'auth' middleware to all methods in the controller
    }

    public function store(Request $request)
    {
        // Validate the form inputs
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required|image',
            'visit_description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Store the post in the database
        $post = new Post();
        $post->title = $request->input('title');
        $post->description = $request->input('description');

        // Upload the photo and store the file path
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
            $post->photo = $photoPath;
        }

        $post->visit_description = $request->input('visit_description');
        $post->submitted_at = $request->input('submitted_at');
        $post->user_id = Auth::user()->id;

        $post->save();

        return redirect()->route('home')->with('success', 'Post created successfully!');
    }

    /*public function vote(Request $request, Post $post)
{
    $user = $request->user();

    if ($post->votes()->where('user_id', $user->id)->exists()) {
        return redirect()->back()->with('error', 'You have already voted for this post.');
    }

    $vote = new Vote();
    $vote->user_id = $user->id;
    $vote->post_id = $post->id;
    $vote->save();

    $post->increment('votes');

    return redirect()->route('dashboard')->with('success', 'Vote added successfully.');
}*/





    public function destroy(Post $post)
    {
        // Check if the authenticated user is the author of the post
        if (auth()->user()->id !== $post->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this post.');
        }

        // Delete the post
        $post->delete();

        return redirect()->route('home')->with('success', 'Post deleted successfully!');
    }
}
