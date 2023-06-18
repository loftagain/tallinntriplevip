@extends('layouts.app')

@section('content')
    @php
        use App\Models\Post;

        $posts = Post::with('user')->where('user_id', auth()->user()->id)->get();
    @endphp
    {{ __('Welcome back, :nickname!', ['nickname' => auth()->user()->nickname]) }}



    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h1>Add a new post!</h1></div>

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

                        <div class="mt-4">
                            <h2>My posts</h2>
                            @foreach ($posts as $post)
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <p class="card-text">{{ $post->description }}</p>
                                        <img src="{{ asset('storage/' . $post->photo) }}" alt="Post Photo">

                                        <p class="card-text">Author: {{ $post->user->nickname }}</p>
                                        <p class="card-text">Submitted at: {{ $post->submitted_at }}</p>
                                        <p class="card-text">Votes: {{ $post->votes_count }}</p>

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

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
