@extends('layouts.app')

@section('title', 'Danh sách người dùng đã xóa')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-center">Danh sách người dùng đã xóa</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-3 text-end">
            <a href="{{ route('users.listUser') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Quay lại danh sách
            </a>
        </div>

        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Ngày xóa</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->deleted_at->format('d/m/Y') }}</td>
                        <td>
                            <form action="{{ route('users.restoreUser', $user->id) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Bạn có muốn khôi phục người dùng này không?');">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">
                                    <i class="bi bi-arrow-clockwise"></i> Khôi phục
                                </button>
                            </form>
                            <form action="{{ route('users.forceDeleteUser', $user->id) }}" method="POST" style="display:inline;"
                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa vĩnh viễn người dùng này? Thao tác này không thể hoàn tác!');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-x-circle"></i> Xóa vĩnh viễn
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Không có người dùng đã bị xóa.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
@endsection
