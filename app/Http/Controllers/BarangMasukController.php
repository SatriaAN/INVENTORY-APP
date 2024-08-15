<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangMasuk = BarangMasuk::with('katalogBarang')->get();
        $barangMasukGroupBy = BarangMasuk::getBarangMasukByGroup();

        // Logic Query Bisa dari controller atau model, contoh dari controller

        // $barangMasukGroupBy = BarangMasuk::select('katalog_barang_id', DB::raw('SUM(stok_masuk) as total_stok_masuk'))
        //     ->groupBy('katalog_barang_id')
        //     ->with('katalogBarang')
        //     ->get();

        return view('barang-masuk.index', compact('barangMasuk', 'barangMasukGroupBy'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showDetail($katalog_barang_id)
    {
        //
        $detailBarangMasuk = BarangMasuk::getDetailBarangMasuk($katalog_barang_id);
        $namaBarang = $detailBarangMasuk->first()->katalogBarang->nama_barang;


        return view('barang-masuk.detail',compact('detailBarangMasuk','namaBarang'));
    }

    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}