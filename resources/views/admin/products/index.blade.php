@extends('admin.layouts.admin')

@section('title', 'Sản phẩm')

@section('content')

    <h2 class="mb-3">DANH SÁCH SẢN PHẨM</h2>

    <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">
        + Thêm mới
    </a>

    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>Mã SP</th>
                <th>Tên sản phẩm</th>
                <th>Slug</th>
                <th>Danh mục</th>
                <th>Thương hiệu</th>
                <th>Giá</th>
                <th>Giá giảm</th>
                <th>Mô tả</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            @foreach($list as $item)
                <tr>

                    <td>{{ $item->id }}</td>

                    <td>{{ $item->productname }}</td>

                    <td>{{ $item->slug }}</td>

                    <td>{{ $item->catename }}</td>

                    <td>{{ $item->brandname }}</td>

                    <td>{{ number_format($item->price) }}</td>

                    <td>{{ number_format($item->pricediscount) }}</td>

                    <td>{{ $item->description }}</td>

                    <td>
                        @if(!empty($item->image))
                            <img src="{{ asset('images/products/' . $item->image) }}" width="80">
                        @else
                            <img src="{{ asset('images/default.png') }}" width="80">
                        @endif
                    </td>

                    <td>

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

@endsection