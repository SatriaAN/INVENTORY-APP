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

    protected $fillable = [
        'katalog_barang_id',
        'stok_masuk',
        'keterangan',
        'created_at',
        'updated_at'
    ];

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
        return self::select('katalog_barang_id', DB::raw('SUM(stok_masuk) as stok_masuk'))
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