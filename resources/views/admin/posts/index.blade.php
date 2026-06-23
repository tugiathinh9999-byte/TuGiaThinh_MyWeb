@extends('admin.layouts.admin')

@section('title', 'Bài viết')

@section('content')

    <h2 class="mb-3">DANH SÁCH BÀI VIẾT</h2>

    <a href="{{ route('admin.posts.create') }}" class="btn btn-success mb-3">
        + Thêm mới
    </a>

    <x-admin.alert />

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>Mã BV</th>
                <th>Ảnh</th>
                <th>Tiêu đề</th>
                <th>Slug</th>
                <th>Nội dung</th>
                <th>Người đăng</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            @foreach($list as $item)
                <tr>

                    <td>{{ $list->firstItem() + $loop->index }}</td>

                    <td>
                        @if(!empty($item->image))
                            <img src="{{ asset('images/posts/' . $item->image) }}" width="80">
                        @else
                            <img src="{{ asset('images/default.png') }}" width="80">
                        @endif
                    </td>

                    <td>{{ $item->title }}</td>

                    <td>{{ $item->slug }}</td>

                    <td>{{ $item->content }}</td>

                    <td>{{ $item->user?->username }}</td>

                    <td>
                        @if($item->status == 1)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-secondary">Ẩn</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.posts.edit', $item->id) }}" class="btn btn-warning btn-sm">
                            Sửa
                        </a>

                        <form action="{{ route('admin.posts.destroy', $item->id) }}" method="POST" style="display:inline-block">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn có chắc muốn xóa?')">
                                Xóa
                            </button>

                        </form>
                    </td>

                </tr>
            @endforeach
        </tbody>

    </table>

    <div class="d-flex justify-content-center">
        {{ $list->links() }}
    </div>

@endsection