@extends('layouts.app')

@section('content')

<h4>Tambah Anggota</h4>

<form action="{{ route('anggota.store') }}" method="POST">
    @csrf

    <div class="mb-2">
        <label>Nama</label>
        <input
            type="text"
            name="nama"
            class="form-control"
            value="{{ old('nama') }}"
        >

        @error('nama')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-2">
        <label>NIS / NIP</label>
        <input
            type="text"
            name="nis_nip"
            class="form-control"
            value="{{ old('nis_nip') }}"
        >

        @error('nis_nip')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-2">
        <label>Alamat</label>
        <textarea name="alamat" class="form-control">{{ old('alamat') }}</textarea>

        @error('alamat')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="mb-3">
        <label>No. HP</label>
        <input
            type="text"
            name="no_hp"
            class="form-control"
            value="{{ old('no_hp') }}"
        >

        @error('no_hp')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <button class="btn btn-primary">Simpan</button>

    <a href="{{ route('anggota.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</form>

@endsection
