<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Katalogbarang;
use Illuminate\Support\Facades\DB;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table = 'barang_masuk';

    public static function getAllData()
    {
        return self::all();
    }

    public static function getDataById($id)
    {
        return self::find($id);
    }

    public function katalogBarang(){
        return $this->belongsTo(Katalogbarang::class, 'katalog_barang_id');
    }

    public static function getBarangMasukByGroup()
    {
        return DB::table('barang_masuk as b')
        ->join('katalog_barang as a', 'b.katalog_barang_id', '=', 'a.id')
        ->selectRaw('a.nama_barang, SUM(b.stok_masuk) AS stok_masuk')
        ->groupBy('a.nama_barang')
        ->get();
    }
}