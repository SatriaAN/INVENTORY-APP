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

    public function katalogBarang()
    {
        return $this->belongsTo(Katalogbarang::class, 'katalog_barang_id');
    }

    public static function getBarangMasukByGroup()
    {
        // return DB::table('barang_masuk as b')
        // ->join('katalog_barang as a', 'b.katalog_barang_id', '=', 'a.id')
        // ->selectRaw('a.nama_barang, SUM(b.stok_masuk) AS stok_masuk, ')
        // ->groupBy('a.nama_barang')
        // ->get();

        //contoh query dari model

        return self::select('katalog_barang_id', DB::raw('SUM(stok_masuk) as total_stok_masuk'))
            ->groupBy('katalog_barang_id')
            ->with('katalogBarang')
            ->get();
    }

    public static function getDetailBarangMasuk($katalog_barang_id)
    {
        return self::where('katalog_barang_id', $katalog_barang_id)
            ->with('katalogBarang')
            ->get();
    }
}