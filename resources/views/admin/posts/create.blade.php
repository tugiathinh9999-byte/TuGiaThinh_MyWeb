@extends('admin.layouts.admin')
@section('title', 'Thêm bài viết')

@section('content')
    <div class="container py-4">
        <div class="card shadow">
            <div class="card-header">
                <h3 class="mb-0">Thêm bài viết mới</h3>
            </div>

            <div class="card-body">

                <x-admin.alert />

                <form action="{{ route('admin.posts.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                        @error('title')
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
                        <label class="btn btn-outline-success me-2" for="active">
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
                        <label class="form-label">Nội dung</label>
                        <textarea name="content" rows="8" class="form-control" required>{{ old('content') }}</textarea>
                        @error('content')
                                <span class="text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">
                            Lưu bài viết
                        </button>

                        <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                            Quay lại
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
