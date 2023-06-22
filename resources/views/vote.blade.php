@extends('layouts.app')

@section('content')
<style>
    body{
        background-image: url('{{ asset('images/background70.jpg') }}');
        background-size: cover;
        background-position: center;
    }
    .virsraksts{
        position: center;
        text-align: center;
        font: bold;
        color: rgb(255, 255, 255);
        font-size: 22pt;
        text-shadow: 0 4px 6px rgba(0, 0, 0, 0.5);
        border-radius: 4px;
        margin-bottom: 5px;
    }
    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 10px;
        justify-content: center;
    }

    .col {
        /*flex-basis: calc(33.33% - 30px);*/
        width: 300px;
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
        word-wrap: break-word;
        font-size: 14px;
        line-height: 1.4;
        margin-bottom: 10px;
    }

    .expandable {
        white-space: normal;
        word-wrap: break-word;
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

<div class="virsraksts">Vote for the winner of {{ strtoupper(date('F')) }} {{ date('Y') }}!</div>

<div class="container">
    <div class="row">
        @foreach ($posts as $post)
            <div class="col">
                <div class="card">
                    <img src="{{ asset('storage/' . $post->photo) }}" alt="Post Photo" class="card-img">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text{{ strlen($post->description) > 50 ? ' expandable' : '' }}">
                            @if (strlen($post->description) > 50)
                                <span id="description-{{ $post->id }}" data-shortened-text="{{ substr($post->description, 0, 50) }}" data-full-text="{{ $post->description }}">{{ substr($post->description, 0, 50) }}</span>
                                <a href="#" class="expand-description" data-target="description-{{ $post->id }}" onclick="expandText(event)">[...]</a>
                            @else
                                {{ $post->description }}
                            @endif
                        </p>
                        
                        <p class="card-text{{ strlen($post->visit_description) > 50 ? ' expandable' : '' }}">
                            @if (strlen($post->visit_description) > 50)
                                <span id="visit-description-{{ $post->id }}" data-shortened-text="{{ substr($post->visit_description, 0, 50) }}" data-full-text="{{ $post->visit_description }}">{{ substr($post->visit_description, 0, 50) }}</span>
                                <a href="#" class="expand-visit-description" data-target="visit-description-{{ $post->id }}" onclick="expandText(event)">[...]</a>
                            @else
                                {{ $post->visit_description }}
                            @endif
                        </p>
                        
                        <p class="card-text">@lang('messages.Posted by: '){{ $post->user->nickname }}</p>
                        <p class="card-text">@lang('messages.Posted on: ') {{ $post->created_at }}</p>
                        <p class="card-text">@lang('messages.Votes: '){{ $post->votes }}</p>
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
    function expandText(event) {
    event.preventDefault();
    const targetId = event.target.getAttribute('data-target');
    const targetElement = document.getElementById(targetId);
    const fullText = targetElement.getAttribute('data-full-text');
    const shortenedText = targetElement.getAttribute('data-shortened-text');
    targetElement.classList.toggle('expandable');
    if (targetElement.classList.contains('expandable')) {
        targetElement.textContent = fullText;
        event.target.textContent = '[less]';
    } else {
        targetElement.textContent = shortenedText;
        event.target.textContent = '[...]';
    }
}

</script>
@endsection
