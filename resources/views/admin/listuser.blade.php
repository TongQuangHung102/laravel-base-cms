@extends('layouts.app')

@section('title', 'Danh sách người dùng')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-center">Danh sách người dùng</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="mb-3 text-end">
            <a href="{{ route('users.trashUser') }}" class="btn btn-primary">
                <i class="bi bi-trash3-fill"></i>Danh sách người dùng đã xóa
            </a>
        </div>
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Ngày tạo</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('users.detailUser', $user->id) }}" class="btn btn-sm btn-success text-white">Chỉnh
                                sửa</a>
                            <form action="{{ route('users.deleteSoftUser', $user->id) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa người dùng này?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Không có người dùng nào.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
@endsection
