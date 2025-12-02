@extends('layouts.app')

@section('title', 'Self Auto Dashboard')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet"
    href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('library/owl.carousel/dist/assets/owl.carousel.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('library/owl.carousel/dist/assets/owl.theme.default.min.css') }}">
<link rel="stylesheet"
    href="{{ asset('library/flag-icon-css/css/flag-icon.min.css') }}">
@endpush

@section('main')
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <!-- Total Pelanggan -->
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pelanggan</h4>
                        </div>
                        <div class="card-body">
                            59
                        </div>
                    </div>
                </div>

                <!-- Total Pendapatan -->
                <div class="card card-statistic-2">
                    <div class="card-stats">
                        <div class="card-stats-title">Total Pendapatan -
                            <div class="dropdown d-inline">
                                <a class="font-weight-600 dropdown-toggle"
                                    data-toggle="dropdown"
                                    href="#"
                                    id="orders-month">Hari Ini</a>
                                <ul class="dropdown-menu dropdown-menu-sm">
                                    <li class="dropdown-title">Pilih Periode</li>
                                    <li>
                                        <a href="#" class="dropdown-item">
                                            Hari Ini
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-item">
                                            Pekan Ini
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-item">
                                            Bulan Ini
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fa-solid fa-money-bill" style="color: #ffffff;"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pendapatan</h4>
                        </div>
                        <div class="card-body">
                            Rp.187.000
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fa-solid fa-motorcycle" style="color: #ffffff;"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Kendaraan</h4>
                        </div>
                        <div class="card-body">
                            87
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fa-solid fa-wrench" style="color: #ffffff;"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Service</h4>
                        </div>
                        <div class="card-body">
                            35
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Invoice Pelanggan Service -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Daftar Invoice Pelanggan</h4>
                        <div class="card-header-action">
                            <a href="#" class="btn btn-danger">
                                Kelola Pelanggan
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table-striped table">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Pelanggan</th>
                                    <th>Kendaraan</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                <tr>
                                    <td><a href="#">23-09-2018</a></td>
                                    <td class="font-weight-600">Kusnadi</td>
                                    <td>Mercedes Benz</td>
                                    <td>Rp.1.200.000</td>
                                    <td>
                                        <a href="#"
                                            class="btn btn-primary">Detail</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stok Barang -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Stok</h4>
                        <div class="card-header-action">
                            <a href="#" class="btn btn-danger">
                                Kelola Stok Barang
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-invoice">
                            <table class="table-striped table">
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th class="text-center">Jumlah Stok</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                                <tr>
                                    <td><a href="#">Kode Barang</a></td>
                                    <td class="font-weight-600">Nama Barang</td>
                                    <td>Kategori Barang</td>
                                    <td class="text-center">10</td>
                                    <td>
                                        <div class="badge badge-success">Tersedia</div>
                                    </td>
                                    <td>
                                        <a href="#"
                                            class="btn btn-primary">Detail</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('library/chart.js/dist/Chart.js') }}"></script>
<script src="{{ asset('library/owl.carousel/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/index.js') }}"></script>
@endpush