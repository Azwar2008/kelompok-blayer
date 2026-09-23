<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['buku', 'anggota'])
            ->latest()
            ->paginate(10);

        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        // Hanya tampilkan buku yang stoknya masih tersedia (guard clause di query)
        $buku = Buku::where('stok', '>', 0)->get();
        $anggota = Anggota::all();

        return view('peminjaman.create', compact('buku', 'anggota'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'anggota_id' => 'required|exists:anggota,id',
            'tanggal_pinjam' => 'required|date',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok < 1) {
            return back()->with(
                'gagal',
                'Stok buku habis, tidak bisa dipinjam.'
            );
        }

        Peminjaman::create([
            'buku_id' => $buku->id,
            'anggota_id' => $request->anggota_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'dipinjam',
        ]);

        $buku->pinjamkan(); // logika stok ada di Model (Bagian 3.2), bukan di sini

        return redirect()
            ->route('peminjaman.index')
            ->with('sukses', 'Peminjaman berhasil dicatat.');
    }

    public function edit(Peminjaman $peminjaman)
    {
        // Tampilkan semua buku agar buku yang sedang dipinjam tetap bisa dipilih
        $buku = Buku::all();
        $anggota = Anggota::all();

        return view('peminjaman.edit', compact('peminjaman', 'buku', 'anggota'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'anggota_id' => 'required|exists:anggota,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'nullable|date|after_or_equal:tanggal_pinjam',
            'status' => 'required|in:dipinjam,kembali',
        ]);

        $lama = $peminjaman->buku;
        $target = Buku::findOrFail($request->buku_id);

        $lamaDipinjam = $peminjaman->status === 'dipinjam';
        $baruDipinjam = $request->status === 'dipinjam';

        // Buku lama sedang menahan stok, akan dilepas dulu,
        // jadi stok yang sama tidak perlu dicek dua kali.
        $stokTersedia = ($target->id === $lama->id && $lamaDipinjam)
            ? $target->stok + 1
            : $target->stok;

        if ($baruDipinjam && $stokTersedia < 1) {
            return back()->with(
                'gagal',
                'Stok buku habis, tidak bisa dipinjam.'
            );
        }

        if ($lamaDipinjam) {
            $lama->kembalikan();
        }

        if ($baruDipinjam) {
            $target->pinjamkan();
        }

        $peminjaman->update([
            'buku_id' => $target->id,
            'anggota_id' => $request->anggota_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali
                ?? ($baruDipinjam ? null : now()->toDateString()),
            'status' => $request->status,
        ]);

        return redirect()
            ->route('peminjaman.index')
            ->with('sukses', 'Peminjaman berhasil diperbarui.');
    }

    public function kembalikan(Peminjaman $peminjaman)
    {
        if ($peminjaman->status === 'kembali') {
            return back()->with(
                'gagal',
                'Buku ini sudah dikembalikan sebelumnya.'
            );
        }

        $peminjaman->update([
            'status' => 'kembali',
            'tanggal_kembali' => now(),
        ]);

        $peminjaman->buku->kembalikan();

        return redirect()
            ->route('peminjaman.index')
            ->with('sukses', 'Buku berhasil dikembalikan.');
    }

    public function destroy(Peminjaman $peminjaman)
    {
        // Jika masih dipinjam, kembalikan stok bukunya dulu
        if ($peminjaman->status === 'dipinjam') {
            $peminjaman->buku->kembalikan();
        }

        $peminjaman->delete();

        return redirect()
            ->route('peminjaman.index')
            ->with('sukses', 'Data peminjaman dihapus.');
    }
}
