<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnggotaRequest;
use App\Http\Requests\UpdateAnggotaRequest;
use App\Models\Anggota;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggota = Anggota::latest()->paginate(10);

        return view('anggota.index', compact('anggota'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(StoreAnggotaRequest $request)
    {
        Anggota::create($request->validated());

        return redirect()
            ->route('anggota.index')
            ->with('sukses', 'Anggota berhasil ditambahkan.');
    }

    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    public function update(UpdateAnggotaRequest $request, Anggota $anggota)
    {
        $anggota->update($request->validated());

        return redirect()
            ->route('anggota.index')
            ->with('sukses', 'Anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->delete();

        return redirect()
            ->route('anggota.index')
            ->with('sukses', 'Anggota berhasil dihapus.');
    }
}
