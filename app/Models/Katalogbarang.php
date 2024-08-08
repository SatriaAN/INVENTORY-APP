<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}