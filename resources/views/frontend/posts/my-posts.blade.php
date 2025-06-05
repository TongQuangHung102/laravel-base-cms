@extends('layouts.app')

@section('title', 'Bài viết của tôi')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-center">Bài viết của tôi</h2>


        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        {{-- href="{{ route('pages.show') }}" --}}
        <div class="mb-3 text-end">
            <a class="btn btn-primary">
                <i class="bi bi-plus-circle-fill"></i> Tạo bài viết mới
            </a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Ảnh đại diện</th>
                    <th>Tiêu đề</th>
                    <th>Nội dung</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($myPosts as $post)
                    <tr>
                        <td>{{ $post->id }}</td>
                        <td>
                            @if ($post->thumbnail)
                                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail"
                                    class="img-fluid rounded" style="width: 70px; height: 70px; object-fit: cover;">
                            @else
                                <img src="https://placehold.co/70x70/E0E0E0/333333?text=No+Image" alt="No Thumbnail"
                                    class="img-fluid rounded" style="width: 70px; height: 70px; object-fit: cover;">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none">
                                {{ $post->title }}
                            </a>
                        </td>
                        <td>{!! $post->content !!}</td>
                        {{-- <td>{{ Str::limit($post->content, 100) }}</td> --}}
                        <td>{{ $post->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('pages.show', $post->id) }}" class="btn btn-sm btn-success text-white">Chỉnh
                                sửa</a>
                            <form action="{{ route('pages.show', $post->id) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i>
                                    Xóa</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Bạn chưa có bài viết nào. Hãy tạo một bài viết mới!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $myPosts->links() }}
        </div>


    </div>
@endsection
