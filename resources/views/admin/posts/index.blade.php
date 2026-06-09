@extends('admin.layouts.admin')

@section('title', 'Bài viết')

@section('content')

    <h2 class="mb-3">DANH SÁCH BÀI VIẾT</h2>

    <a href="{{ route('admin.posts.create') }}" class="btn btn-success mb-3">
        + Thêm mới
    </a>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tiêu đề</th>
                <th>Slug</th>
                <th>Nội dung</th>
                <th>Trạng thái</th>
                <th>Tác giả</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            @foreach($list as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>

                    <td>
                        @if(!empty($item->image))
                            <img src="{{ asset('images/products/' . $item->image) }}" width="80">
                        @else
                            <img src="{{ asset('images/default.png') }}" width="80">
                        @endif
                    </td>

                    <td>{{ $item->title }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>{{ $item->content }}</td>

                    <td>
                        @if($item->status == 1)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-secondary">Ẩn</span>
                        @endif
                    </td>

                    <td>{{ $item->userid }}</td>

                    <td>
                        <form action="{{ route('admin.posts.destroy', $item->id) }}" method="POST">

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