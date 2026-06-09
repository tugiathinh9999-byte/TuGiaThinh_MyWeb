<div class="h-screen flex items-center justify-center">
    <form action="{{ route('admin.posts.store') }}" method="POST" class="w-80 space-y-3">

        @csrf

        <input type="text" name="title" placeholder="Tiêu đề" class="w-full border px-3 py-2 rounded">

        <input type="text" name="slug" placeholder="Slug" class="w-full border px-3 py-2 rounded">

        <textarea name="content" placeholder="Nội dung" class="w-full border px-3 py-2 rounded" rows="5"></textarea>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">
            Lưu
        </button>

    </form>
</div>