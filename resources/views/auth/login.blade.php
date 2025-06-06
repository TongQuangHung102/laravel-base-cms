@extends('layouts.app')

@section('title', 'Đăng nhập')

@section('content')
    <div class="container mt-5">
        <h3 class="text-center mb-4">Đăng nhập</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="w-50 mx-auto">
            @csrf

            <div class="form-group">
                <label for="login">Email hoặc Username</label>
                <input type="text" class="form-control" id="login" name="login" value="{{ old('login') }}"
                    required>
            </div>

            <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mt-2">Đăng nhập</button>
            </div>
        </form>
    </div>
@endsection
