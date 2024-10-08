@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div>
                <h1 class="my-4">Laporan Keuangan</h1>
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
                                    <th>NO</th>
                                    <th>Jumlah Beli</th>
                                    <th>Satuan</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Satuan</th>
                                    <th>Harga Ongkir</th>
                                    <th>Kredit</th>
                                    <th>Debet</th>
                                    <th>Sisa Saldo</th>
                                    <th>Total Keseluruhan</th>
                                    <th>Total Bayar</th>
                                    <th>Total Diskon</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Tanggal Diupdate</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>NO</th>
                                    <th>Jumlah Beli</th>
                                    <th>Satuan</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Satuan</th>
                                    <th>Harga Ongkir</th>
                                    <th>Kredit</th>
                                    <th>Debet</th>
                                    <th>Sisa Saldo</th>
                                    <th>Total Keseluruhan</th>
                                    <th>Total Bayar</th>
                                    <th>Total Diskon</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Tanggal Diupdate</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($laporanKeuangan as $key => $data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->jumlah_beli }}</td>
                                        <td>{{ $data->satuan }}</td>
                                        <td>{{ $data->nama_barang }}</td>
                                        <td>Rp.{{ number_format($data->harga_satuan, 0, ',', '.') }}</td>
                                        <td>Rp.{{ number_format($data->harga_ongkir, 0, ',', '.') }}</td>
                                        <td>Rp.{{ number_format($data->kredit, 0, ',', '.') }}</td>
                                        <td>Rp.{{ number_format($data->debet, 0, ',', '.') }}</td>
                                        <td>Rp.{{ number_format($data->sisa_saldo, 0, ',', '.') }}</td>
                                        <td>Rp.{{ number_format($data->total_keseluruhan, 0, ',', '.') }}</td>
                                        <td>Rp.{{ number_format($data->total_bayar, 0, ',', '.') }}</td>
                                        <td>Rp.{{ number_format($data->total_diskon, 0, ',', '.') }}</td>
                                        <td>{{ $data->created_at->format('d-m-Y') }}</td>
                                        <td>{{ $data->updated_at->format('d-m-Y') }}</td>
                                        <td>
                                            <form action="POST" class="d-flex">
                                                <a href="" class="btn btn-info mx-1"><i class="icon-eye"></i></a>
                                                <button type="submit" class="btn btn-danger mx-1"><i
                                                        class="icon-trash"></i></button>
                                                <a href="" class="btn btn-warning mx-1"><i
                                                        class="icon-pencil"></i></a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
