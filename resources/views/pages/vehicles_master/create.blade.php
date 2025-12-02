@extends('layouts.app')

@section('title', 'Tambah Kendaraan Master')

@push('style')
<!-- CSS Libraries -->
<link rel="stylesheet"
    href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
<link rel="stylesheet"
    href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet"
    href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('vehicle-masters.index') }}"
                    class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Tambah Master Kendaraan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Kendaraan</a></div>
                <div class="breadcrumb-item"><a href="#">Kendaraan Master</a></div>
                <div class="breadcrumb-item"><a href="#">Semua Kendaraan Master</a></div>
                <div class="breadcrumb-item">Tambah Master Kendaraan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Buat Data Master Kendaraan Baru</h2>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Form Tambah Master Kendaraan</h4>
                        </div>
                        <form action="{{ route('vehicle-masters.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <!-- Nama Pelanggan -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah Roda</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select name="costumer_id" class="form-control selectric" required="required" name="costumer_id" id="costumer_id">
                                            <option value="0">Pilih Pelanggan</option>
                                            @foreach ($vehicle_masters as $vehicle_master)
                                                <option value="{{ $vehicle->costumer->id }}">
                                                    {{ $vehicle_master->costumer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Merk -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Merk</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="brand" required="required"
                                            class="form-control">
                                    </div>
                                </div>

                                <!-- Model -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Model</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="model" required="required"
                                            class="form-control">
                                    </div>
                                </div>

                                <!-- Tipe -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tipe Kendaraan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="type" required="required"
                                            class="form-control">
                                    </div>
                                </div>

                                <!-- Tahun Model -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tahun Kendaraan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" name="year" required="required numeric"
                                            class="form-control">
                                    </div>
                                </div>


                                <!-- Jumlah Roda -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jumlah Roda</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control selectric" required="required" name="wheel">
                                            <option value="0">Pilih Jumlah Roda</option>
                                            <option value="2">2 Roda (Motor)</option>
                                            <option value="3">3 Roda (Bajaj, dll)</option>
                                            <option value="4">4 Roda (Mobil)</option>
                                            <option value="6">6 Roda (Truk)</option>
                                            <option value="8">8 Roda</option>
                                            <option value="10">10 Roda</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Nomor Plat -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor Plat</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="plate_number" required="required"
                                            class="form-control">
                                    </div>
                                </div>

                                <!-- Warna -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Warna Kendaraan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="color" required="required"
                                            class="form-control">
                                    </div>
                                </div>

                                <!-- VIN -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor Rangka (VIN)</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="vin" required="required"
                                            class="form-control">
                                    </div>
                                </div>

                                <!-- Nomor Mesin -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nomor Mesin</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="engine_number"
                                            class="form-control">
                                    </div>
                                </div>

                                <!-- Tahun Pembelian -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tahun Pembelian</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="number" name="purchase_year" required="required numeric"
                                            class="form-control">
                                    </div>
                                </div>

                                <!-- Catatan -->
                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Catatan</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input type="text" name="notes"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="form-group row mb-4">
                                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                                    <div class="col-sm-12 col-md-7">
                                        <button class="btn btn-icon icon-left btn-primary"> <i class="fa-solid fa-floppy-disk"></i> Simpan</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<!-- JS Libraies -->
<script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
<script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>

<!-- Page Specific JS File -->
<script src="{{ asset('js/page/features-post-create.js') }}"></script>
@endpush