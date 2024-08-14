<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Katalogbarang;
use Illuminate\Support\Facades\DB;

class BarangTerjual extends Model
{
    use HasFactory;
    protected $table = 'barang_terjual';

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

    public static function getBarangTerjualByGroup()
    {
        return self::select('katalog_barang_id', DB::raw('SUM(jumlah_terjual) as total_jumlah_terjual'))
            ->groupBy('katalog_barang_id')
            ->with('katalogBarang')
            ->get();
    }

    public static function getDetailBarangTerjual($katalog_barang_id)
    {
        return self::where('katalog_barang_id', $katalog_barang_id)
            ->with('katalogBarang')
            // ->get(['id', 'jumlah_terjual', 'created_at', 'updated_at']);
            ->get();
    }
}
