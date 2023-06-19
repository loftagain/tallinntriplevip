@extends('layouts.app')
<style>
    body{
        background-image: url('{{ asset('images/background70.jpg') }}');
            background-size: cover;
            background-position: center;
            
    }
    .virsraksts{
        position: center;
        text-align: center;
        font:bold;
        color:rgb(255, 255, 255);
        font-size: 2rem;
       text-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
        border-radius:4px;
        margin-bottom: 5px;
    }
    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 10px;
        justify-content: center; 
       
        
    }

    .col {
      /*  background-color: rgb(255, 214, 51,0.9);*/
        flex-basis: calc(33.33% - 30px); 
        margin-bottom: 30px; 
        padding: 15px;
    }

    .card {
        width: 100%;
        height: 100%;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.7);
        border-radius: 6px;
        overflow: hidden;
        background-color: rgba(255, 214, 51);

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

    .btn-primary {
        display: inline-block;
        background-color: #007bff;
        color: #fff;
        padding: 5px 10px;
        font-size: 14px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-primary:disabled {
        background-color: #6c757d;
        cursor: not-allowed;
    }
</style>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Top Voted Posts</h1>
                @foreach ($topPosts as $post)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <img src="{{ asset('storage/' . $post->photo) }}" alt="Post Photo">
                            <p class="card-text">Votes: {{ $post->votes }}</p>
                            <p class="card-text">Posted by: {{ $post->user->name }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h1>Blog Entries</h1>
                <!-- Add your form or other content to submit new blog entries -->
            </div>
        </div>
    </div>
@endsection
