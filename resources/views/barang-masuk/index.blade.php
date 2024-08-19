@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div>
                <h1 style="font-size: 3rem;"> Brang Masuk</h1>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="card h-100"> <!-- h-100 will make the card fill the height of the parent container -->
                        <div class="card-header">
                            <h4 class="card-title">Tabel Barang msuk by Kategori</h4>
                        </div>
                        <div class="card-body" style="max-height: 400px; overflow-y: auto;">
                            <div class="table-responsive">
                                <table id="multi-filter-select" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Nama Barang</th>
                                            <th>Stok Masuk</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($barangMasukGroupBy as $key => $data)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $data->katalogBarang->nama_barang }}</td>
                                                <td>{{ $data->stok_masuk }}</td>
                                                <td>
                                                    <a href="{{ route('barang-masuk.detail', $data->katalog_barang_id) }}"
                                                        class="btn btn-info mx-1" style="font-size: 16px;">
                                                        <i class="icon-eye" style="font-size: 16px;"></i> Detail Data
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
                        <h4 class="card-title">Raw Tabel Barang Masuk</h4>
                    </div>
                    <div class="">
                        <a href="#" class="btn btn-label-info btn-round btn-md" type="button" id="alert_demo_5">
                            <i class="fa fa-plus"></i>
                            Tambah Barang Masuk
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
                                    <th>Stok Masuk</th>
                                    <th>Keterangan</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama Barang</th>
                                    <th>Stok Masuk</th>
                                    <th>Keterangan</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($barangMasuk as $key => $data)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $data->katalogBarang->nama_barang }}</td>
                                        <td>{{ $data->stok_masuk }} - STOK</td>
                                        <td>{{ $data->keterangan }}</td>
                                        <td>
                                            <button class="btn btn-warning mx-1 edit-button"
                                                data-id="{{ $data->id }}"><i class="icon-pencil"></i></button>
                                            <form action="" class="d-flex">
                                                {{-- <a href="" class="btn btn-info mx-1"><i class="icon-eye"></i></a> --}}
                                                <button type="submit" class="btn btn-danger mx-1"><i
                                                        class="icon-trash"></i></button>
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
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <!-- Chart JS -->
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>
    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/js/setting-demo2.js') }}"></script>

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
                    label: "Active Users",
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
                    data: [
                        542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 900,
                    ],
                }, ],
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
        // insert data barang masuk
        $("#alert_demo_5").click(function(e) {
            var katalogBarang = @json($katalogBarang);
            var selectOptions = '';
            katalogBarang.forEach(function(barang) {
                selectOptions +=
                    `<option value="${barang.id}">${barang.nama_barang}</option>`; // Pastikan ID yang benar
            });
            swal({
                title: "Tambah Data Barang Masuk",
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
                        <label for="stok-masuk">Stok Masuk</label>
                        <input type="number" class="form-control" id="stok-masuk" placeholder="Jumlah Stok Masuk" name="stok_masuk">
                    </div>
                    <div class="form-group mt-2">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" placeholder="Keterangan" name="keterangan">
                    </div>
                `
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
                    let stokMasuk = $("#stok-masuk").val();
                    let keterangan = $("#keterangan").val();

                    // console.log({
                    //     katalog_barang_id: katalogBarangId,
                    //     stok_masuk: stokMasuk,
                    //     keterangan: keterangan
                    // });

                    // Mengirim data ke server pake AJAX
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('barang-masuk.store') }}',
                        data: {
                            katalog_barang_id: katalogBarangId,
                            stok_masuk: stokMasuk,
                            keterangan: keterangan,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            swal("Sukses!", "Data telah ditambahkan!", "success");
                            // nunggu 2 detik setelah berhasil insert data baru
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
                        },
                        error: function(xhr, status, error) {
                            var errors = xhr.responseJSON.errors;
                            var errorMessages = '';

                            // Gabungkan semua pesan error
                            $.each(errors, function(key, messages) {
                                messages.forEach(function(message) {
                                    errorMessages += message + '<br>';
                                });
                            });

                            // Tampilkan pesan error dengan SweetAlert
                            swal({
                                title: "Error!",
                                content: {
                                    element: "div",
                                    attributes: {
                                        innerHTML: `<div>${errorMessages}</div>`
                                    }
                                },
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });
        // Edit data barang masuk
        $(".edit-button").click(function(e) {
            var id = $(this).data("id");

            // Ambil data barang masuk berdasarkan ID menggunakan AJAX
            $.ajax({
                type: 'GET',
                url: '/barang-masuk/' + id + '/edit',
                success: function(response) {
                    var barangMasuk = response.barangMasuk;
                    var katalogBarang = @json($katalogBarang);
                    var selectOptions = '';

                    katalogBarang.forEach(function(barang) {
                        selectOptions +=
                            `<option value="${barang.id}" ${barang.id == barangMasuk.katalog_barang_id ? 'selected' : ''}>${barang.nama_barang}</option>`;
                    });

                    swal({
                        title: "Edit Data Barang Masuk",
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
                            <label for="stok-masuk">Stok Masuk</label>
                            <input type="number" class="form-control" id="stok-masuk" value="${barangMasuk.stok_masuk}" placeholder="Jumlah Stok Masuk" name="stok_masuk">
                        </div>
                        <div class="form-group mt-2">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" value="${barangMasuk.keterangan}" placeholder="Keterangan" name="keterangan">
                        </div>
                        `
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
                            let stokMasuk = $("#stok-masuk").val();
                            let keterangan = $("#keterangan").val();

                            // Mengirim data ke server pake AJAX
                            $.ajax({
                                type: 'PUT',
                                url: '/barang-masuk/' + id,
                                data: {
                                    katalog_barang_id: katalogBarangId,
                                    stok_masuk: stokMasuk,
                                    keterangan: keterangan,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    swal("Sukses!", "Data telah diubah!",
                                        "success");
                                    // nunggu 2 detik setelah berhasil update data
                                    setTimeout(function() {
                                        location.reload();
                                    }, 2000);
                                },
                                error: function(xhr, status, error) {
                                    var errors = xhr.responseJSON.errors;
                                    var errorMessages = '';

                                    // Gabungkan semua pesan error
                                    $.each(errors, function(key, messages) {
                                        messages.forEach(function(message) {
                                            errorMessages +=
                                                message + '<br>';
                                        });
                                    });

                                    // Tampilkan pesan error dengan SweetAlert
                                    swal({
                                        title: "Error!",
                                        content: {
                                            element: "div",
                                            attributes: {
                                                innerHTML: `<div>${errorMessages}</div>`
                                            }
                                        },
                                        icon: "error"
                                    });
                                }
                            });
                        }
                    });
                },
                error: function(xhr, status, error) {
                    swal("Error!", "Terjadi kesalahan saat mengambil data!", "error");
                }
            });
        });
    </script>
@endsection
