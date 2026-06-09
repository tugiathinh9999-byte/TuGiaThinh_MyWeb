@extends('admin.layouts.admin')

@section('title', 'Người Dùng')

@section('content')

    <h2 class="mb-3">DANH SÁCH NGƯỜI DÙNG</h2>

    <a href="{{ route('admin.users.create') }}" class="btn btn-success mb-3">
        + Thêm mới
    </a>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên người dùng</th>
                <th>Slug</th>
                <th>Mô tả</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            @foreach($list as $item)
                <tr>
                    <td>{{ $item->userid }}</td>

                    <td>
                        <img src="{{ asset('images/default.png') }}" alt="{{ $item->username }}" class="img-thumbnail"
                            style="max-width: 100px;">
                    </td>

                    <td>{{ $item->username }}</td>

                    <td>{{ $item->slug }}</td>

                    <td>{{ $item->description }}</td>

                    <td>
                        @if($item->status == 1)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-danger">Ẩn</span>
                        @endif
                    </td>

                    <td>
                        <form action="{{ route('admin.users.destroy', $item->userid) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger">
                                Xóa
                            </button>
                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>

    </table>

@endsection