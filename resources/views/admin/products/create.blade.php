<div class="h-screen flex items-center justify-center">
    <form action="{{ route('admin.products.store') }}" method="POST" class="w-96 space-y-3">

        @csrf

        <input type="text" name="productname" placeholder="Tên sản phẩm" class="w-full border px-3 py-2 rounded">

        <input type="text" name="slug" placeholder="Slug" class="w-full border px-3 py-2 rounded">

        <input type="number" name="price" placeholder="Giá bán" class="w-full border px-3 py-2 rounded">

        <input type="number" name="pricediscount" placeholder="Giá khuyến mãi" class="w-full border px-3 py-2 rounded">

        <textarea name="description" placeholder="Mô tả sản phẩm" class="w-full border px-3 py-2 rounded"
            rows="4"></textarea>

        <!-- Danh mục -->
        <select name="cateid" class="w-full border px-3 py-2 rounded">
            @foreach($categories as $item)
                <option value="{{ $item->cateid }}">
                    {{ $item->catename }}
                </option>
            @endforeach
        </select>

        <!-- Thương hiệu -->
        <select name="brandid" class="w-full border px-3 py-2 rounded">
            @foreach($brands as $item)
                <option value="{{ $item->brandid }}">
                    {{ $item->brandname }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">
            Lưu
        </button>

    </form>
</div>