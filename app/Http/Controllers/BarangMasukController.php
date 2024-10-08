<?php

namespace App\Http\Controllers;

use App\Models\BarangMasuk;
use App\Models\Katalogbarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangMasuk = BarangMasuk::with('katalogBarang')->orderBy('created_at','desc')->get();
        $katalogBarang = Katalogbarang::all();
        $barangMasukGroupBy = BarangMasuk::getBarangMasukByGroup();

        $barangMasukByMonth = DB::table('barang_masuk')
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(stok_masuk) as total'))
        ->groupBy('month')
        ->pluck('total', 'month')
        ->toArray();

        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $barangMasukByMonth[$i] ?? 0;
        }



        return view('barang-masuk.index', compact('barangMasuk', 'barangMasukGroupBy', 'katalogBarang','chartData'));
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
        $validated = $request->validate([
            'katalog_barang_id' => 'required|integer',
            'stok_masuk' => 'required|integer',
            'keterangan' => 'required|string',
        ]);

        try {
            $barangMasuk = BarangMasuk::create($validated);

            if (!$barangMasuk) {
                throw new \Exception('Gagal membuat data barang masuk.');
            }

            return response()->json(['success' => 'Data berhasil ditambahkan']);
        } catch (\Exception $e) {
            Log::error('Error storing barang masuk: ' . $e->getMessage());
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function showDetail($katalog_barang_id)
    {
        //
        $detailBarangMasuk = BarangMasuk::getDetailBarangMasuk($katalog_barang_id);
        $namaBarang = $detailBarangMasuk->first()->katalogBarang->nama_barang;

        return view('barang-masuk.detail', compact('detailBarangMasuk', 'namaBarang','katalog_barang_id'));
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $barangMasuk = BarangMasuk::find($id);
        if (!$barangMasuk) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        $katalogBarang = KatalogBarang::all();

        return response()->json([
            'barangMasuk' => $barangMasuk,
            'katalogBarang' => $katalogBarang
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'katalog_barang_id' => 'required|integer',
            'stok_masuk' => 'required|integer',
            'keterangan' => 'required|string',
        ]);

        $barangMasuk = BarangMasuk::findOrFail($id);
        $barangMasuk->katalog_barang_id = $request->katalog_barang_id;
        $barangMasuk->stok_masuk = $request->stok_masuk;
        $barangMasuk->keterangan = $request->keterangan;

        $barangMasuk->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barangMasuk = BarangMasuk::findOrFail($id);
        $barangMasuk->delete();
    }
}