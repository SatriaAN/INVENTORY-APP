<?php

namespace App\Http\Controllers;

use App\Models\Katalogbarang;
use Illuminate\Http\Request;

class KatalogbarangController extends Controller
{
    //index
    public function index() {
        $katalogBarang = Katalogbarang::getAllData();

        return view('katalog-barang', compact('katalogBarang'));
    }

    public function create() {

    }
}