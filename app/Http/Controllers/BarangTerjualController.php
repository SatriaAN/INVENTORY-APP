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
        $barangTerjual = BarangTerjual::with('katalogBarang')->get();
        $katalogBarang = Katalogbarang::all();
        $barangTerjualGroupBy = BarangTerjual::getBarangTerjualByGroup();

        return view('barang-terjual.index', compact('barangTerjual', 'barangTerjualGroupBy', 'katalogBarang'));
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

        try {
            $barangTerjual = BarangTerjual::create($validated);

            if (!$barangTerjual) {
                throw new \Exception('Gagal memuat data barang terjual.');
            }

            return response()->json(['success' => 'Data Berhasil Ditambahkan']);
        } catch (\Exception $e) {
            Log::error('Error storing barang terjual:' . $e->getMessage());
            return response()->json(['error' => 'Terjadi Kesalahan:' . $e->getMessage()], 500);
        }
    }

    public function showDetail($katalog_barang_id)
    {


        $detailBarangTerjual = BarangTerjual::getDetailBarangTerjual($katalog_barang_id);
        $namaBarang = $detailBarangTerjual->first()->katalogBarang->nama_barang ?? 'Data Tidak Ditemukan';

        return view('barang-terjual.detail', compact('detailBarangTerjual', 'namaBarang'));
    }

    public function show(string $id)
    {
        //
    }

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
