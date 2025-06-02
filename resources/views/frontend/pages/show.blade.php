@extends('layouts.app')

@section('title', 'Pages')

@section('content')
    <div class="container">
        <h2 class="text-center mb-4">{{ $page->title }}</h2>
        <hr>
        <div class="row">
            <div class="col-md-3 text-center">
                <div>
                    <img src="{{ $page->thumbnail ? asset('storage/' . $page->thumbnail) : 'https://via.placeholder.com/100x100?text=No+Image' }}"
                        class="mb-2" alt="Avatar">
                </div>
                {{-- <div>Administrator</div> --}}
                <div class="text-muted" style="font-size: 0.9rem;">Ngày tạo:
                    {{ $page->created_at->format('d/m/Y') }}
                </div>
                <div class="text-muted" style="font-size: 0.9rem;">Ngày cập nhật:
                    {{ $page->updated_at->format('d/m/Y') }}
                </div>
            </div>
            <div class="col-md-9">
                {!! $page->content !!}
            </div>
        </div>
    </div>
@endsection
