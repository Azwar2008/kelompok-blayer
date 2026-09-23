<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark px-3">
        <span class="navbar-brand">Sistem Perpustakaan</span>
        <div>
            <a href="{{ route('buku.index') }}" class="text-white me-3">Buku</a>
            <a href="{{ route('anggota.index') }}" class="text-white me-3">Anggota</a>
            <a href="{{ route('peminjaman.index') }}" class="text-white">Peminjaman</a>
        </div>
    </nav>

    <div class="container mt-4">
        @if (session('sukses'))
            <div class="alert alert-success">
                {{ session('sukses') }}
            </div>
        @endif

        @if (session('gagal'))
            <div class="alert alert-danger">
                {{ session('gagal') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
