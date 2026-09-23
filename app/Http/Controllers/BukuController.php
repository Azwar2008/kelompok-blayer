<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use Illuminate\Http\Request;


class BukuController extends Controller
{
public function index()
{
$buku = Buku::latest()->paginate(10);
return view('buku.index', compact('buku'));
}
public function create()
{
return view('buku.create');
}
public function store(StoreBukuRequest $request)
{
Buku::create($request->validated());
return redirect()->route('buku.index')->with('sukses', 'Buku berhasil ditambahkan.');
}
public function edit(Buku $buku)
{
return view('buku.edit', compact('buku'));
}
public function update(UpdateBukuRequest $request, Buku $buku)
{
$buku->update($request->validated());
return redirect()->route('buku.index')->with('sukses', 'Buku berhasil diperbarui.');
}
public function destroy(Buku $buku)
{
$buku->delete();
return redirect()->route('buku.index')->with('sukses', 'Buku berhasil dihapus.');
}
}