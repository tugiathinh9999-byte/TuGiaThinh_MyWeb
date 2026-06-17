@extends('admin.layouts.admin')
@section('title', 'Sửa bài viết')
@section('content')
    <div class="h-screen flex items-center justify-center p-4">
        <h3 class="text-xl font-bold mb-4">Sửa bài viết</h3>
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST"
            class="w-96 space-y-3 max-h-screen overflow-y-auto">

            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Tiêu đề</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $post->title) }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control" value="{{ old('slug', $post->slug) }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tác giả</label>
                        <select name="userid" class="form-select">
                            <option value="">-- Chọn tác giả --</option>
                            @foreach($users as $user)
                                <option value="{{ $user->userid }}" {{ old('userid', $post->userid) == $user->userid ? 'selected' : '' }}>
                                    {{ $user->username }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="mb-3">
                        <label class="form-label d-block">Trạng thái</label>
                        <input type="radio" class="btn-check" name="status" id="active" value="1" {{ old('status', $post->status) == 1 ? 'checked' : '' }}>
                        <label class="btn btn-outline-success" for="active">
                            Hiển thị
                        </label>
                        <input type="radio" class="btn-check" name="status" id="inactive" value="0" {{ old('status', $post->status) == 0 ? 'checked' : '' }}>
                        <label class="btn btn-outline-danger" for="inactive">
                            Ẩn
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nội dung</label>
                        <textarea name="content" rows="8" class="form-control"
                            required>{{ old('content', $post->content) }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                Cập nhật bài viết
            </button>
            <a href="{{ route('admin.posts.index') }}" class="btn btn-secondary">
                Quay lại
            </a>
        </form>
    </div>
@endsection