@extends('layouts.app')

@section('title', 'Pages')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4">Pages</h1>
        <hr>

        @foreach ($pages as $page)
            <div class="p-3 mb-3 border rounded d-flex align-items-start">
                <img src="{{ $page->thumbnail ? asset('storage/' . $page->thumbnail) : 'https://via.placeholder.com/100x100?text=No+Image' }}"
                    alt="{{ $page->title }}" class="mr-3 rounded"
                    style="width: 120px; height: 120px; object-fit: cover; flex-shrink: 0; margin-right: 50px;">

                <div>
                    <h5 class="mb-1 font-weight-bold">{{ $page->title }}</h5>
                    <p class="mb-0">{!! Str::limit(strip_tags($page->content), 150, '...') !!}</p>
                    <a href="{{ route('pages.show', $page->id) }}" class="btn btn-primary btn-sm">Read More</a>
                </div>
            </div>
        @endforeach
        <div class="d-flex justify-content-center">
            {{ $pages->links() }}
        </div>
    </div>
@endsection
