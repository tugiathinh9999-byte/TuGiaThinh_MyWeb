@extends('admin.layouts.admin')

@section('title', 'Người dùng')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>DANH SÁCH NGƯỜI DÙNG</h2>

            <a href="{{ route('admin.users.create') }}" class="btn btn-success">
                + Thêm mới
            </a>
        </div>
        <x-admin.alert />

        <table class="table table-bordered table-hover table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th width="60">STT</th>
                    <th width="120">Hình ảnh</th>
                    <th>Tên người dùng</th>
                    <th>Slug</th>
                    <th>Mô tả</th>
                    <th width="120">Trạng thái</th>
                    <th width="180">Hành động</th>
                </tr>
            </thead>

            <tbody>

                @forelse($list as $item)
                    <tr>

                        <td>
                            {{ $list->firstItem() + $loop->index }}
                        </td>

                        <td>
                            <img src="{{ asset('images/default.png') }}" alt="{{ $item->username }}" class="img-thumbnail"
                                width="80">
                        </td>

                        <td>{{ $item->username }}</td>

                        <td>{{ $item->slug }}</td>

                        <td>{{ $item->description }}</td>

                        <td>
                            @if ($item->status == 1)
                                <span class="badge bg-success">Hiển thị</span>
                            @else
                                <span class="badge bg-danger">Ẩn</span>
                            @endif
                        </td>

                        <td>

                            <a href="{{ route('admin.users.edit', $item->userid) }}" class="btn btn-warning btn-sm">
                                Sửa
                            </a>

                            <form action="{{ route('admin.users.destroy', $item->userid) }}" method="POST"
                                class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có chắc muốn xóa?')">
                                    Xóa
                                </button>

                            </form>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="text-center">
                            Không có dữ liệu
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>

        <div class="d-flex justify-content-center">
            {{ $list->links() }}
        </div>
    </div>

@endsection
