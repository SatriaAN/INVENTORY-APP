<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KatalogbarangController extends Controller
{
    //index
    public function index() {
        return view('katalog-barang');
    }
}