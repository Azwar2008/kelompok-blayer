@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between mb-3">
    <h4>Daftar Anggota</h4>

    <a href="{{ route('anggota.create') }}" class="btn btn-primary">
        + Tambah Anggota
    </a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Nama</th>
            <th>NIS / NIP</th>
            <th>Alamat</th>
            <th>No. HP</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($anggota as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->nis_nip }}</td>
                <td>{{ $item->alamat ?? '-' }}</td>
                <td>{{ $item->no_hp ?? '-' }}</td>

                <td>
                    <a href="{{ route('anggota.edit', $item) }}" class="btn btn-sm btn-warning">
                        Edit
                    </a>

                    <form
                        action="{{ route('anggota.destroy', $item) }}"
                        method="POST"
                        class="d-inline"
                        onsubmit="return confirm('Yakin hapus anggota ini?')"
                    >
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-sm btn-danger">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">
                    Belum ada data anggota.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

{{ $anggota->links() }}

@endsection
