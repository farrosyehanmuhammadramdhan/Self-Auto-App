@extends('layouts.app')

@section('title', 'Buat Service Baru')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('services.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Tambah Service Baru</h1>
        </div>

        <form method="POST" action="{{ route('services.store') }}">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kendaraan *</label>
                                <select name="vehicle_master_id" class="form-control select2" required>
                                    <option value="" selected disabled>-- Pilih Kendaraan --</option>
                                    @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->license_plate }} - {{ $vehicle->customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Teknisi *</label>
                                <select name="technician_id" class="form-control select2" required>
                                    <option value="">-- Pilih Teknisi --</option>
                                    @foreach($technicians as $t)
                                    <option value="{{ $t->id }}">{{ $t->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jenis Service</label>
                                <select name="type" class="form-control">
                                    <option value="">Pilih Layanan</option>
                                    <option value="service">Service Berkala</option>
                                    <option value="maintenance">Perbaikan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <h5 class="mt-4">Detail Jasa Service</h5>
                    <table class="table table-bordered" id="table-service">
                        <thead>
                            <tr>
                                <th>Deskripsi Jasa *</th>
                                <th>Biaya (Rp) *</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select name="service_items[0][service_master_id]" class="form-control" required>
                                        <option value="">-- Pilih Jasa --</option>
                                        @foreach($service_masters as $servicemaster)
                                        <option value="{{ $servicemaster->id }}" data-price="{{ $servicemaster->service_price }}">{{ $servicemaster->service_name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number" name="service_items[0][price]" class="form-control price-input service-price" value="{{ old('service_items.0.price') }}"></td>
                                <td><button type="button" class="btn btn-danger disabled"><i class="fas fa-trash"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success btn-sm" id="add-service">+ Tambah Jasa</button>

                    <h5 class="mt-4">Sparepart (Opsional)</h5>
                    <table class="table table-bordered" id="table-sparepart">
                        <thead>
                            <tr>
                                <th>Sparepart</th>
                                <th>Qty</th>
                                <th>Harga Satuan</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <button type="button" class="btn btn-success btn-sm" id="add-sparepart">+ Tambah Sparepart</button>

                    <hr>
                    <div class="row justify-content-end">
                        <div class="col-md-4 text-right">
                            <h3>Total: Rp <span id="display-grand-total">0</span></h3>
                            <input type="hidden" name="grand_total_submit" id="input-grand-total" value="0">
                            <button type="submit" class="btn btn-primary btn-lg mt-3"><i class="fas fa-floppy-disk"></i> Simpan Data Service</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

@push('scripts')
<script>
    let serviceIdx = 1;
    let sparepartIdx = 0;

    // Tambah Baris Service
    $('#add-service').click(function() {
        let row = `<tr>
            <td><select name="service_items[${serviceIdx}][service_master_id]" class="form-control">@foreach($service_masters as $servicemaster)<option value="{{ $servicemaster->id }}">{{ $servicemaster->service_name }}</option>@endforeach</select></td>
            <td><input type="number" name="service_items[${serviceIdx}][price]" class="form-control price-input service-price" value="{{ old('service_items.${serviceIdx}.price') }}"></td>
            <td><button type="button" class="btn btn-danger remove-row"><i class="fas fa-trash"></i></button></td>
        </tr>`;
        $('#table-service tbody').append(row);
        serviceIdx++;
    });

    // Tambah Baris Sparepart
    $('#add-sparepart').click(function() {
        let row = `<tr>
            <td><select name="sparepart_items[${sparepartIdx}][sparepart_id]" class="form-control select-sp">
                <option value="">-- Pilih --</option>
                @foreach($spareparts as $sp)<option value="{{ $sp->id }}" data-price="{{ $sp->price_sell }}">{{ $sp->name }}</option>@endforeach
            </select></td>
            <td><input type="number" name="sparepart_items[${sparepartIdx}][quantity]" class="form-control qty-sp" value="1"></td>
            <td><input type="number" name="sparepart_items[${sparepartIdx}][price]" class="form-control price-sp" readonly></td>
            <td><input type="number" class="form-control subtotal-sp" readonly value="0"></td>
            <td><button type="button" class="btn btn-danger remove-row"><i class="fas fa-trash"></i></button></td>
        </tr>`;
        $('#table-sparepart tbody').append(row);
        sparepartIdx++;
    });

    // Hitung Otomatis
    $(document).on('change', '.select-sp', function() {
        let price = $(this).find(':selected').data('price');
        $(this).closest('tr').find('.price-sp').val(price);
        calculate();
    });

    $(document).on('input', '.price-input, .qty-sp', function() {
        calculate();
    });

    $(document).on('click', '.remove-row', function() {
        $(this).closest('tr').remove();
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
        $('#input-grand-total').val(total);
    }
</script>
@endpush