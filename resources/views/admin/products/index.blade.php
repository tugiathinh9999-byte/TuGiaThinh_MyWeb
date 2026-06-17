@extends('admin.layouts.admin')

@section('title', 'Sản phẩm')

@section('content')

    <h2 class="mb-3">DANH SÁCH SẢN PHẨM</h2>

    <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">
        + Thêm mới
    </a>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>Mã SP</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Slug</th>
                <th>Danh mục</th>
                <th>Thương hiệu</th>
                <th>Giá</th>
                <th>Giá giảm</th>
                <th>Mô tả</th>
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
                            <img src="{{ asset('images/products/' . $item->image) }}" width="80">
                        @else
                            <img src="{{ asset('images/default.png') }}" width="80">
                        @endif
                    </td>

                    <td>{{ $item->productname }}</td>

                    <td>{{ $item->slug }}</td>

                    <td>{{ $item->category?->catename }}</td>

                    <td>{{ $item->brand?->brandname }}</td>

                    <td>{{ number_format($item->price) }}</td>

                    <td>{{ number_format($item->pricediscount) }}</td>

                    <td>{{ $item->description }}</td>

                    <td>
                        @if($item->status == 1)
                            <span class="badge bg-success">Hiển thị</span>
                        @else
                            <span class="badge bg-secondary">Ẩn</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.products.edit', $item->id) }}" class="btn btn-warning btn-sm">
                            Sửa
                        </a>

                        <form action="{{ route('admin.products.destroy', $item->id) }}" method="POST">

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
    <div class="d-flex justify-content-center">
        {{ $list->links() }}
    </div>

@endsection