<!DOCTYPE html>
<html>
<head>
    <title>Detail Produk</title>
</head>
<body>

    <h1>Detail Produk</h1>

    <p>
        <strong>Nama:</strong>
        {{ $product->name }}
    </p>

    <p>
        <strong>Kategori:</strong>
        {{ $product->category->name }}
    </p>

    <p>
        <strong>User:</strong>
        {{ $product->user->name }}
    </p>

    <p>
        <strong>Slug:</strong>
        {{ $product->slug }}
    </p>

    <p>
        <strong>Deskripsi:</strong>
        {{ $product->description }}
    </p>

    <p>
        <strong>Harga:</strong>
        Rp {{ number_format($product->price, 0, ',', '.') }}
    </p>

    <p>
        <strong>Stok:</strong>
        {{ $product->stock }}
    </p>

    <p>
        <strong>Tag:</strong>
        @forelse ($product->tags as $tag)
            {{ $tag->name }}
        @empty
            -
        @endforelse
    </p>

    <a href="{{ route('products.index') }}">Kembali</a>
    |
    <a href="{{ route('products.edit', $product) }}">Edit</a>

</body>
</html>