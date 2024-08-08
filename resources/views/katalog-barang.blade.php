@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div>
                <h1 class="my-4">Katalog Barang</h1>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Multi Filter Select</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="multi-filter-select" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Satuan</th>
                                    <th>Harga Jual</th>
                                    <th>Stok Awal</th>
                                    <th>Stok Masuk</th>
                                    <th>Terjual</th>
                                    <th>Stok Akhir</th>
                                    <th>Kas Masuk</th>
                                    <th>Profit</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Tanggal Diupdate</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nama Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Satuan</th>
                                    <th>Harga Jual</th>
                                    <th>Stok Awal</th>
                                    <th>Stok Masuk</th>
                                    <th>Terjual</th>
                                    <th>Stok Akhir</th>
                                    <th>Kas Masuk</th>
                                    <th>Profit</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Tanggal Diupdate</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($katalogBarang as $key => $data)
                                @endforeach
                                <tr>
                                    <td>{{ $data->nama_barang }}</td>
                                    <td>Rp.{{ $data->harga_beli }}</td>
                                    <td>{{ $data->harga_satuan }}</td>
                                    <td>{{ $data->harga_jual }}</td>
                                    <td>{{ $data->stok_awal }}</td>
                                    <td>{{ $data->stok_masuk }}</td>
                                    <td>{{ $data->terjual }}</td>
                                    <td>{{ $data->stok_akhir }}</td>
                                    <td>{{ $data->kas_masuk }}</td>
                                    <td>{{ $data->profit }}</td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
