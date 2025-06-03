@extends('layouts.app')

@section('title', 'Thông tin cá nhân')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-center">Thông tin cá nhân</h2>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Thông tin người dùng</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Tên hiển thị:</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Tên đăng nhập:</label>
                        <input type="text" class="form-control" value="{{ $user->username }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" class="form-control" value="{{ $user->email }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Vai trò:</label>
                        <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Giới tính:</label>
                        <select class="form-select" name="gender">
                            <option value="">Chọn giới tính</option>
                            <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Nam</option>
                            <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Nữ</option>
                            <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Khác</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ngày sinh:</label>
                        <input type="date" class="form-control" name="birthdate"
                            value="{{ optional($user->birthdate)->format('Y-m-d') }}">
                        @error('birthdate')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Địa chỉ:</label>
                        <input type="text" class="form-control" name="address" value="{{ $user->address }}">
                        @error('address')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Slogan:</label>
                        <input type="text" class="form-control" name="slogan" value="{{ $user->slogan }}">
                        @error('address')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>


                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Cập nhật
                        </button>
                        <a href="{{ route('home') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Quay lại danh sách
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
