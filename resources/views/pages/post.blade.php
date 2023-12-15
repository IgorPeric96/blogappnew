@extends('layout.default')

@section('title')
    {{ $post->title }}
@endsection

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->body }}</p>

    <h2>Comments</h2>
    @foreach ($comments as $comment)
        @include('components.comment')
    @endforeach

    @include('components.createcomment')
    
@endsection
