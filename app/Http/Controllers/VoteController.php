<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function vote(Request $request, $postId)
{
    $post = Post::find($postId);
    $user = Auth::user();

    if ($post->votes()->where('user_id', $user->id)->exists()) {
        return redirect()->back()->with('error', 'You have already voted for this post.');
    }

    $post->votes()->attach($user->id);

    return redirect()->back();
}
    public function store(Request $request, $postId)
{
    $post = Post::findOrFail($postId);
    
    // Check if the user has already voted for this post
    $existingVote = Vote::where('post_id', $post->id)
        ->where('user_id', auth()->user()->id)
        ->first();
    
    if ($existingVote) {
        // User has already voted, handle the appropriate action (e.g., show an error message)
        return redirect()->back()->with('error', 'You have already voted for this post.');
    }
    
    // Create a new Vote record
    $vote = new Vote();
    $vote->post_id = $post->id;
    $vote->user_id = auth()->user()->id;
    $vote->save();
    
    // Increment the vote count on the post
    $post->increment('votes');
    
    // Handle the appropriate action after voting (e.g., redirect back to the vote page)
    return redirect()->back()->with('success', 'Vote submitted successfully.');
}

    
    
}
