@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Edit Peminjaman</h4>

    @if (session('gagal'))
        <div class="alert alert-danger">
            {{ session('gagal') }}
        </div>
    @endif

    <form action="{{ route('peminjaman.update', $peminjaman) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Pilih Buku --}}
        <div class="mb-3">
            <label for="buku_id" class="form-label">Buku</label>
            <select name="buku_id" id="buku_id" class="form-select" required>
                <option value="">-- Pilih Buku --</option>

                @foreach ($buku as $b)
                    <option
                        value="{{ $b->id }}"
                        @selected(old('buku_id', $peminjaman->buku_id) == $b->id)
                    >
                        {{ $b->judul }} (stok: {{ $b->stok }})
                    </option>
                @endforeach
            </select>

            @error('buku_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Pilih Anggota --}}
        <div class="mb-3">
            <label for="anggota_id" class="form-label">Anggota</label>
            <select name="anggota_id" id="anggota_id" class="form-select" required>
                <option value="">-- Pilih Anggota --</option>

                @foreach ($anggota as $a)
                    <option
                        value="{{ $a->id }}"
                        @selected(old('anggota_id', $peminjaman->anggota_id) == $a->id)
                    >
                        {{ $a->nama }}
                    </option>
                @endforeach
            </select>

            @error('anggota_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Tanggal Pinjam --}}
        <div class="mb-3">
            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>

            <input
                type="date"
                name="tanggal_pinjam"
                id="tanggal_pinjam"
                class="form-control"
                value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam) }}"
                required
            >

            @error('tanggal_pinjam')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Tanggal Kembali --}}
        <div class="mb-3">
            <label for="tanggal_kembali" class="form-label">
                Tanggal Kembali
            </label>

            <input
                type="date"
                name="tanggal_kembali"
                id="tanggal_kembali"
                class="form-control"
                value="{{ old('tanggal_kembali', $peminjaman->tanggal_kembali) }}"
            >

            <small class="text-muted">Kosongkan jika buku belum dikembalikan.</small>

            @error('tanggal_kembali')
                <small class="text-danger d-block">{{ $message }}</small>
            @enderror
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>

            <select name="status" id="status" class="form-select" required>
                <option value="dipinjam" @selected(old('status', $peminjaman->status) === 'dipinjam')}>
                    Dipinjam
                </option>
                <option value="kembali" @selected(old('status', $peminjaman->status) === 'kembali')}>
                    Kembali
                </option>
            </select>

            @error('status')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        {{-- Tombol Simpan --}}
        <button type="submit" class="btn btn-primary">
            Simpan Perubahan
        </button>

        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection
