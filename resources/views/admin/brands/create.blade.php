<div class="h-screen flex items-center justify-center">
    <form action="{{ route('admin.brands.store') }}" method="POST" class="w-80 space-y-3">
        @csrf

        <input type="text" name="brandname" placeholder="Tên thương hiệu" class="w-full border px-3 py-2 rounded">

        <input type="text" name="slug" placeholder="Slug" class="w-full border px-3 py-2 rounded">

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">
            Lưu
        </button>
    </form>
</div>