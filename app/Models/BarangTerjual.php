<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Katalogbarang;

class BarangTerjual extends Model
{
    use HasFactory;
    protected $table = 'barang_terjual';

    public function katalogBarang()
    {
        return $this->belongsTo(Katalogbarang::class, 'katalog_barang_id');
    }
}