@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div>
                <h1 class="my-4">Katalog Barang</h1>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="h1 fw-bold float-end text-success">{{ count($terjual) }}</div>
                            <h2 class="mb-5">Barang Terjual</h2>
                            {{-- <p class="text-muted"></p> --}}
                            <div class="pull-in sparkline-fix">
                                <div id="lineChart3"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="h1 fw-bold float-end text-primary">
                                {{ count($stokMasuk) }}
                            </div>
                            <h2 class="mb-5">Barang Masuk</h2>
                            {{-- <p class="text-muted">Barang Masuk</p> --}}
                            <div class="pull-in sparkline-fix">
                                <div id="lineChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tabel Katalog Barang</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="multi-filter-select" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No</th>
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
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($katalogBarang as $key => $data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->nama_barang }}</td>
                                        <td>Rp.{{ number_format($data->harga_beli, 0, ',', '.') }}</td>
                                        <td>Rp.{{ number_format($data->harga_satuan, 0, ',', '.') }}</td>
                                        <td>Rp.{{ number_format($data->harga_jual, 0, ',', '.') }}</td>
                                        <td>{{ $data->stok_awal }}</td>
                                        <td>{{ $data->stok_masuk }}</td>
                                        <td>{{ $data->terjual }}</td>
                                        <td>{{ $data->stok_akhir }}</td>
                                        <td>Rp.{{ number_format ($data->kas_masuk, 0, ',','.') }}</td>
                                        <td>Rp.{{ number_format ($data->profit,0,',','.') }}</td>
                                        <td>{{ $data->created_at }}</td>
                                        <td>{{ $data->updated_at }}</td>
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
    {{-- <script>
        // Data dari server yang sudah di-passing ke view
        var barangMasukData = @json($stokMasuk);
        var barangTerjualData = @json($terjual);

        // Mengganti data statis dengan data dinamis dari database
        $("#lineChart").sparkline(barangMasukData, {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart3").sparkline(barangTerjualData, {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#6cbf6c",
            fillColor: "rgba(255, 165, 52, .14)",
        });
    </script> --}}
@endsection
