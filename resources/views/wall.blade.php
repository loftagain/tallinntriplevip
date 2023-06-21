@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tinymce@5.9.2/themes/silver/theme.min.css">
<script src="https://cdn.jsdelivr.net/npm/tinymce@5.9.2/tinymce.min.js"></script>

<link rel="stylesheet" href="{{ asset('css/tiny-mce/skins/ui/oxide/skin.min.css') }}">
<script src="{{ asset('tiny-mce/tinymce.min.js') }}"></script>
<script src="{{ asset('tinymce-config.js') }}"></script>


<style>
    body {
        background-image: url('{{ asset('images/background70.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    
    }
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

    .top-posts {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        margin-bottom: 20px;
    }

    .top-posts .card {
        margin: 0 10px 20px;
        flex-basis: calc(30% - 20px); /* Adjust the width of each card as per your preference */
        max-width: 300px; /* Limit the maximum width of each card */
    }

    .blogs {
        margin-top: 30px;
    }

    .blogs .col {
        margin-bottom: 30px;
    }

    .card {
        width: auto;
        justify-items: center;
        height: auto;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.7);
        border-radius: 6px;
        overflow: hidden;
        background-color: rgba(255, 214, 51);
    }

    .card-img {
        width: 100%;
        height: auto;
        object-fit: cover;
        max-height: 200px; /* Limit the maximum height of the card image */
    }

    .card-body {
        padding: 0px 15px 15px;
        display: inline-block;
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
    /*papildu admin*/
.tinymce-editor{
    width: 100px;
}
.cardblog {
    margin: 0 auto; /* Center the card horizontally */
    margin-bottom: 20px;
    align-content: center;
   
    justify-content: center;
    align-content: center;
    text-align: center;
    padding: 10px; 
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.7);
    border-radius: 6px;
    overflow: hidden;
    background-color: rgba(255, 214, 51);

  margin-top:20px;
    width: 45%;
    padding: 10px; 
}

/*.cardwithin {
    margin: 10px 0;
    justify-content: left;
    background-color: rgba(255, 214, 51);
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.7);
    border-radius: 6px;
    padding: 10px; 
    max-width: 100%;
    padding: 15px 15px 15px;
}*/

.cardblog + .cardblog {
margin-top: 20px;
}   


</style>

<div class="virsraksts">We will pick a winner from:</div>
<div class="container">
    <div class="row">
        <div class="col-md-12 top-posts">
            @foreach ($topPosts as $post)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <img src="{{ asset('storage/' . $post->photo) }}" alt="Post Photo" class="card-img">
                        <p class="card-text">Votes: {{ $post->votes }}</p>
                        <p class="card-text">Posted by: {{ $post->user->nickname }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @if (Auth::check() && Auth::user()->hasRole('admin'))
    <div class="row blogs">
        <div class="col-md-8 offset-md-2">
            <div class="virsraksts">Blog Entries</div>
            <!-- Add your form or other content to submit new blog entries -->
           <div>
    <!-- Display the form for adding a blog entry -->
    <form action="{{ route('blog.store') }}" method="POST">
        @csrf
        
        <textarea name="content" class="tinymce-editor"></textarea>
    
        <button type="submit">Add Blog Entry</button>
    </form></div>
    @else 
    <div class="virsraksts">Previous winners + news!</div>
@endif

<!-- Display existing blog entries -->
@foreach ($blogs as $blog)

    <div class="cardblog">

        <div>{!! $blog->content !!}</div>
    </div>
@endforeach


        </div>
    </div>
</div>
@endsection
