@extends('layouts.app')

@section('title', 'Edit Status Service')

@push('style')
<link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
<link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
<style>
    /* Style untuk memperjelas bahwa kolom ini tidak bisa diubah */
    .readonly-input {
        background-color: #e9ecef !important;
        cursor: not-allowed;
    }

    /* Tambahan agar input di dalam tabel terlihat rapi */
    .table td {
        vertical-align: middle !important;
    }
</style>
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('services.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Update Status & Data Service</h1>
        </div>

        <form action="{{ route('services.update', $service->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kendaraan</label>
                                <input type="text" class="form-control readonly-input" value="{{ $service->vehicle->license_plate }} - {{ $service->vehicle->brand }}" readonly>
                                <input type="hidden" name="vehicle_master_id" value="{{ $service->vehicle_master_id }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jenis Service *</label>
                                <select name="type" class="form-control selectric">
                                    @foreach(['Servis Berkala', 'Perbaikan', 'Darurat', 'Lainnya'] as $type)
                                    <option value="{{ $type }}" {{ $service->type == $type ? 'selected' : '' }}>{{ $type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="text-danger font-weight-bold">Status Pengerjaan *</label>
                                <select name="status" class="form-control selectric" required>
                                    <option value="Pending" {{ $service->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Sedang_dikerjakan" {{ $service->status == 'Sedang_dikerjakan' ? 'selected' : '' }}>Sedang Dikerjakan</option>
                                    <option value="Selesai" {{ $service->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="Dibatalkan" {{ $service->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Teknisi *</label>
                                <select name="technician_id" class="form-control select2" required>
                                    @foreach($technicians as $t)
                                    <option value="{{ $t->id }}" {{ $service->technician_id == $t->id ? 'selected' : '' }}>{{ $t->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal Service *</label>
                                <input type="date" name="service_date" class="form-control" value="{{ old('service_date', $service->service_date) }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Keluhan / Catatan</label>
                                <textarea class="form-control" name="notes" style="height: 80px">{{ $service->notes }}</textarea>
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- TABLE JASA (EDITABLE) --}}
                    <div class="d-flex justify-content-between align-items-center mt-4 mb-2">
                        <h5 class="text-muted">Detail Jasa</h5>
                        <button type="button" class="btn btn-sm btn-success" onclick="addRow('service-table')">
                            <i class="fas fa-plus mr-1"></i> Tambah Jasa
                        </button>
                    </div>
                    <table class="table table-bordered" id="service-table">
                        <thead>
                            <tr>
                                <th>Deskripsi Jasa</th>
                                <th width="200px">Biaya (Rp)*</th>
                                <th width="50px">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($service->items as $item)
                            <tr>
                                <td>
                                    <select name="service_master_ids[]" class="form-control select2">
                                        @foreach($serviceMasters as $sm)
                                        <option value="{{ $sm->id }}" {{ $item->service_master_id == $sm->id ? 'selected' : '' }}>
                                            {{ $sm->service_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="service_prices[]" class="form-control text-right" value="{{ $item->price }}">
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- TABLE SPAREPART (EDITABLE) --}}
                    <div class="d-flex justify-content-between align-items-center mt-4 mb-2">
                        <h5 class="text-muted">Sparepart</h5>
                        <button type="button" class="btn btn-sm btn-success" onclick="addRow('sparepart-table')">
                            <i class="fas fa-plus mr-1"></i> Tambah Sparepart
                        </button>
                    </div>
                    <table class="table table-bordered" id="sparepart-table">
                        <thead>
                            <tr>
                                <th class="text-center">Nama Sparepart</th>
                                <th width="150px" class="text-center">Qty</th>
                                <th width="200px" class="text-center">Harga Satuan</th>
                                <th width="200px" class="text-center">Subtotal</th>
                                <th width="50px" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($service->spareparts as $item)
                            <tr>
                                <td>
                                    <select name="sparepart_ids[]" class="form-control select2">
                                        @foreach($spareparts as $sp)
                                        <option value="{{ $sp->id }}" {{ $item->sparepart_id == $sp->id ? 'selected' : '' }}>
                                            {{ $sp->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="sparepart_qtys[]" class="form-control text-center" value="{{ $item->quantity }}">
                                </td>
                                <td>
                                    <input type="number" name="sparepart_prices[]" class="form-control text-right" value="{{ $item->price }}">
                                </td>
                                <td>
                                    <input type="number" name="sparepart_subtotals[]" class="form-control text-right" value="{{ $item->subtotal }}" readonly>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                            @empty
                            <tr class="empty-row text-center">
                                <td colspan="4" class="text-muted">Tidak ada sparepart digunakan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="row justify-content-end mt-4">
                        <div class="col-md-4 text-right">
                            <h5 class="mb-0">Total Biaya Keseluruhan</h5>
                            <h2 class="text-primary">Rp {{ number_format($service->total_price, 0, ',', '.') }}</h2>
                            <button type="submit" class="btn btn-primary btn-lg btn-block mt-3">
                                <i class="fas fa-save mr-2"></i> Update Data
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
    $(document).ready(function() {
        initSelect2();
        if ($.isFunction($.fn.selectric)) {
            $('.selectric').selectric();
        }
    });

    function initSelect2() {
        $('.select2').select2({
            width: '100%'
        });
    }

    function addRow(tableId) {
        const tableBody = document.querySelector(`#${tableId} tbody`);

        // Hapus baris kosong jika ada
        const emptyRow = tableBody.querySelector('.empty-row');
        if (emptyRow) emptyRow.remove();

        const newRow = document.createElement('tr');

        if (tableId === 'service-table') {
            newRow.innerHTML = `
                <td>
                    <select name="service_master_ids[]" class="form-control select2">
                        @foreach($serviceMasters as $sm)
                        <option value="{{ $sm->id }}">{{ $sm->service_name }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="service_prices[]" class="form-control text-right" value="0"></td>
                <td class="text-center"><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)"><i class="fas fa-trash"></i></button></td>
            `;
        } else {
            newRow.innerHTML = `
                <td>
                    <select name="sparepart_ids[]" class="form-control select2">
                        @foreach($spareparts as $sp)
                        <option value="{{ $sp->id }}">{{ $sp->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="sparepart_qtys[]" class="form-control text-center" value="1"></td>
                <td><input type="number" name="sparepart_prices[]" class="form-control text-right" value="0"></td>
                <td><input type="number" name="sparepart_subtotals[]" class="form-control text-right" value="0" readonly></td>
                <td class="text-center"><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)"><i class="fas fa-trash"></i></button></td>
            `;
        }

        tableBody.appendChild(newRow);
        initSelect2(); // Re-init Select2 untuk baris baru
    }

    function removeRow(button) {
        const row = button.closest('tr');
        const tableBody = row.parentElement;
        row.remove();

        // Tambahkan baris kosong jika semua baris dihapus (khusus sparepart)
        if (tableBody.children.length === 0) {
            const emptyTr = document.createElement('tr');
            emptyTr.className = 'empty-row text-center';
            emptyTr.innerHTML = `<td colspan="4" class="text-muted">Tidak ada data</td>`;
            tableBody.appendChild(emptyTr);
        }
    }
</script>
@endpush