<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f5f5f5;
        }

        .container {
            max-width: 1000px;
            margin: auto;
        }

        h1 {
            margin-bottom: 20px;
        }

        .success {
            background: #d1fae5;
            color: #065f46;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 6px;
        }

        .btn {
            display: inline-block;
            padding: 8px 14px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #eee;
        }

        .tag {
            display: inline-block;
            padding: 4px 8px;
            background: #e5e7eb;
            border-radius: 4px;
            margin: 2px;
            font-size: 12px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>Daftar Produk</h1>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('products.create') }}" class="btn">
        + Tambah Produk
    </a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Kategori</th>
                <th>User</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Tag</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($products as $product)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        {{ $product->name }}
                    </td>

                    <td>
                        {{ $product->category->name ?? '-' }}
                    </td>

                    <td>
                        {{ $product->user->name ?? '-' }}
                    </td>

                    <td>
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </td>

                    <td>
                        {{ $product->stock }}
                    </td>

                    <td>
                        @forelse($product->tags as $tag)
                            <span class="tag">
                                {{ $tag->name }}
                            </span>
                        @empty
                            -
                        @endforelse
                    </td>

                    <td>
                        <a href="{{ route('products.show', $product) }}">
                            Detail
                        </a>

                        |

                        <a href="{{ route('products.edit', $product) }}">
                            Edit
                        </a>

                        |

                        <form
                            action="{{ route('products.destroy', $product) }}"
                            method="POST"
                            style="display:inline"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Hapus produk ini?')"
                            >
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="8">
                        Belum ada produk.
                    </td>
                </tr>

            @endforelse
        </tbody>
    </table>

</div>

</body>
</html>