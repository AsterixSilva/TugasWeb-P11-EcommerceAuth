<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Kategori</title>
</head>
<body>

    <h1>Detail Kategori</h1>

    <p>
        <strong>Nama:</strong>
        {{ $category->name }}
    </p>

    <p>
        <strong>Slug:</strong>
        {{ $category->slug }}
    </p>

    <p>
        <strong>Deskripsi:</strong>
        {{ $category->description ?? '-' }}
    </p>

    <h2>Produk dalam Kategori</h2>

    @forelse($category->products as $product)
        <p>
            {{ $product->name }}
            - Rp {{ number_format($product->price, 0, ',', '.') }}
        </p>
    @empty
        <p>Belum ada produk dalam kategori ini.</p>
    @endforelse

    <br>

    <a href="{{ route('categories.index') }}">Kembali</a>
    |
    <a href="{{ route('categories.edit', $category) }}">Edit</a>

</body>
</html>