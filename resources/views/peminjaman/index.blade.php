
@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Data Peminjaman</h4>

    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary mb-3">
        + Catat Peminjaman
    </a>

    @if (session('gagal'))
        <div class="alert alert-danger">
            {{ session('gagal') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Buku</th>
                    <th>Anggota</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($peminjaman as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->buku->judul }}</td>
                        <td>{{ $item->anggota->nama }}</td>
                        <td>{{ $item->tanggal_pinjam }}</td>
                        <td>{{ $item->tanggal_kembali ?? '-' }}</td>
                        <td>
                            <span class="badge bg-{{ $item->status === 'dipinjam' ? 'warning' : 'success' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('peminjaman.edit', $item) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            @if ($item->status === 'dipinjam')
                                <form
                                    action="{{ route('peminjaman.kembalikan', $item) }}"
                                    method="POST"
                                    class="d-inline"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <button type="submit" class="btn btn-success btn-sm">
                                        Kembalikan
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">Selesai</span>
                            @endif

                            <form
                                action="{{ route('peminjaman.destroy', $item) }}"
                                method="POST"
                                class="d-inline"
                                onsubmit="return confirm('Yakin hapus data peminjaman ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-sm btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            Belum ada data peminjaman.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $peminjaman->links() }}
</div>
@endsection