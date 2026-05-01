<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Website;

class Buku extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id';
    protected $fillable = ['kode','judul','tahun_terbit','penulis','stok_buku'];
    public $timestamps = true;
}
