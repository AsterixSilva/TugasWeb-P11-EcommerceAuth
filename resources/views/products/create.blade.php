<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
</head>
<body>

    <h1>Tambah Produk</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div>
            <label>Nama Produk</label>
            <input type="text" name="name" required>
        </div>

        <br>

        <div>
            <label>Kategori</label>
            <select name="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>


        <div>
            <label>Slug</label>
            <input type="text" name="slug" required>
        </div>

        <br>

        <div>
            <label>Deskripsi</label>
            <textarea name="description"></textarea>
        </div>

        <br>

        <div>
            <label>Harga</label>
            <input type="number" name="price" required>
        </div>

        <br>

        <div>
            <label>Stok</label>
            <input type="number" name="stock" required>
        </div>

        <br>

        <button type="submit">Simpan Produk</button>
        <a href="{{ route('products.index') }}">Batal</a>
    </form>

</body>
</html>