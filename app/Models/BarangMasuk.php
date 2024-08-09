<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Katalogbarang;

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
}