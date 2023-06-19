@extends('layouts.app')

@section('content')
<style>
    body{
        background-image: url('{{ asset('images/background70.jpg') }}');
            background-size: cover;
            background-position: center;
            
    }
    .virsraksts, .virsraksts2{
        position: center;
        text-align: center;
        font:bold;
        color:rgb(255, 255, 255);
        font-size: 12pt;
       text-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
        border-radius:4px;
        margin-bottom: 5px;
    }
    .virsraksts2{
color:black;
/*text-shadow: 0 4px 6px rgba(255, 255, 255, 1);*/
    }
    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 10px;
        align-items: center;
        justify-content: center; 
       
        
    }

  /*  .col {
      /*  background-color: rgb(255, 214, 51,0.9);*/
        flex-basis: calc(33.33% - 30px); 
        margin-bottom: 30px; 
        padding: 15px;
    /*}*/
.pirmais {

   

}
    .pirmais, .mt-2 {
        width: 100%;
        height: 100%;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.7);
        border-radius: 6px;
        overflow: hidden;
        background-color: rgba(255, 214, 51);
margin: 15px 15px 15px;
padding: 15px;
justify-content: center;
    }

    .card-img {
        width: 100%;
        height: auto;
    }

    .card-body {
        padding: 0px 15px 15px;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card-text {
        font-size: 14px;
        line-height: 1.4;
        margin-bottom: 10px;
    }

    .expandable {
        white-space: normal;
    }
   

</style>

    @php
        use App\Models\Post;
        $posts = App\Models\Post::with('user')
    ->where('user_id', auth()->user()->id)
    ->orderBy('submitted_at', 'desc')
    ->get();

    @endphp
    

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="virsraksts"><h1>{{ __('Welcome back, :nickname, add a new post!', ['nickname' => auth()->user()->nickname]) }}</h1></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="pirmais">
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
                     </div>
                    <div class="virsraksts2"><h1>{{'My history' }}</h1></div>
                   
                        <div class="otrais"><div class="mt-4">
                            
                            @foreach ($posts as $post)
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $post->title }}</h5>
                                        <p class="card-text">{{ $post->description }}</p>
                                        <img src="{{ asset('storage/' . $post->photo) }}" alt="Post Photo">
                                        <p class="card-text">{{ $post->visit_description }}</p>

                                        <p class="card-text">Author: {{ $post->user->nickname }}</p>
                                        <p class="card-text">Submitted at: {{ $post->submitted_at }}</p>
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
                            
                    </div></div>
                </div>
            </div>
        </div>
    </div>
@endsection
