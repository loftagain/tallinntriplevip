<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Post;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function submitVote(Request $request, $postId)
{
    $user = Auth::user();
    $post = Post::findOrFail($postId);

    // Check if the user has already voted on the post
    if ($post->votes()->where('user_id', $user->id)->exists()) {
        // Handle the case when the user has already voted
        // You can redirect back with a message or show an error
        return redirect()->back()->with('error', 'You have already voted on this post.');
    }

    // Create a new vote
    $vote = new Vote();
    $vote->user_id = $user->id;
    $vote->post_id = $post->id;
    $vote->save();

    // Increment the vote count for the post
    $post->increment('votes');

    // Redirect back with a success message or to a success page
    return redirect()->back()->with('success', 'Vote submitted successfully.');
}

}
