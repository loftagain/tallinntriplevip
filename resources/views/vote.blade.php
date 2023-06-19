@extends('layouts.app')

@section('content')
    <style>
        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
        }

        .col {
            flex: 0 0 33.33%;
            max-width: 33.33%;
            padding: 0 15px;
        }

        .card {
            margin-bottom: 20px;
        }

        .card-body {
            position: relative;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            margin-bottom: 15px;
            line-height: 1.2;
            max-height: 60px;
            overflow: hidden;
        }

        .card-text.expandable {
            max-height: none;
            overflow: visible;
        }

        .expand-description {
            display: block;
            position: absolute;
            bottom: 0;
            right: 0;
            padding: 0;
            font-size: 14px;
            text-decoration: underline;
            cursor: pointer;
        }

        .card-img {
            width: 100%;
            height: auto;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .vote-btn[disabled] {
            background-color: gray;
            cursor: not-allowed;
        }
    </style>

    <div class="container">
        <div class="row">
            @foreach ($posts as $post)
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('storage/' . $post->photo) }}" alt="Post Photo" class="card-img">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text{{ strlen($post->description) > 100 ? ' expandable' : '' }}">
                                @if (strlen($post->description) > 100)
                                    {{ substr($post->description, 0, 100) }}
                                    <a href="#" class="expand-description" onclick="expandDescription(this)">[...]</a>
                                @else
                                    {{ $post->description }}
                                @endif
                            </p>
                            <p class="card-text">Posted by: {{ $post->user->nickname }}</p>
                            <p class="card-text">Posted on: {{ $post->created_at }}</p>
                            <p class="card-text">Votes: {{ $post->votes }}</p>
                            @auth
                                @if ($post->hasVoted)
                                    <button class="btn btn-primary vote-btn" disabled>Already Voted</button>
                                @else
                                    <form action="{{ route('posts.vote', ['postId' => $post->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary vote-btn" id="vote-btn-{{ $post->id }}">Vote</button>
                                    </form>
                                @endif
                            @else
                                <!-- Show a message or link to the login page for non-authenticated users -->
                                <p>Please login to vote</p>
                                <a href="{{ route('login') }}">Login</a>
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        function expandDescription(element) {
            element.previousSibling.classList.toggle('expandable');
            element.textContent = element.textContent === '[...]' ? '[less]' : '[...]';
        }
    </script>
@endsection
