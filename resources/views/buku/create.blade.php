@extends('layouts.app')

@section('content')

<h4>Tambah Buku</h4>

<form action="{{ route('buku.store') }}" method="POST">
    @csrf

    <div class="mb-2">
        <label>Judul</label>
        <input
            type="text"
            name="judul"
            class="form-control"
            value="{{ old('judul') }}"
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
            value="{{ old('penulis') }}"
        >
    </div>

    <div class="mb-2">
        <label>Penerbit</label>
        <input
            type="text"
            name="penerbit"
            class="form-control"
            value="{{ old('penerbit') }}"
        >
    </div>

    <div class="mb-2">
        <label>Tahun Terbit</label>
        <input
            type="number"
            name="tahun_terbit"
            class="form-control"
            value="{{ old('tahun_terbit') }}"
        >
    </div>

    <div class="mb-2">
        <label>ISBN</label>
        <input
            type="text"
            name="isbn"
            class="form-control"
            value="{{ old('isbn') }}"
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
            value="{{ old('stok', 1) }}"
        >
    </div>

    <button class="btn btn-primary">Simpan</button>
</form>

@endsection
