@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div>
                <h1 class="my-4">Barang Terjual</h1>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h4 class="card-title">Tabel Barang Terjual by Kategori</h4>
                        </div>
                        <div class="card-body" style="max-height: 335px; overflow-y: auto;">
                            <div class="table-responsive">
                                <table class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th style="width: 28%;">Nama Barang</th>
                                            <th style="width: 10%;">Terjual</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($barangTerjualGroupBy as $key => $data)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $data->katalogBarang->nama_barang }}</td>
                                                <td> {{ $data->total_jumlah_terjual }}</td>
                                                <td>
                                                    <a href="{{ route('barang-terjual.detail', $data->katalog_barang_id) }}"
                                                        class="btn btn-info mx-1" style="font-size: 1rem;">
                                                        <i class="icon-eye" style="font-size: 1rem;"></i> Detail Data
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <div class="card-title">Line Chart</div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container">
                                <canvas id="lineChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <h4 class="card-title">Raw Tabel Barang Terjual</h4>
                    </div>
                    <div>
                        <a href="#" class="btn btn-label-info btn-round btn-md" type="button"
                            id="insertBarangTerjual">
                            <i class="fa fa-plus">&nbsp;</i>
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
                                    <th>Stok Terjual</th>
                                    <th>Keterangan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama Barang</th>
                                    <th>Stok Terjual</th>
                                    <th>Keterangan</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($barangTerjual as $key => $data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->katalogBarang->nama_barang }}</td>
                                        <td>{{ $data->jumlah_terjual }} - STOK</td>
                                        <td>{{ $data->keterangan }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('barang-terjual.edit', $data->id) }}"
                                                class="btn btn-warning mx-1" id="modalEditBarangTerjual">
                                                <i class="icon-pencil"></i></a>
                                            <form id="deleteForm" action="{{ route('barang-terjual.destroy', $data->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger mx-1 deleteBarangTerjual">
                                                    <i class="icon-trash"></i>
                                                </button>
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
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>
    <script>
        var lineChart = document.getElementById("lineChart").getContext("2d")

        var myLineChart = new Chart(lineChart, {
            type: "line",
            data: {
                labels: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                ],
                datasets: [{
                    label: "Barang Terjual",
                    borderColor: "#1d7af3",
                    pointBorderColor: "#FFF",
                    pointBackgroundColor: "#1d7af3",
                    pointBorderWidth: 2,
                    pointHoverRadius: 4,
                    pointHoverBorderWidth: 1,
                    pointRadius: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    borderWidth: 2,
                    data: @json($chartData),
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    position: "bottom",
                    labels: {
                        padding: 10,
                        fontColor: "#1d7af3",
                    },
                },
                tooltips: {
                    bodySpacing: 4,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest",
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10,
                },
                layout: {
                    padding: {
                        left: 15,
                        right: 15,
                        top: 15,
                        bottom: 15
                    },
                },
            },
        });
    </script>
    <script>
        $("#insertBarangTerjual").click(function(e) {
            var katalogBarang = @json($katalogBarang);
            var selectOptions = '';
            katalogBarang.forEach(function(barang) {
                selectOptions += `<option value="${barang.id}">${barang.nama_barang}</option>`;
            });
            swal({
                title: "Tambah Data Barang Terjual",
                content: {
                    element: "div",
                    attributes: {
                        innerHTML: `
                        <div class="form-group">
                            <label for="nama-barang">Nama Barang</label>
                            <select class="form-control" id="nama-barang" name="katalog_barang_id">
                                ${selectOptions}
                            </select>
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
                    let katalogBarangId = $("#nama-barang").val();
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
    <script>
        //Gunain event DELEGATION untuk menangani klik pada tombol edit
        $(document).on('click', '#modalEditBarangTerjual', function(e) {
            e.preventDefault();

            //ambil url dari tombol yang aku klik
            let url = $(this).attr('href');


            //ajax request ke url untuk dapatin data barang terjual
            $.get(url, function(data) {
                let selectedBarangId = data.barangTerjual.katalog_barang_id;
                let jumlahTerjual = data.barangTerjual.jumlah_terjual;
                let keterangan = data.barangTerjual.keterangan;

                let namaBarangOptions = '';
                data.katalogBarang.forEach(function(barang) {
                    namaBarangOptions +=
                        `<option value="${barang.id}" ${barang.id == selectedBarangId ? 'selected' : ''}>${barang.nama_barang}</option>`
                });

                swal({
                    title: `Edit Data Terjual`,
                    content: {
                        element: "div",
                        attributes: {
                            innerHTML: `
                            <div class="form-group">
                                <label for="nama-barang">Nama Barang</label>
                                <select class="form-control" id="nama-barang" name="katalog_barang_id">
                                ${namaBarangOptions}
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="jumlah-terjual">Terjual</label>
                                <input min="1" type="number" class="form-control" id="jumlah-terjual" value="${jumlahTerjual}" placeholder="Jumlah Stok Terjual" name="jumlah_terjual">
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
                        let katalogBarangId = $("#nama-barang").val();
                        let jumlahTerjual = $("#jumlah-terjual").val();
                        let keterangan = $("#keterangan").val();

                        $.ajax({
                            type: "POST",
                            url: '{{ route('barang-terjual.update', ':id') }}'.replace(
                                ':id', data.barangTerjual.id),
                            data: {
                                _method: "PUT",
                                katalog_barang_id: katalogBarangId, // ID barang dari katalog
                                jumlah_terjual: jumlahTerjual,
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
            });
        });
    </script>
    <script>
        $(".deleteBarangTerjual").click(function(e) {
            e.preventDefault();

            let formAction = $(this).closest('form').attr('action');

            swal({
                title: "Yakin untuk menghapus data barang terjual ini?",
                text: "Setelah di hapus data tidak bisa kembali!",
                icon: "warning",
                buttons: {
                    cancel: {
                        visible: true,
                        text: "Batal",
                        className: "btn btn-danger",
                    },
                    confirm: {
                        text: "Ya, Hapus.",
                        className: "btn btn-success",
                    },
                },
            }).then((willDelete) => {
                if (willDelete) {
                    // Mengirimkan request DELETE dengan AJAX
                    $.ajax({
                        type: "POST",
                        url: formAction,
                        data: {
                            _method: "DELETE",
                            _token: $('meta[name="csrf-token"]').attr(
                                'content') // Ambil CSRF token dari meta tag
                        },
                        success: function(response) {
                            swal("Data Berhasil dihapus!", {
                                icon: "success",
                                buttons: {
                                    confirm: {
                                        className: "btn btn-success",
                                    },
                                },
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        },
                        error: function(xhr) {
                            console.error(xhr
                                .responseText);
                            swal({
                                title: "Gagal",
                                text: "Terjadi kesalahan saat menghapus data!",
                                icon: "error",
                            });
                        }
                    });
                } else {
                    swal("Data tidak dihapus!", {
                        icon: "info",
                        buttons: {
                            confirm: {
                                className: "btn btn-success",
                            },
                        },
                    });
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#multi-filter-select").DataTable({
                pageLength: 7,

                //fitur sort berdasarkan kolom tertentu aja

                // columnsDefsc: [{
                //     targets: 2,
                //     type: 'num',
                //     render: function(data, type, row) {
                //         var num = parseInt(data.split(' - ')[0], 10);
                //         if (type === 'sort' || type === 'type') {
                //             return num;
                //         }
                //         return num + ' - STOK';
                //     }
                // }],

                initComplete: function() {
                    this.api().columns([1, 2, 3]).every(function(index) {
                        var column = this;
                        if ([1, 2, 3].includes(index)) {
                            var select = $(
                                    '<select class="form-select"><option value=""></option></select>'
                                )
                                .appendTo($(column.footer()).empty())
                                .on("change", function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this)
                                        .val());
                                    column.search(val ? "^" + val + "$" : "", true, false)
                                        .draw();
                                });

                            column.data().unique().sort().each(function(d, j) {
                                var optionValue = d;
                                if (index === 2) {
                                    optionValue += '';
                                }
                                // var cleanedValue = d.split(' - ')[0] + ' - STOK';
                                select.append('<option value="' + d + '">' +
                                    optionValue + "</option>");
                            });
                        }
                    });
                },
            });

            // $('#multi-filter-select_filter input').on('keyup change', function() {
            //     table.draw();
            // });
        });
    </script>
@endsection
