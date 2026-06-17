@extends('admin.layouts.admin')
@section('title', 'Sửa người dùng')

@section('content')

<div class="h-screen flex items-center justify-center p-4">
    <div class="w-100">

        <h3 class="text-xl font-bold mb-4">
            Sửa người dùng
        </h3>

        @if(session('error'))
            <div class="alert alert-danger mb-3">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user->userid) }}"
              method="POST"
              class="w-96 space-y-3 max-h-screen overflow-y-auto">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6">

                    <div class="mb-3">
                        <label class="form-label">
                            Tên người dùng
                        </label>
                        <input type="text"
                               name="username"
                               class="form-control"
                               value="{{ old('username', $user->username) }}"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Slug
                        </label>
                        <input type="text"
                               name="slug"
                               class="form-control"
                               value="{{ old('slug', $user->slug) }}">
                    </div>

                </div>

                <div class="mb-3">
                        <label class="form-label d-block">Trạng thái</label>

                        <input type="radio"
                               class="btn-check"
                               name="status"
                               id="active"
                               value="1"
                               {{ old('status', $user->status) == 1 ? 'checked' : '' }}>
                        <label class="btn btn-outline-success" for="active">
                            Hiển thị
                        </label>

                        <input type="radio"
                               class="btn-check"
                               name="status"
                               id="inactive"
                               value="0"
                               {{ old('status', $user->status) == 0 ? 'checked' : '' }}>
                        <label class="btn btn-outline-danger" for="inactive">
                            Ẩn
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Mô tả
                        </label>

                        <textarea name="description"
                                  rows="4"
                                  class="form-control">{{ old('description', $user->description) }}</textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                Cập nhật người dùng
            </button>

            <a href="{{ route('admin.users.index') }}"
               class="btn btn-secondary">
                Quay lại
            </a>

        </form>

    </div>
</div>

@endsection
