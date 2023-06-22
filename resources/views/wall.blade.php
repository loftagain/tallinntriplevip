@extends('layouts.app')
@section('content')

{{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tinymce@5.9.2/themes/silver/theme.min.css">
<script src="https://cdn.jsdelivr.net/npm/tinymce@5.9.2/tinymce.min.js"></script>

<link rel="stylesheet" href="{{ asset('css/tiny-mce/skins/ui/oxide/skin.min.css') }}">
<script src="{{ asset('tiny-mce/tinymce.min.js') }}"></script>
<script src="{{ asset('tinymce-config.js') }}"></script>--}}

<meta name="csrf-token" content="{{ csrf_token() }}">


<style>
  
    .virsraksts{
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

.cardblog + .cardblog {
margin-top: 20px;
}   

</style>

<div class="virsraksts">{{ __('messages.We will pick a winner from:') }}</div>

<div class="container">
    <div class="row">
        <div class="col-md-12 top-posts">
            @foreach ($topPosts as $post)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <img src="{{ asset('storage/' . $post->photo) }}" alt="Post Photo" class="card-img">
                        <p class="card-text">{{ __('messages.Votes: ') }}{{ $post->votes }}</p>
                        <p class="card-text">@lang('messages.Posted by: '){{ $post->user->nickname }}</p>
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
           <div class="cardblog">
    <!-- Display the form for adding a blog entry -->
    <form action="{{ route('blog.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
        </div>
    
        <button type="submit">Add Blog Entry</button>
    </form></div>
    @else 
    <div class="virsraksts">@lang('messages.Previous winners + news!')</div>
@endif

<!-- Display existing blog entries -->
@foreach ($blogs as $blog)
    <div class="cardblog">
        <div class="blog-content" data-blog-id="{{ $blog->id }}">{!! $blog->content !!}</div>
        @if (Auth::check() && Auth::user()->hasRole('admin'))
            <button class="edit-button" data-blog-id="{{ $blog->id }}">Edit</button>
        @endif
    </div>
@endforeach

<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('.edit-button').click(function () {
            var blogId = $(this).data('blog-id');
            var blogContent = $('.blog-content[data-blog-id="' + blogId + '"]').html();
            
            // Replace the blog content with a textarea for editing
            $('.blog-content[data-blog-id="' + blogId + '"]').html('<textarea class="edit-textarea">' + blogContent + '</textarea>');

            // Replace the edit button with a save button
            $(this).replaceWith('<button class="save-button" data-blog-id="' + blogId + '">Save</button>');
        });

        $(document).on('click', '.save-button', function () {
            var blogId = $(this).data('blog-id');
            var editedContent = $('.edit-textarea').val();

            // Send an AJAX request to update the blog post
            $.ajax({
    url: '/blogs/' + blogId,
    method: 'PUT',
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    data: {
        content: editedContent
    },
    success: function () {
        // Replace the textarea with the updated blog content
        $('.blog-content[data-blog-id="' + blogId + '"]').html(editedContent);

        // Replace the save button with the edit button
        $('.save-button[data-blog-id="' + blogId + '"]').replaceWith('<button class="edit-button" data-blog-id="' + blogId + '">Edit</button>');
    },
    error: function (xhr, status, error) {
        // Handle the error if the update fails
        console.log(error);
    }
});

        });
    });
</script>




        </div>
    </div>
</div>
@endsection
