@extends('layouts.app')

@section('title', 'Chi tiết & Chỉnh sửa bài viết của tôi')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-center">Chỉnh sửa bài viết</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Oops!</strong> Có lỗi xảy ra trong quá trình cập nhật. Vui lòng kiểm tra lại.
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">{{ $post->title }}</h5>
            </div>
            <div class="card-body">
                {{-- Form để chỉnh sửa bài viết --}}

                {{-- route('posts.update',  --}}
                <form action="{{ $post->id }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- Sử dụng phương thức PUT cho việc cập nhật --}}

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label"><strong>Ảnh đại diện:</strong></label>
                        @if ($post->thumbnail)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Thumbnail hiện tại"
                                    class="img-fluid rounded" style="max-width: 150px; height: auto;">
                                <small class="text-muted">Ảnh hiện tại</small>
                            </div>
                        @else
                            <div class="mb-2">
                                <img src="https://placehold.co/150x100/E0E0E0/333333?text=No+Image" alt="No Thumbnail"
                                    class="img-fluid rounded" style="max-width: 150px; height: auto;">
                                <small class="text-muted">Chưa có ảnh đại diện</small>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail"
                            name="thumbnail">
                        @error('thumbnail')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                        <small class="form-text text-muted">Chọn ảnh mới nếu muốn thay đổi ảnh đại diện. (Tối đa 2MB, định
                            dạng: jpeg, png, jpg, gif, svg)</small>
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label"><strong>Têu đề:</strong></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ old('title', $post->title) }}" required>
                        @error('title')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label"><strong>Nội dung:</strong></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10"
                            required>{{ old('content', $post->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    {{-- Các trường thông tin chỉ đọc (không cho phép sửa) --}}
                    <div class="mb-3">
                        <label class="form-label"><strong>Ngày tạo:</strong></label>
                        <p class="form-control-static">{{ $post->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><strong>Cập nhật lần cuối:</strong></label>
                        <p class="form-control-static">{{ $post->updated_at->format('d/m/Y H:i') }}</p>
                    </div>

                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="{{ route('profile.my-posts') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Cập nhật
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
