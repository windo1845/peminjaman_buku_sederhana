<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Buku;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    // GET ALL
    public function buku()
    {
        return response()->json([
            'success' => true,
            'message' => 'List semua buku',
            'data' => Buku::all()
        ]);
    }

    // GET BY KODE
    public function kodebuku($code)
    {
        $book = Buku::where('kode', $code)->first();

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan',
                'data' => null
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail buku',
            'data' => $book
        ]);
    }

    // POST (CREATE)
    public function postbuku(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:buku,kode',
            'judul' => 'required',
            'tahun_terbit' => 'required|integer',
            'penulis' => 'required',
            'stok_buku' => 'required|integer'
        ]);

        $book = Buku::create($request->only([
            'kode',
            'judul',
            'tahun_terbit',
            'penulis',
            'stok_buku'
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil ditambahkan',
            'data' => $book
        ], 201);
    }

    // PUT (UPDATE)
    public function kodebukuput(Request $request, $code)
    {
        $book = Buku::where('kode', $code)->first();

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan',
                'data' => null
            ], 404);
        }

        $request->validate([
            'kode' => [
                'required',
                Rule::unique('buku', 'kode')->ignore($book->id)
            ],
            'judul' => 'required',
            'tahun_terbit' => 'required|integer',
            'penulis' => 'required',
            'stok_buku' => 'required|integer'
        ]);

        $book->update($request->only([
            'kode',
            'judul',
            'tahun_terbit',
            'penulis',
            'stok_buku'
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil diupdate',
            'data' => $book
        ]);
    }

    // DELETE
    public function kodebukudelete($code)
    {
        $book = Buku::where('kode', $code)->first();

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Buku tidak ditemukan',
                'data' => null
            ], 404);
        }

        $book->delete();

        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil dihapus',
            'data' => null
        ]);
    }
}