@extends('layouts.app')

@section('title', 'Buat Service Baru')

@push('style')
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('services.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Tambah Service Baru</h1>
        </div>

        <form action="#" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    {{-- BARIS 1: Kendaraan (Select2) & Jenis Service (Selectric) --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Kendaraan *</label>
                                <select name="vehicle_master_id" class="form-control select2" required>
                                    <option value="" selected>-- Pilih Kendaraan --</option>
                                    @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ $vehicle->id == $service->vehicle_master_id ? 'selected' : '' }} data-id="{{ $vehicle->id }}">
                                        {{ $vehicle->license_plate }} - {{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->model_year }}) (Pemilik : {{ $vehicle->customer->name }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Service *</label>
                                <select name="type" class="form-control selectric" required>
                                    <option value="">Pilih Jenis Service</option>
                                    <option value="Servis Berkala">Service Berkala</option>
                                    <option value="Perbaikan">Perbaikan</option>
                                    <option value="Darurat">Darurat</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- BARIS 2: Teknisi (Select2) & Tanggal Service --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Jenis Service *</label>
                                <select name="type" class="form-control selectric" required>
                                    <option value="">Pilih Jenis Service</option>
                                    @foreach (['Servis Berkala', 'Perbaikan', 'Darurat', 'Lainnya'] as $type)
                                    <option value="{{ $type }}" {{ (session('type') ?? old('type')) == $type ? 'selected' : '' }}>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Service *</label>
                                <input type="date" name="service_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="notes">Keluhan</label>
                                <textarea class="form-control @error('notes') is-invalid @enderror"
                                    name="notes"
                                    data-height="150">{{ old('notes', $service->notes) }}</textarea>
                                @error('address')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="type">Status</label>
                                <select name="" id="">
                                    <option value="">Pending</option>
                                    <option value="">Sedang Dikerjakan</option>
                                    <option value="">Selesai</option>
                                    <option value="">Batal</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <h5 class="mt-4">Detail Jasa Service</h5>
                    <table class="table table-bordered" id="table-service">
                        <thead>
                            <tr>
                                <th>Deskripsi Jasa *</th>
                                <th width="250px">Biaya (Rp) *</th>
                                <th width="50px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="service_items[0][service_master_id]" class="form-control select2 select2-item select-service-master" required>
                                        <option value="" selected>-- Pilih Jasa --</option>
                                        @foreach($service_masters as $servicemaster)
                                        <option value="{{ $servicemaster->id }}" {{ $servicemaster->id == $service->service_master_id ? 'selected' : '' }} data-price="{{ $servicemaster->service_price }}">{{ $servicemaster->service_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number" name="service_items[0][price]" class="form-control service-price" required></td>
                                {{-- Tombol hapus diaktifkan (remove-row) --}}
                                <td><button type="button" class="btn btn-danger remove-row"><i class="fas fa-trash"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success btn-sm" id="add-service">+ Tambah Jasa</button>

                    <h5 class="mt-4">Sparepart (Opsional)</h5>
                    <table class="table table-bordered" id="table-sparepart">
                        <thead>
                            <tr>
                                <th>Sparepart</th>
                                <th width="150px">Qty</th>
                                <th width="200px">Harga Satuan</th>
                                <th width="200px">Subtotal</th>
                                <th width="50px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Baris ditambahkan via JS --}}
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success btn-sm" id="add-sparepart">+ Tambah Sparepart</button>

                    <hr>

                    <div class="row justify-content-end">
                        <div class="col-md-4 text-right">
                            <h5 class="mb-0">Total Pembayaran</h5>
                            <h2 class="text-primary">Rp <span id="display-grand-total">0</span></h2>
                            <input type="hidden" name="grand_total_submit" id="input-grand-total" value="0">
                            <button type="submit" class="btn btn-primary btn-lg btn-block mt-3">
                                <i class="fas fa-save mr-2"></i> Simpan Data Service
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

@push('scripts')
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/select2/dist/js/select2.full.min.js') }}"></script>

<script>
    let serviceIdx = 1;
    let sparepartIdx = 0;

    $(document).ready(function() {
        initPlugins();
    });

    function initPlugins() {
        $('.select2').select2({
            width: '100%'
        });
        $('.select2-item').select2({
            width: '100%'
        });
        if ($.isFunction($.fn.selectric)) {
            $('.selectric').selectric();
        }
    }

    // Tambah Jasa
    $('#add-service').click(function() {
        let row = `<tr>
            <td>
                <select name="service_items[${serviceIdx}][service_master_id]" class="form-control select2 select2-item select-service-master" required>
                    <option value="">-- Pilih Jasa --</option>
                    @foreach($service_masters as $servicemaster)
                        <option value="{{ $servicemaster->id }}" {{ $servicemaster->id == $service->service_master_id ? 'selected' : '' }} data-price="{{ $servicemaster->service_price }}">{{ $servicemaster->service_name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="service_items[${serviceIdx}][price]" class="form-control service-price" required></td>
            <td><button type="button" class="btn btn-danger remove-row"><i class="fas fa-trash"></i></button></td>
        </tr>`;
        $('#table-service tbody').append(row);
        $(`select[name="service_items[${serviceIdx}][service_master_id]"]`).select2({
            width: '100%'
        });
        serviceIdx++;
    });

    // Tambah Sparepart
    $('#add-sparepart').click(function() {
        let row = `<tr>
            <td>
                <select name="sparepart_items[${sparepartIdx}][sparepart_id]" class="form-control select2-item select-sp" required>
                    <option value="">-- Pilih Sparepart --</option>
                    @foreach($spareparts as $sp)
                        <option value="{{ $sp->id }}" {{ $sp->id == $service->sparepart_id ? 'selected' : '' }} data-price="{{ $sp->price_sell }}">{{ $sp->name }} (Stok: {{ $sp->stock }})</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="sparepart_items[${sparepartIdx}][quantity]" class="form-control qty-sp" value="1" min="1"></td>
            <td><input type="number" name="sparepart_items[${sparepartIdx}][price]" class="form-control price-sp" readonly></td>
            <td><input type="number" class="form-control subtotal-sp" readonly value="0"></td>
            <td><button type="button" class="btn btn-danger remove-row"><i class="fas fa-trash"></i></button></td>
        </tr>`;
        $('#table-sparepart tbody').append(row);
        $(`select[name="sparepart_items[${sparepartIdx}][sparepart_id]"]`).select2({
            width: '100%'
        });
        sparepartIdx++;
    });

    // Hapus Baris (Fleksibel)
    $(document).on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
        calculate();
    });

    // Update harga saat Jasa/Sparepart dipilih
    $(document).on('change', '.select-service-master, .select-sp', function() {
        let price = $(this).find(':selected').data('price') || 0;
        let targetClass = $(this).hasClass('select-service-master') ? '.service-price' : '.price-sp';
        $(this).closest('tr').find(targetClass).val(price);
        calculate();
    });

    $(document).on('input', '.service-price, .qty-sp', function() {
        calculate();
    });

    function calculate() {
        let total = 0;
        $('.service-price').each(function() {
            total += parseFloat($(this).val()) || 0;
        });
        $('#table-sparepart tbody tr').each(function() {
            let qty = parseFloat($(this).find('.qty-sp').val()) || 0;
            let price = parseFloat($(this).find('.price-sp').val()) || 0;
            let sub = qty * price;
            $(this).find('.subtotal-sp').val(sub);
            total += sub;
        });
        $('#display-grand-total').text(new Intl.NumberFormat('id-ID').format(total));
        $('#input-grand-total').val(total);
    }
</script>
@endpush