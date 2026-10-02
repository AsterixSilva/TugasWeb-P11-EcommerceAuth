<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>

    <h1>Edit Produk</h1>

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label>Nama Produk</label>
            <input type="text" name="name" value="{{ $product->name }}">
        </div>

        <br>

        <div>
            <label>Kategori</label>
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label>Slug</label>
            <input type="text" name="slug" value="{{ $product->slug }}">
        </div>

        <br>

        <div>
            <label>Deskripsi</label>
            <textarea name="description">{{ $product->description }}</textarea>
        </div>

        <br>

        <div>
            <label>Harga</label>
            <input type="number" name="price" value="{{ $product->price }}">
        </div>

        <br>

        <div>
            <label>Stok</label>
            <input type="number" name="stock" value="{{ $product->stock }}">
        </div>

        <br>

        <button type="submit">Update Produk</button>
        <a href="{{ route('products.index') }}">Batal</a>
    </form>

</body>
</html>