<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Katalogbarang extends Model
{
    use HasFactory;

    protected $table = 'katalog_barang';
    protected $fillable = ['nama_barang','harga_beli','harga_satuan','harga_jual','stok_awal','stok_masuk','terjual','stok_akhir','kas_masuk','profit'];

    public static function getAllData()
    {
        return self::all();
    }

    public static function getDataById($id)
    {
        return self::find($id);
    }

    public function barangMasuk()
    {
        return $this->hasMany(BarangMasuk::class, 'katalog_barang_id');
    }

    public function barangTerjual()
    {
        return $this->hasMany(BarangTerjual::class, 'katalog_barang_id');
    }

    // public function stokMasuk()
    // {
    //     return $this->belongsTo(BarangMasuk::class, 'katalog_barang_id');
    // }

    // public function terjual()
    // {
    //     return $this->belongsTo(BarangMasuk::class, 'katalog_barang_id');
    // }
}