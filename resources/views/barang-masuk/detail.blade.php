@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div>
                <h1 class="my-4">{{ !empty($namaBarang) ? $namaBarang . ' Masuk' : $namaBarang . ' Kosong' }}</h1>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Tabel
                            {{ !empty($namaBarang) ? $namaBarang . ' Masuk' : $namaBarang . ' Kosong' }}
                        </h4>
                    </div>
                    <div class="mx-3">
                        <a href="{{ route('barang-masuk.index') }}" class="btn btn-label-warning btn-round btn-md"">
                            <div class="btn-label">
                                <i class="fas fa-long-arrow-alt-left"></i>
                            </div>
                            Kembali
                        </a>
                        <a href="#" class="btn btn-label-primary btn-round btn-md" type="button"
                            id="modalCreateByKategori">
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
                                    <th>Tanggal Diupadte</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Terjual</th>
                                    <th>Keterangan</th>
                                    <th>Tanggal Dibuat</th>
                                    <th>Tanggal Diupadte</th>
                                    <th>Edit</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($detailBarangMasuk as $key => $data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->katalogBarang->nama_barang }}</td>
                                        <td>{{ $data->stok_masuk }}</td>
                                        <td>{{ $data->keterangan }}</td>
                                        <td>{{ $data->created_at }}</td>
                                        <td>{{ $data->updated_at }}</td>
                                        <td>
                                            <a href="{{ route('barang-masuk.edit', $data->id) }}"
                                                class="btn btn-warning mx-1" id="editBarangMasuk">
                                                <i class="icon-pencil"></i></a>
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
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script>
        $("#modalCreateByKategori").click(function(e) {
            var selectedBarangId = @json($katalog_barang_id);
            var selectedNamaBarang = "{{ $namaBarang }}";

            swal({
                title: `Tambah Data ${selectedNamaBarang} Masuk`,
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
                    <label for="stok-masuk">Stok Masuk</label>
                    <input min="1" type="number" class="form-control" id="stok-masuk" placeholder="Jumlah Stok Masuk" name="stok_masuk">
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
                    let stokMasuk = $("#stok-masuk").val();
                    let keterangan = $("#keterangan").val();

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('barang-masuk.store') }}',
                        data: {
                            katalog_barang_id: katalogBarangId,
                            stok_masuk: stokMasuk,
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

        // Edit data
        // edit data barang masuk
        $(document).on('click', '#editBarangMasuk', function(e) {
            e.preventDefault();

            // Ambil URL dari tombol yang diklik
            let url = $(this).attr('href');

            // AJAX request ke URL untuk mendapatkan data barang masuk
            $.get(url, function(data) {
                let selectedBarangId = data.barangMasuk.katalog_barang_id;
                let stokMasuk = data.barangMasuk.stok_masuk;
                let keterangan = data.barangMasuk.keterangan;

                let selectedNamaBarang = "{{ $namaBarang }}";

                swal({
                    title: `Edit Data ${selectedNamaBarang} Masuk`,
                    content: {
                        element: "div",
                        attributes: {
                            innerHTML: `
                        <div class="form-group">
                            <label for="nama-barang">Nama Barang</label>
                            <input class="form-control" id="nama-barang" value="${selectedNamaBarang}" readonly>
                            <input type="hidden" id="katalog-barang-id" value="${selectedBarangId}">
                        </div>
                        <div class="form-group mt-2">
                            <label for="stok-masuk">Stok Masuk</label>
                            <input min="1" type="number" class="form-control" id="stok-masuk" value="${stokMasuk}" placeholder="Jumlah Stok Masuk" name="stok_masuk">
                        </div>
                        <div class="form-group mt-2">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" value="${keterangan}" placeholder="Keterangan" name="keterangan">
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
                        let stokMasuk = $("#stok-masuk").val();
                        let keterangan = $("#keterangan").val();

                        $.ajax({
                            type: "POST",
                            url: '{{ route('barang-masuk.update', ':id') }}'.replace(':id',
                                data.barangMasuk.id),
                            data: {
                                _method: "PUT",
                                katalog_barang_id: katalogBarangId, // ID barang dari katalog
                                stok_masuk: stokMasuk,
                                keterangan: keterangan,
                                _token: '{{ csrf_token() }}',
                            },
                            success: function(response) {
                                swal("Sukses", "Data telah Diperbarui!", "success");
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            },
                            error: function(xhr, status, error) {
                                var errors = xhr.responseJSON.errors;
                                var errorMessages = '';

                                $.each(errors, function(key, messages) {
                                    messages.forEach(function(message) {
                                        errorMessages += message +
                                            '<br>';
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
            }).fail(function(xhr, status, error) {
                console.error("Error fetching data: ", error);
                swal("Error", "Gagal memuat data untuk edit.", "error");
            });
        });

        // filter table
        $(document).ready(function() {
            var table = $("#multi-filter-select").DataTable({
                pageLength: 7,
                columnDefs: [{
                    targets: 2,
                    type: 'num',
                    render: function(data, type, row) {
                        var num = parseInt(data.split(' - ')[0], 10);
                        if (type === 'sort' || type === 'type') {
                            return num;
                        }
                        return num + ' - STOK';
                    }
                }],
                initComplete: function() {
                    this.api().columns([1, 2, 3]).every(function() {
                        var column = this;
                        var select = $(
                                '<select class="form-select"><option value=""></option></select>'
                            )
                            .appendTo($(column.footer()).empty())
                            .on("change", function() {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? "^" + val + "$" : "", true, false)
                                    .draw();
                            });

                        column.data().unique().sort().each(function(d, j) {
                            var cleanedValue = d.split(' - ')[0] + ' - STOK';
                            select.append('<option value="' + cleanedValue + '">' +
                                cleanedValue + "</option>");
                        });
                    });
                },
            });

            $('#multi-filter-select_filter input').on('keyup change', function() {
                table.draw();
            });
        });
    </script>
@endsection
