@extends('admin.layouts.admin')
@section('title', 'Thêm loại')

@section('content')
    <div class="h-screen flex items-center justify-center p-4">
        <div class="w-100">
            <h3 class="text-xl font-bold mb-4">Thêm loại mới</h3>

            <x-admin.alert />

            <form action="{{ route('admin.categories.store') }}" method="POST"
                class="w-96 space-y-3 max-h-screen overflow-y-auto">

                @csrf

                <div class="row">
                    <div class="col-md-12">

                        <div class="mb-3">
                            <label class="form-label">Tên loại</label>
                            <input type="text" name="catename" class="form-control" value="{{ old('catename') }}"
                                required>
                            {{-- hiển thị lỗi cho trường catename --}}
                            @error('catename')
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
                            <label class="form-label">Mô tả loại</label>
                            <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    Lưu loại
                </button>

                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                    Quay lại
                </a>

            </form>
        </div>
    </div>
@endsection
