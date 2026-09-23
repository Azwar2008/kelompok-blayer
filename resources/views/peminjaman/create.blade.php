
@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Catat Peminjaman Baru</h4>

    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf

        {{-- Pilih Buku --}}
        <div class="mb-3">
            <label for="buku_id" class="form-label">Buku</label>
            <select name="buku_id" id="buku_id" class="form-select" required>
                <option value="">-- Pilih Buku --</option>

                @foreach ($buku as $b)
                    <option value="{{ $b->id }}">
                        {{ $b->judul }} (stok: {{ $b->stok }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Pilih Anggota --}}
        <div class="mb-3">
            <label for="anggota_id" class="form-label">Anggota</label>
            <select name="anggota_id" id="anggota_id" class="form-select" required>
                <option value="">-- Pilih Anggota --</option>

                @foreach ($anggota as $a)
                    <option value="{{ $a->id }}">
                        {{ $a->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tanggal Pinjam --}}
        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">
                Tanggal Pinjam
            </label>

            <input
                type="date"
                name="tanggal_pinjam"
                id="tanggal_pinjam"
                class="form-control"
                value="{{ old('tanggal_pinjam', date('Y-m-d')) }}"
                required
            >
        </div>

        {{-- Tombol Simpan --}}
        <button type="submit" class="btn btn-primary">
            Simpan
        </button>

        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection