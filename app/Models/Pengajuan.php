<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Website;

class Pengajuan extends Model
{
    protected $table = 'pengajuan';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','buku_id','tgl_pinjam','tgl_kembali','status'];
    public $timestamps = true;

        public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
