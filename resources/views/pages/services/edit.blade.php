@extends('layouts.app')

@section('title', 'Edit Service')

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
            <h1>Edit Service</h1>
        </div>

        <form action="{{ route('services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    {{-- BARIS 1: Kendaraan, Jenis Service, Status --}}
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kendaraan *</label>
                                <select name="vehicle_master_id" class="form-control select2" required>
                                    <option value="">-- Pilih Kendaraan --</option>
                                    @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ $service->vehicle_master_id == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->license_plate }} - {{ $vehicle->brand }} {{ $vehicle->model }} ({{ $vehicle->model_year }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jenis Service *</label>
                                <select name="type" class="form-control selectric" required>
                                    <option value="Servis Berkala" {{ $service->type == 'Servis Berkala' ? 'selected' : '' }}>Servis Berkala</option>
                                    <option value="Perbaikan" {{ $service->type == 'Perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                                    <option value="Darurat" {{ $service->type == 'Darurat' ? 'selected' : '' }}>Darurat</option>
                                    <option value="Lainnya" {{ $service->type == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status Pengerjaan *</label>
                                <select name="status" class="form-control selectric" required>
                                    <option value="Pending" {{ $service->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Sedang_dikerjakan" {{ $service->status == 'Sedang_dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                                    <option value="Selesai" {{ $service->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="Dibatalkan" {{ $service->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- BARIS 2: Teknisi & Tanggal Service --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Teknisi *</label>
                                <select name="technician_id" class="form-control select2" required>
                                    <option value="">-- Pilih Teknisi --</option>
                                    @foreach($technicians as $t)
                                    <option value="{{ $t->id }}" {{ $service->technician_id == $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Service *</label>
                                <input type="date" name="service_date" class="form-control" value="{{ old('service_date', $service->service_date ?? null) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Keluhan</label>
                                <textarea class="form-control" name="notes" data-height="100">{{ $service->notes }}</textarea>
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- TABLE JASA --}}
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
                            @foreach($service->serviceItems as $idx => $item)
                            <tr>
                                <td>
                                    <select name="service_items[{{ $idx }}][service_master_id]" class="form-control select2 select2-item select-service-master" required>
                                        <option value="">-- Pilih Jasa --</option>
                                        @foreach($service_masters as $servicemaster)
                                        <option value="{{ $servicemaster->id }}" 
                                            data-price="{{ $servicemaster->service_price }}"
                                            {{ $item->service_master_id == $servicemaster->id ? 'selected' : '' }}>
                                            {{ $servicemaster->service_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number" name="service_items[{{ $idx }}][price]" class="form-control service-price" value="{{ $item->price }}" required></td>
                                <td><button type="button" class="btn btn-danger remove-row"><i class="fas fa-trash"></i></button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success btn-sm" id="add-service">+ Tambah Jasa</button>

                    {{-- TABLE SPAREPART --}}
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
                            @foreach($service->sparepartItems as $idx => $item)
                            <tr>
                                <td>
                                    <select name="sparepart_items[{{ $idx }}][sparepart_id]" class="form-control select2-item select-sp" required>
                                        <option value="">-- Pilih Sparepart --</option>
                                        @foreach($spareparts as $sp)
                                        {{-- Kita pastikan sparepart yg sedang dipakai tetap muncul meski stok 0, atau tampilkan semua --}}
                                        <option value="{{ $sp->id }}" 
                                            data-price="{{ $sp->price_sell }}"
                                            {{ $item->sparepart_id == $sp->id ? 'selected' : '' }}>
                                            {{ $sp->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number" name="sparepart_items[{{ $idx }}][quantity]" class="form-control qty-sp" value="{{ $item->quantity }}" min="1"></td>
                                <td><input type="number" name="sparepart_items[{{ $idx }}][price]" class="form-control price-sp" value="{{ $item->price }}" readonly></td>
                                <td><input type="number" class="form-control subtotal-sp" readonly value="{{ $item->subtotal }}"></td>
                                <td><button type="button" class="btn btn-danger remove-row"><i class="fas fa-trash"></i></button></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success btn-sm" id="add-sparepart">+ Tambah Sparepart</button>

                    <hr>

                    <div class="row justify-content-end">
                        <div class="col-md-4 text-right">
                            <h5 class="mb-0">Total Pembayaran</h5>
                            <h2 class="text-primary">Rp <span id="display-grand-total">0</span></h2>
                            {{-- Input hidden tidak mandatory karena controller menghitung ulang, tapi baik untuk UI --}}
                            <button type="submit" class="btn btn-primary btn-lg btn-block mt-3">
                                <i class="fas fa-save mr-2"></i> Update Data Service
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
    // Inisialisasi index berdasarkan jumlah item yang sudah ada di database
    let serviceIdx = {{ $service->serviceItems->count() }};
    let sparepartIdx = {{ $service->sparepartItems->count() }};

    $(document).ready(function() {
        initPlugins();
        calculate(); // Hitung total saat halaman pertama kali dimuat
    });

    function initPlugins() {
        $('.select2').select2({ width: '100%' });
        $('.select2-item').select2({ width: '100%' });
        if ($.isFunction($.fn.selectric)) {
            $('.selectric').selectric();
        }
    }

    // --- LOGIKA SAMA DENGAN CREATE ---

    $('#add-service').click(function() {
        let row = `<tr>
            <td>
                <select name="service_items[${serviceIdx}][service_master_id]" class="form-control select2 select2-item select-service-master" required>
                    <option value="">-- Pilih Jasa --</option>
                    @foreach($service_masters as $servicemaster)
                        <option value="{{ $servicemaster->id }}" data-price="{{ $servicemaster->service_price }}">{{ $servicemaster->service_name }}</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="service_items[${serviceIdx}][price]" class="form-control service-price" required></td>
            <td><button type="button" class="btn btn-danger remove-row"><i class="fas fa-trash"></i></button></td>
        </tr>`;
        $('#table-service tbody').append(row);
        
        // Init Select2 untuk baris baru saja
        $(`select[name="service_items[${serviceIdx}][service_master_id]"]`).select2({ width: '100%' });
        
        serviceIdx++;
    });

    $('#add-sparepart').click(function() {
        let row = `<tr>
            <td>
                <select name="sparepart_items[${sparepartIdx}][sparepart_id]" class="form-control select2-item select-sp" required>
                    <option value="">-- Pilih Sparepart --</option>
                    @foreach($spareparts as $sp)
                        <option value="{{ $sp->id }}" data-price="{{ $sp->price_sell }}">{{ $sp->name }} (Stok: {{ $sp->stock }})</option>
                    @endforeach
                </select>
            </td>
            <td><input type="number" name="sparepart_items[${sparepartIdx}][quantity]" class="form-control qty-sp" value="1" min="1"></td>
            <td><input type="number" name="sparepart_items[${sparepartIdx}][price]" class="form-control price-sp" readonly></td>
            <td><input type="number" class="form-control subtotal-sp" readonly value="0"></td>
            <td><button type="button" class="btn btn-danger remove-row"><i class="fas fa-trash"></i></button></td>
        </tr>`;
        $('#table-sparepart tbody').append(row);

        $(`select[name="sparepart_items[${sparepartIdx}][sparepart_id]"]`).select2({ width: '100%' });

        sparepartIdx++;
    });

    $(document).on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
        calculate();
    });

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
        // Hitung Jasa
        $('.service-price').each(function() {
            total += parseFloat($(this).val()) || 0;
        });
        // Hitung Sparepart
        $('#table-sparepart tbody tr').each(function() {
            let qty = parseFloat($(this).find('.qty-sp').val()) || 0;
            let price = parseFloat($(this).find('.price-sp').val()) || 0;
            let sub = qty * price;
            $(this).find('.subtotal-sp').val(sub);
            total += sub;
        });
        
        $('#display-grand-total').text(new Intl.NumberFormat('id-ID').format(total));
    }
</script>
@endpush