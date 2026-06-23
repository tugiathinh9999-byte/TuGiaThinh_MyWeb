@extends('admin.layouts.admin')
@section('title', 'Thêm sản phẩm')
@section('content')
    <div class="h-screen flex items-center justify-center p-4">
        <h3 class="text-xl font-bold mb-4">Thêm sản phẩm mới</h3>
        
        <x-admin.alert />
        <form action="{{ route('admin.products.store') }}" method="POST" class="w-96 space-y-3 max-h-screen overflow-y-auto">

            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Tên sản phẩm</label>
                        <input type="text" name="productname" class="form-control" value="{{ old('productname') }}"
                            required>
                            @error('productname')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug') }}" required>
                        @error('slug')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Loại sản phẩm</label>
                        <select name="cateid" class="form-select" required>
                            <option value="">-- Chọn loại sản phẩm --</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->cateid }}"
                                    {{ old('cateid') == $category->cateid ? 'selected' : '' }}>
                                    {{ $category->catename }}
                                </option>
                            @endforeach
                        </select>
                        @error('cateid')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Thương hiệu</label>
                        <select name="brandid" class="form-select" required>
                            <option value="">-- Chọn thương hiệu --</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->brandid }}"
                                    {{ old('brandid') == $brand->brandid ? 'selected' : '' }}>
                                    {{ $brand->brandname }}
                                </option>
                            @endforeach
                        </select>
                        @error('brandid')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Giá</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                        @error('price')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Giá khuyến mãi</label>
                        <input type="number" name="pricediscount" class="form-control" value="{{ old('pricediscount') }}">
                        @error('pricediscount')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label d-block">Trạng thái</label>
                        <input type="radio" class="btn-check" name="status" id="active" value="1"
                            {{ old('status') == '1' ? 'checked' : '' }}>
                        <label class="btn btn-outline-success" for="active">
                            Hiển thị
                        </label>
                        <input type="radio" class="btn-check" name="status" id="inactive" value="0"
                            {{ old('status') == '0' ? 'checked' : '' }}>
                        <label class="btn btn-outline-danger" for="inactive">
                            Ẩn
                        </label>
                        @error('status')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mô tả sản phẩm</label>
                        <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                        @error('description')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                Lưu sản phẩm
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
                Quay lại
            </a>
        </form>
    </div>
@endsection
