@extends('layouts.app')

@section('title', 'Self Auto Dashboard')

@push('style')
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
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pelanggan</h4>
                        </div>
                        <div class="card-body">
                            {{ $customers }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fa-solid fa-motorcycle" style="color: #ffffff;"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Kendaraan</h4>
                        </div>
                        <div class="card-body">
                            {{ $vehicles }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
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

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fa-solid fa-money-bill" style="color: #ffffff;"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pendapatan Bulan Ini</h4>
                        </div>
                        <div class="card-body">
                            Rp.187.000
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Stok Spareparts Menipis</h4>
                        <div class="card-header-action">
                            <a href="{{ route('spareparts.index') }}" class="btn btn-danger">
                                Kelola Spareparts
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
                                    <th class="text-center">Stok</th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td><a href="#">Kode Barang</a></td>
                                    <td class="font-weight-600">Nama Barang</td>
                                    <td>Kategori Barang</td>
                                    <td class="text-center">10</td>
                                    <td>
                                        <a href="#"
                                            class="btn btn-primary"><i class="fas fa-pen-to-square"></i></a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Service Terbaru</h4>
                        <div class="card-header-action">
                            <a href="#" class="btn btn-danger">
                                Kelola Service
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
                                    <th></th>
                                </tr>
                                <tr>
                                    <td><a href="#">23-09-2018</a></td>
                                    <td class="font-weight-600">Kusnadi</td>
                                    <td>Mercedes Benz</td>
                                    <td>Rp.1.200.000</td>
                                    <td>
                                        <a href="#"
                                            class="btn btn-primary"><i class="fas fa-eye"></i></a>
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
<script src="{{ asset('library/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('library/chart.js/dist/Chart.js') }}"></script>
<script src="{{ asset('library/owl.carousel/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

<script src="{{ asset('js/page/index.js') }}"></script>
@endpush