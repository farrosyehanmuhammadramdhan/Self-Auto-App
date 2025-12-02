@extends('layouts.app')

@section('title', 'Data Kendaraan Master')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet"
    href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Master Kendaraan</h1>
            <div class="section-header-button">
                <a href="{{ route('vehicle-masters.create') }}"
                    class="btn btn-primary">
                    <div class="medium">
                        <i class="fas fa-plus"></i>
                        Tambah
                    </div>
                </a>
            </div>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Kendaraan</a></div>
                <div class="breadcrumb-item"><a href="#">Master Kendaraan</a></div>
                <div class="breadcrumb-item">Semua Master Kendaraan</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Data Master Kendaraan</h2>

            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Daftar Kendaraan Master</h4>
                        </div>
                        <div class="card-body">
                            <div class="float-right">
                                <form>
                                    <div class="input-group">
                                        <input type="text"
                                            class="form-control"
                                            placeholder="Search">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="clearfix mb-3"></div>

                            <div class="table-responsive">
                                <table class="table-striped table">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pemilik</th>
                                        <th>Model</th>
                                        <th>Merk</th>
                                        <th>Tahun</th>
                                        <th>Tipe</th>
                                        <th>Roda</th>
                                        <th>Plat Nomor</th>
                                        <th>VIN</th>
                                        <th>No Mesin</th>
                                        <th>Warna</th>
                                        <th>Tahun Pembelian</th>
                                    </tr>
                                    @if ($vehicle_masters->count() > 0)
                                        @foreach ($vehicle_masters as $vehicle_master)
                                            <tr>
                                        <td>1</td>
                                        <td>
                                            {{ $vehicle_master->costumer->name }}
                                            <div class="table-links">
                                                <a href="#">Edit</a>
                                                <div class="bullet"></div>
                                                <a href="#" class="text-danger">Trash</a>
                                            </div>
                                        </td>
                                        <td>{{ $vehicle_master->model }}</td>
                                        <td>{{ $vehicle_master->brand }}</td>
                                        <td>{{ $vehicle_master->year }}</td>
                                        <td>{{ $vehicle_master->type }}</td>
                                        <td>{{ $vehicle_master->wheels }}</td>
                                        <td>{{ $vehicle_master->license_plate }}</td>
                                        <td>{{ $vehicle_master->vin }}</td>
                                        <td>{{ $vehicle_master->engine_number }}</td>
                                        <td>{{ $vehicle_master->color }}</td>
                                        <td>{{ $vehicle_master->purchase_year }}</td>
                                    </tr>
                                        @endforeach
                                        @else
                                    <tr>
                                        <td colspan="12" class="text-center">Tidak ada data</td>
                                    </tr>
                                    @endif
                                    
                                </table>
                            </div>
                            <div class="float-right">
                                <nav>
                                    {{ $vehicle_masters->links() }}
                                </nav>
                            </div>
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
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush