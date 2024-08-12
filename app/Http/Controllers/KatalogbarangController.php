<?php

namespace App\Http\Controllers;

use App\Models\Katalogbarang;
use Illuminate\Http\Request;

class KatalogbarangController extends Controller
{
    //index
    public function index() {
        $katalogBarang = Katalogbarang::getAllData();
        $stokMasuk = Katalogbarang::pluck('stok_masuk')->toArray();
        $terjual = Katalogbarang::pluck('terjual')->toArray();

        return view('katalog-barang.index', compact('katalogBarang','stokMasuk','terjual'));
    }

    public function create() {

    }
}