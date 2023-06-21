@extends('layouts.app')
@section('content')
<style>
    body {
        background-image: url('{{ asset('images/background70.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
            height: 100vh;
       
            overflow-y:hidden;
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
</style>

<div class="virsraksts">Top Voted Posts</div>
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

    <div class="row blogs">
        <div class="col-md-8 offset-md-2">
            <div class="virsraksts">Blog Entries</div>
            <!-- Add your form or other content to submit new blog entries -->
        </div>
    </div>
</div>
@endsection
