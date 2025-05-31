{{-- Kế thừa layouts.app --}}
@extends('layouts.app')
{{-- 'title': định nghĩa nội dung có tên là title trong bố cục cha(layouts.app) => Hiển thị ở trên tab của website --}}
@section('title', 'Đăng ký tài khoản')
{{-- 'content': định nghĩa nội dung có tên là content trong bố cục cha(layouts.app) --}}
@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card-header">{{ __('Đăng ký tài khoản') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            {{-- Input cho Tên (Name) --}}
                            <div class="mb-3 row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Tên') }}</label>
                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Input cho Tên đăng nhập (Username) --}}
                            <div class="mb-3 row">
                                <label for="username"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Tên đăng nhập') }}</label>
                                <div class="col-md-6">
                                    <input id="username" type="text"
                                        class="form-control @error('username') is-invalid @enderror" name="username"
                                        value="{{ old('username') }}" required autocomplete="username">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Input cho Email --}}
                            <div class="mb-3 row">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Input cho Mật khẩu (Password) --}}
                            <div class="mb-3 row">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Mật khẩu') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- Input cho Xác nhận mật khẩu (Confirm Password) --}}
                            <div class="mb-3 row">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Xác nhận mật khẩu') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            {{-- Nút Đăng ký --}}
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-3 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Đăng ký') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
