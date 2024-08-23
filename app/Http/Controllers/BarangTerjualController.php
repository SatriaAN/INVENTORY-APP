<?php

namespace App\Http\Controllers;

use App\Models\BarangTerjual;
use App\Models\Katalogbarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BarangTerjualController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangTerjual = BarangTerjual::with('katalogBarang')->orderBy('created_at', 'desc')->get();
        $katalogBarang = Katalogbarang::all();
        $barangTerjualGroupBy = BarangTerjual::getBarangTerjualByGroup();

        $barangTerjualByMonth =  BarangTerjual::getBarangTerjualByMonth();

        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $barangTerjualByMonth[$i] ?? 0;
        }

        return view('barang-terjual.index', compact('barangTerjual', 'barangTerjualGroupBy', 'katalogBarang', 'chartData'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'katalog_barang_id' => 'required|integer',
            'jumlah_terjual' => 'required|integer',
            'keterangan' => 'required|string',
        ]);

        $barangTerjual = BarangTerjual::create($validated);

        $barangTerjual->save();
    }

    public function showDetail($katalog_barang_id)
    {
        $detailBarangTerjual = BarangTerjual::getDetailBarangTerjual($katalog_barang_id);
        $namaBarang = $detailBarangTerjual->first()->katalogBarang->nama_barang ?? 'Data Tidak Ditemukan';

        return view('barang-terjual.detail', compact('detailBarangTerjual', 'namaBarang', 'katalog_barang_id'));
    }


    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $barangTerjual = BarangTerjual::findOrFail($id);
        $katalogBarang = Katalogbarang::all();

        return response()->json(compact('barangTerjual', 'katalogBarang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'katalog_barang_id' => 'required|integer',
            'jumlah_terjual' => 'required|integer',
            'keterangan' => 'required|string',
        ]);

        $barangTerjual = BarangTerjual::findOrFail($id);
        $barangTerjual->katalog_barang_id = $request->katalog_barang_id;
        $barangTerjual->jumlah_terjual = $request->jumlah_terjual;
        $barangTerjual->keterangan = $request->keterangan;

        $barangTerjual->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        BarangTerjual::where('id', $id)->delete();
    }
}
