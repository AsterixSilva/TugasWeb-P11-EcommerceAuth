<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Kategori</title>
</head>
<body>

    <h1>Tambah Kategori</h1>

    @if ($errors->any())
        <div>
            <strong>Ada kesalahan:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div>
            <label>Nama Kategori</label><br>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Slug</label><br>
            <input
                type="text"
                name="slug"
                value="{{ old('slug') }}"
                required
            >
        </div>

        <br>

        <div>
            <label>Deskripsi</label><br>
            <textarea
                name="description"
                rows="4"
                cols="40"
            >{{ old('description') }}</textarea>
        </div>

        <br>

        <button type="submit">Simpan Kategori</button>

        <a href="{{ route('categories.index') }}">
            Batal
        </a>
    </form>

</body>
</html>