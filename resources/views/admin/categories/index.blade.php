@extends('admin.layouts.admin')

@section('title', 'Loại sản phẩm')

@section('content')

    <h2 class="mb-3">DANH SÁCH LOẠI SẢN PHẨM</h2>

    <a href="{{ route('admin.categories.create') }}" class="btn btn-success mb-3">
        + Thêm mới
    </a>

    <x-admin.alert />

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên loại</th>
                <th>Slug</th>
                <th>Mô tả</th>
                <th>Trạng thái</th>
                <th width="180">Hành động</th>
            </tr>
        </thead>

        <tbody>
            @foreach($list as $item)
                <tr>
                    <td>{{ $list->firstItem() + $loop->index }}</td>

                    <td>
                        <img src="{{ asset('images/default.png') }}" alt="{{ $item->catename }}" class="img-thumbnail"
                            style="max-width:100px;">
                    </td>

                    <td>{{ $item->catename }}</td>

                    <td>{{ $item->slug }}</td>

                    <td>{{ $item->description }}</td>

                    <td>
                        @if($item->status == 1)
                            <span class="badge bg-success">
                                Hiển thị
                            </span>
                        @else
                            <span class="badge bg-danger">
                                Ẩn
                            </span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.categories.edit', $item->cateid) }}" class="btn btn-warning btn-sm">
                            Sửa
                        </a>

                        <form action="{{ route('admin.categories.destroy', $item->cateid) }}" method="POST" class="d-inline">

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