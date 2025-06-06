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
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>


                    {{-- Input cho Tên đăng nhập (Username) --}}
                    <div class="mb-3">
                        <label class="form-label">Tên đăng nhập:</label>
                        @if (Auth::user()->hasRole('admin'))
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                name="username" value="{{ old('username', $user->username) }}" required>
                        @else
                            <input type="text" class="form-control" value="{{ $user->username }}" readonly>
                            <input type="hidden" name="username" value="{{ $user->username }}">
                        @endif
                    </div>

                    {{-- Input cho Email --}}
                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        @if (Auth::user()->hasRole('admin'))
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email', $user->email) }}" required>
                        @else
                            <input type="email" class="form-control" value="{{ $user->email }}" readonly>

                            <input type="hidden" name="email" value="{{ $user->email }}">
                        @endif
                    </div>

                    {{-- Phần hiển thị thông tin vai trò (chỉ đọc cho tất cả) --}}
                    <div class="mb-3">
                        <label class="form-label">Vai trò:</label>
                        {{-- pluck(): để lấy ra tất cả các giá trị của một cột (hoặc một key) cụ thể từ một tập hợp các đối tượng (collection) --}}
                        {{-- implode(): sử dụng ', ' (dấu phẩy và một khoảng trắng) làm chuỗi phân cách.
                        VD: Kết quả sẽ là một chuỗi duy nhất: "Quản trị viên, Biên tập viên"
                        --}}
                        <input type="text" class="form-control"
                            value="{{ Auth::user()->roles->pluck('display_name')->implode(', ') ?: 'Không có vai trò' }}"
                            readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giới tính:</label>
                        <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                            <option value="">Chọn giới tính</option>
                            <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Nam
                            </option>
                            <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Nữ
                            </option>
                            <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Khác
                            </option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ngày sinh:</label>
                        <input type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate"
                            value="{{ old('birthdate', optional($user->birthdate)->format('Y-m-d')) }}">
                        @error('birthdate')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Địa chỉ:</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                            value="{{ old('address', $user->address) }}">
                        @error('address')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Slogan:</label>
                        <input type="text" class="form-control @error('slogan') is-invalid @enderror" name="slogan"
                            value="{{ old('slogan', $user->slogan) }}">
                        @error('slogan')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>


                    <div class="d-flex justify-content-center gap-3">
                        <a href="{{ route('home') }}" class="btn btn-secondary">
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
