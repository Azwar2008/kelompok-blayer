@extends('layouts.app')

@section('content')

<h4>Edit Buku</h4>

<form action="{{ route('buku.update', $buku) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-2">
        <label>Judul</label>
        <input
            type="text"
            name="judul"
            class="form-control"
            value="{{ old('judul', $buku->judul) }}"
        >

        @error('judul')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-2">
        <label>Penulis</label>
        <input
            type="text"
            name="penulis"
            class="form-control"
            value="{{ old('penulis', $buku->penulis) }}"
        >

        @error('penulis')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-2">
        <label>Penerbit</label>
        <input
            type="text"
            name="penerbit"
            class="form-control"
            value="{{ old('penerbit', $buku->penerbit) }}"
        >
    </div>

    <div class="mb-2">
        <label>Tahun Terbit</label>
        <input
            type="number"
            name="tahun_terbit"
            class="form-control"
            value="{{ old('tahun_terbit', $buku->tahun_terbit) }}"
        >

        @error('tahun_terbit')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-2">
        <label>ISBN</label>
        <input
            type="text"
            name="isbn"
            class="form-control"
            value="{{ old('isbn', $buku->isbn) }}"
        >

        @error('isbn')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>Stok</label>
        <input
            type="number"
            name="stok"
            class="form-control"
            value="{{ old('stok', $buku->stok) }}"
        >

        @error('stok')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button class="btn btn-primary">Simpan Perubahan</button>

    <a href="{{ route('buku.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</form>

@endsection
