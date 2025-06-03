@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="container">
        <h2 class="text-center mb-4">{{ $post->title }}</h2>
        <hr>
        <div class="row">
            <div class="col-md-3 text-center">
                <div>
                    <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : 'https://via.placeholder.com/100x100?text=No+Image' }}"
                        class="mb-2" alt="Avatar">
                </div>
                <div>{{ $post->user->username }}</div>
                <div class="text-muted" style="font-size: 0.9rem;">Ngày tạo:
                    {{ $post->created_at->format('d/m/Y') }}
                </div>
                <div class="text-muted" style="font-size: 0.9rem;">Ngày cập nhật:
                    {{ $post->updated_at->format('d/m/Y') }}
                </div>
            </div>
            <div class="col-md-9">
                {!! $post->content !!}
            </div>
        </div>

        <hr>


        <div class="mt-4">
            <h5>Viết bình luận</h5>

            <form method="POST" action="{{ route('comments.store') }}">
                @csrf
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <div class="form-group">
                    <textarea name="content" rows="3" class="form-control" placeholder="Nhập bình luận..." required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Gửi</button>
            </form>
        </div>

        <div class="mt-5">
            <h5>Bình luận ({{ $post->comments->count() }})</h5>
            @forelse ($post->comments as $comment)
                <div class="border rounded p-3 mb-3">
                    <strong>{{ $comment->user->username }}</strong>
                    <span class="text-muted" style="font-size: 0.85rem;">
                        - {{ $comment->created_at->format('Y-m-d') }}
                    </span>
                    <p class="mb-0 mt-2">{{ $comment->content }}</p>
                </div>
            @empty
                <p>Chưa có bình luận nào.</p>
            @endforelse
        </div>
    </div>
@endsection
