<div class="h-screen flex items-center justify-center">

    <form action="{{ route('admin.users.store') }}" method="POST" class="w-80 space-y-3">

        @csrf

        <input type="text" name="username" placeholder="Tên người dùng" class="w-full border px-3 py-2 rounded">

        <input type="text" name="slug" placeholder="Slug" class="w-full border px-3 py-2 rounded">

        <input type="number" name="sort_order" placeholder="Thứ tự" class="w-full border px-3 py-2 rounded">

        <textarea name="description" placeholder="Mô tả" class="w-full border px-3 py-2 rounded" rows="4"></textarea>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">
            Lưu
        </button>

    </form>

</div>