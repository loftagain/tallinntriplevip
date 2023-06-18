<?php 
namespace App\Models;

use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    
// Post.php (Post model)

protected $appends = ['hasVoted'];

public function getHasVotedAttribute()
{
    // Logic to determine if the user has voted for the post
    return $this->votes()->where('user_id', auth()->id())->exists();
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

   
}
