@extends('admin.layouts.admin')
@section('title', 'Thêm thương hiệu')

@section('content')
<div class="h-screen flex items-center justify-center p-4">
    <div class="w-100">
        <h3 class="text-xl font-bold mb-4">Thêm thương hiệu mới</h3>

        @if(session('error'))
            <div class="alert alert-danger mb-3">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.brands.store') }}" method="POST"
              class="w-96 space-y-3 max-h-screen overflow-y-auto">

            @csrf

            <div class="row">
                <div class="col-md-12">

                    <div class="mb-3">
                        <label class="form-label">Tên thương hiệu</label>
                        <input type="text"
                               name="brandname"
                               class="form-control"
                               value="{{ old('brandname') }}"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Slug</label>
                        <input type="text"
                               name="slug"
                               class="form-control"
                               value="{{ old('slug') }}"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label d-block">Trạng thái</label>

                        <input type="radio"
                               class="btn-check"
                               name="status"
                               id="active"
                               value="1"
                               {{ old('status', 1) == 1 ? 'checked' : '' }}>
                        <label class="btn btn-outline-success" for="active">
                            Hiển thị
                        </label>

                        <input type="radio"
                               class="btn-check"
                               name="status"
                               id="inactive"
                               value="0"
                               {{ old('status') == 0 ? 'checked' : '' }}>
                        <label class="btn btn-outline-danger" for="inactive">
                            Ẩn
                        </label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mô tả thương hiệu</label>
                        <textarea name="description"
                                  rows="4"
                                  class="form-control">{{ old('description') }}</textarea>
                    </div>

                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                Lưu thương hiệu
            </button>

            <a href="{{ route('admin.brands.index') }}"
               class="btn btn-secondary">
                Quay lại
            </a>

        </form>
    </div>
</div>
@endsection