@extends('layouts.app')
@section('content')
<style>
        .virsraksts{
        position: center;
        text-align: center;
        font:bold;
        color:rgb(255, 255, 255);
        font-size: 22pt;
        text-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
        border-radius:4px;
        margin-bottom: 5px;
    }
    body {
        background-image: url('{{ asset('images/background70.jpg') }}');
        background-size: cover;
        background-position: center;
        height: 100vh;
        
    }
    .card,
.card2 {
    margin: 0 auto; /* Center the card horizontally */
    margin-bottom: 20px;
    align-content: center;
    width: 50%;
    justify-content: center;
    align-content: center;
    text-align: center;
    padding: 10px; 
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.7);
    border-radius: 6px;
    overflow: hidden;
    background-color: rgba(255, 214, 51);
}

.card2 {
    background-color: transparent; 
    box-shadow: none; 
    text-align: left;
    width: 45%;
    padding: 10px; 
}

.mt-2 {
    margin: 10px 0; /* Adjust margin to add space between cards */
    justify-content: left;
    background-color: rgba(255, 214, 51);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.7);
    border-radius: 6px;
    padding: 10px; 
    max-width: 100%;
}
.mt-2 img {
    max-width: 100%; /* Ensure images fit within the container */
}

.card + .card {
margin-top: 20px;
}   
p {
    line-height: 1.5em;
}

.card-body {
    padding: 15px 15px 15px;
}
</style>
    @php
        use App\Models\Post;
        $posts = Post::with('user')->where('user_id', auth()->user()->id)->get();
    @endphp
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="virsraksts">{{ __('Welcome back, :nickname, add a new post!', ['nickname' => auth()->user()->nickname]) }}</div>
                  
                <div class="card">
                     <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                    
                        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title of the Recipe</label>
                                <input type="text" id="title" name="title" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Recipe Description</label>
                                <textarea id="description" name="description" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo of the Visit</label>
                                <input type="file" id="photo" name="photo" class="form-control-file" required>
                            </div>
                            <div class="form-group">
                                <label for="visit_description">Description of the Visit</label>
                                <textarea id="visit_description" name="visit_description" class="form-control" required></textarea>
                            </div>
                            <input type="hidden" name="submitted_at" value="{{ now() }}">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div></div>
            </div>
            <div class="virsraksts">My history</div>
                  
                    <div class="card2">
                        <div class="mt-4">
                            
                            @foreach ($posts as $post)
                                <div class="mt-2">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <p class="card-text">{{ $post->description }}</p>
                                        <img src="{{ asset('storage/' . $post->photo) }}" alt="Post Photo">

                                        <p class="card-text">Author: {{ $post->user->nickname }}</p>
                                        <p class="card-text">Submitted at: {{ $post->submitted_at }}</p>
                                        <p class="card-text">Votes: {{ $post->votes_count }}</p>
                                        <p class="card-text">Votes: {{ $post->votes}}</p>

                                        @if(auth()->user()->id === $post->user_id)
                                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        </div>
                    
            </div>
        </div>
    </div>
@endsection