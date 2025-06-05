@extends('layouts.app')

@section('title', 'Thêm bài viết mới')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-center">Thêm bài viết mới</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Thêm bài viết mới</h5>
            </div>

            <div action="{{ route('profile.store') }}" class="card-body">
                <form method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="thumbnail" class="form-label"><strong>Ảnh đại diện:</strong></label>
                        <input type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="thumbnail"
                            name="thumbnail">
                        @error('thumbnail')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label"><strong>Tiêu đề:</strong></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ old('title') }}" required placeholder="Nhập tiêu đề bài viết...">
                        @error('title')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label"><strong>Nội dung:</strong></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10"
                            required placeholder="Nhập nội dung bài viết..."></textarea>
                        @error('content')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="{{ route('profile.my-posts') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Quay lại
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> Thêm bài viết mới
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
