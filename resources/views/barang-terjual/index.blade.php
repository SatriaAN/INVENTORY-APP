@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div>
                <h1 class="my-4">Barang Terjual</h1>
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
                                    <th>Nama Barang</th>
                                    <th>Jumlah Terjual</th>
                                    <th>Keterangan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Terjual</th>
                                    <th>Keterangan</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($barangTerjual as $key => $data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->katalogBarang->nama_barang }}</td>
                                        <td>{{ $data->jumlah_terjual }}</td>
                                        <td>{{ $data->keterangan }}</td>
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
