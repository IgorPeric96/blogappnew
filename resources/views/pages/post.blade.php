@extends('layout.default')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>

    <!-- Blade syntax for checking if the user has liked the post -->
@if (Auth::check() && Auth::user()->likes->contains('post_id', $post->id))
    <form action="" method="post">
        @csrf
        @method('DELETE')
        <button type="submit">Unlike</button>
    </form>
@else
    <form action="" method="post">
        @csrf
        <button type="submit">Like</button>
    </form>
@endif



    @foreach ($post->tags as $tag)
    <a href="/tags/{{ $tag->name }}" class="badege rounded-pill text-bg-secondary">{{ $tag->name }}</a>
    @endforeach
    @if (auth()->id() === $post->user_id)
        <form action="{{ url('posts/' . $post->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <input class="form-control" type="text" name="title" placeholder="Edit title" required />
                <input class="form-control" type="text" name="body" placeholder="Edit body" required />
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>
        </form>
        <form action="{{ url('posts/' . $post->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Delete</button>
            </div>
        </form>
        {{-- <a href="/deletecomment/{{ $comment->id }}"><button class="btn btn-primary">Delete</button></a> --}}
    @endif
    <h2>Comments</h2>
    @foreach ($comments as $comment)
        @include('components.comment')
    @endforeach

    @include('components.createcomment')
    
@endsection
