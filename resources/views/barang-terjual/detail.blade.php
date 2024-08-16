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
                        <a href="#" class="btn btn-label-primary btn-round btn-md" type="button"
                            id="modalCreateByKategori"">
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
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script>
        $("#modalCreateByKategori").click(function(e) {
            var selectedBarangId = @json($katalog_barang_id);
            var selectedNamaBarang = "{{ $namaBarang }}";

            swal({
                title: `Tambah Data ${selectedNamaBarang} Terjual`,
                content: {
                    element: "div",
                    attributes: {
                        innerHTML: `
                        <div class="form-group">
                            <label for="nama-barang">Nama Barang</label>
                            <input type="text" class="form-control" id="nama-barang" value="${selectedNamaBarang}" readonly>
                            <input type="hidden" id="katalog-barang-id" value="${selectedBarangId}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="jumlah-terjual">Terjual</label>
                            <input min="1" type="number" class="form-control" id="jumlah-terjual" placeholder="Jumlah Stok Terjual" name="jumlah_terjual">
                        </div>
                        <div class="form-group mt-2">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" placeholder="Keterangan" name="keterangan">
                        </div>`
                    }
                },
                buttons: {
                    cancel: {
                        visible: true,
                        className: "btn btn-danger",
                    },
                    confirm: {
                        text: "Simpan",
                        className: "btn btn-success",
                    },
                },
            }).then(function(result) {
                if (result) {
                    let katalogBarangId = $("#katalog-barang-id").val();
                    let jumlahTerjual = $("#jumlah-terjual").val();
                    let keterangan = $("#keterangan").val();

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('barang-terjual.store') }}',
                        data: {
                            katalog_barang_id: katalogBarangId,
                            jumlah_terjual: jumlahTerjual,
                            keterangan: keterangan,
                            _token: '{{ csrf_token() }}',
                        },
                        success: function(response) {
                            swal("Sukses!", "Data telah Ditambahkan!", "success");
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        },
                        error: function(xhr, status, error) {
                            var errors = xhr.responseJSON.errors;
                            var errorMessages = '';

                            $.each(errors, function(key, messages) {
                                messages.forEach(function(message) {
                                    errorMessages += message + '<br>';
                                });
                            });

                            swal({
                                title: "Error!",
                                content: {
                                    element: "div",
                                    attributes: {
                                        innerHTML: `<div>${errorMessages}</div>`
                                    }
                                },
                                icon: "error",
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
