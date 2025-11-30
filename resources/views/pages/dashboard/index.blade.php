@extends('layouts.app')

@section('title', 'Dashboard')

@push('style')
<style>
    .card-statistic-1 {
        min-height: 140px;
        /* ubah tinggi card */
        display: flex;
        align-items: center;
        padding: 20px;
    }

    .card-statistic-1 .card-icon {
        width: 80px;
        /* ukuran kotak icon */
        height: 80px;
        font-size: 35px;
        /* ukuran icon */
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card-statistic-1 .card-body {
        font-size: 26px;
        /* ukuran angka */
        font-weight: bold;
    }
</style>

@endpush

@section('main')
<div class="main-content">
    <section class="section">

        {{-- === BARIS 1 : Pelanggan & Kendaraan === --}}
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pelanggan</h4>
                        </div>
                        <div class="card-body">
                            43
                            <br>
                            <a href="{{ route('costumers.index') }}"><button class="btn btn-primary btn-sm mt-2">Lihat Data</button></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-motorcycle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Kendaraan</h4>
                        </div>
                        <div class="card-body">
                            35
                            <br>
                            <button class="btn btn-info btn-sm mt-2">Lihat Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- === BARIS 2 : Service & Pendapatan === --}}
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Service</h4>
                        </div>
                        <div class="card-body">
                            42
                            <br>
                            <button class="btn btn-warning btn-sm mt-2">Lihat Data</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Pendapatan Bulan Ini</h4>
                        </div>
                        <div class="card-body">
                            Rp.120.000
                            <br>
                            <button class="btn btn-success btn-sm mt-2">Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- ==== BARIS 3 : STOK SPAREPART & SERVICE TERBARU ==== --}}
        <div class="row">

            {{-- ==== STOK SPAREPART MENIPIS ==== --}}
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-exclamation-triangle text-warning"></i> Stok Sparepart Menipis</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Data di sini --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ==== SERVICE TERBARU ==== --}}
            <div class="col-lg-6 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fas fa-wrench text-primary"></i> Service Terbaru</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Pelanggan</th>
                                        <th>Kendaraan</th>
                                        <th>Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Data di sini --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </section>
</div>
@endsection