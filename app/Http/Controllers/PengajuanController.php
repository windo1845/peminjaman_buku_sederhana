<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pengajuan;
use App\Models\Buku;

class PengajuanController extends Controller
{
    public function index()
    {
        $pengajuans = Pengajuan::with('user','buku')->get();
        $bukus = Buku::all();

        return view('pengajuan.index', compact('pengajuans','bukus'));
    }

    public function approve($id)
    {
        $p = Pengajuan::findOrFail($id);
        $b = Buku::findOrFail($p->buku_id);
    
        if ($b->stok_buku <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Stok buku habis'
            ]);
        }
    
        DB::transaction(function () use ($p, $b) {
            $b->decrement('stok_buku');
            $p->update(['status' => 'approved']);
        });
    
        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil di-approve'
        ]);
    }
    
    public function reject($id)
    {
        $p = Pengajuan::findOrFail($id);
    
        $p->update([
            'status' => 'rejected'
        ]);
    
        return response()->json([
            'success' => true,
            'message' => 'Pengajuan ditolak'
        ]);
    }
    
    public function returned($id)
    {
        $p = Pengajuan::findOrFail($id);
        $b = Buku::findOrFail($p->buku_id);
    
        DB::transaction(function () use ($p, $b) {
            $b->increment('stok_buku');
            $p->update(['status' => 'returned']);
        });
    
        return response()->json([
            'success' => true,
            'message' => 'Buku berhasil dikembalikan'
        ]);
    }

    public function delete(Request $request)
    {
        Pengajuan::where('id',$request->id)->delete();
        return response()->json(['success'=>true]);
    }



    // anggota
    public function anggotaIndex()
    {
        $bukus = Buku::where('stok_buku', '>', 0)->get();

        $pengajuans = Pengajuan::with('buku')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('anggota.index', compact('bukus', 'pengajuans'));
    }

    public function anggotaStore(Request $request)
    {
        $buku = Buku::findOrFail($request->buku_id);
    
        if ($buku->stok_buku < 1) {
            return response()->json([
                'success' => false,
                'message' => 'Stok buku habis'
            ]);
        }

        DB::transaction(function () use ($request) {

            Pengajuan::create([
                'user_id'     => auth()->id(),
                'buku_id'     => $request->buku_id,
                'tgl_pinjam'  => $request->tgl_pinjam,
                'tgl_kembali' => $request->tgl_kembali,
                'status'      => 'pending'
            ]);

        });

        return response()->json([
            'success' => true
        ]);
    }

}