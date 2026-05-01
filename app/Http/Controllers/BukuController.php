<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::all();
        return view('buku.index', compact('bukus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required',
            'judul' => 'required',
            'tahun_terbit' => 'required|numeric',
            'penulis' => 'required',
            'stok_buku' => 'required|numeric',
        ]);

        Buku::create($request->all());

        return response()->json(['success' => true]);
    }

    public function delete(Request $request)
    {
        $deleted = Buku::where('id', $request->id)->delete();

        return response()->json([
            'success' => $deleted ? true : false,
            'message' => $deleted ? 'Buku berhasil dihapus' : 'Buku tidak ditemukan'
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:buku,id',
            'kode' => 'required',
            'judul' => 'required',
            'tahun_terbit' => 'required|numeric',
            'penulis' => 'required',
            'stok_buku' => 'required|numeric',
        ]);

        $buku = Buku::findOrFail($request->id);
        $buku->update($request->all());

        return response()->json(['success' => true]);
    }
}