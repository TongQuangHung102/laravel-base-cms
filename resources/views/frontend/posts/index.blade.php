@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Posts</h1>
        <hr>

        @foreach ($posts as $post)
            <div class="p-3 mb-3 border rounded d-flex align-items-start">
                <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : 'https://via.placeholder.com/100x100?text=No+Image' }}"
                    alt="{{ $post->title }}" class="mr-3 rounded"
                    style="width: 120px; height: 120px; object-fit: cover; flex-shrink: 0; margin-right: 50px;">

                <div>
                    <h5 class="mb-1 font-weight-bold">{{ $post->title }}</h5>
                    <p class="mb-0">{!! Str::limit(strip_tags($post->content), 150, '...') !!}</p>
                    <a href="{{ route('detailpost', $post->id) }}" class="btn btn-primary btn-sm">Read More</a>
                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-center">
            {{ $posts->links() }}
        </div>
    </div>
@endsection
