<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Kategori</title>
</head>
<body>

    <h1>Daftar Kategori</h1>

    @if(session('success'))
        <div style="background: #d1fae5; padding: 10px; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('categories.create') }}">
        + Tambah Kategori
    </a>

    <br><br>

    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Slug</th>
                <th>Deskripsi</th>
                <th>Jumlah Produk</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->description ?? '-' }}</td>
                    <td>{{ $category->products_count }}</td>

                    <td>
                        <a href="{{ route('categories.show', $category) }}">
                            Detail
                        </a>

                        |

                        <a href="{{ route('categories.edit', $category) }}">
                            Edit
                        </a>

                        |

                        <form
                            action="{{ route('categories.destroy', $category) }}"
                            method="POST"
                            style="display:inline"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Hapus kategori ini?')"
                            >
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        Belum ada kategori.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>