@extends('layouts.dashboard')
<script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div>
                <h1 class="my-4">{{ !empty($namaBarang) ? $namaBarang . ' Terjual' : $namaBarang . ' Kosong' }}</h1>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Tabel
                            {{ !empty($namaBarang) ? $namaBarang . ' Terjual' : $namaBarang . 'Kosong' }}</h4>
                    </div>
                    <div class="mx-3">
                        <a href="{{ route('barang-terjual.index') }}" class="btn btn-label-warning btn-round btn-md">
                            <div class="btn-label">
                                <i class="fas fa-long-arrow-alt-left"></i>
                            </div>
                            Kembali
                        </a>
                        <a href="#" class="btn btn-label-primary btn-round btn-md">
                            <div class="btn-label">
                                <i class="fas fa-plus"></i>
                            </div>
                            Tambah Barang Terjual
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="multi-filter-select" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Terjual</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Tanggal Diperbarui</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Terjual</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Tanggal Diperbarui</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($detailBarangTerjual as $key => $data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->katalogBarang->nama_barang }}</td>
                                        <td>{{ $data->jumlah_terjual }}</td>
                                        <td>{{ $data->keterangan }}</td>
                                        <td>{{ $data->created_at }}</td>
                                        <td>{{ $data->updated_at }}</td>
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
