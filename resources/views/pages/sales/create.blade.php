@extends('layouts.app')

@section('title', 'Buat Penjualan Baru')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('sales.index') }}"
                    class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Buat Penjualan Baru</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('sales.index') }}">Data Penjualan</a></div>
                <div class="breadcrumb-item">Buat Baru</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Form Transaksi Penjualan</h2>
            <p class="section-lead">Lengkapi data pelanggan dan item sparepart yang dijual.</p>

            <form method="POST" action="{{ route('sales.store') }}">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Data Umum Penjualan</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    {{-- Kolom Kiri: Invoice --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="invoice_number">Nomor Invoice <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control @error('invoice_number') is-invalid @enderror" id="invoice_number" name="invoice_number" value="{{ old('invoice_number', 'INV-' . date('Ymd') . '-' . rand(1000, 9999)) }}" required>
                                            @error('invoice_number')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- Kolom Kanan: Pelanggan --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="customer_id">Pelanggan <span class="text-danger">*</span></label>
                                            <select class="form-control select2 @error('customer_id') is-invalid @enderror" id="customer_id" name="customer_id" required>
                                                <option value="" selected disabled>-- Pilih Pelanggan --</option>
                                                {{-- Customer ID 1 diasumsikan Pelanggan Umum --}}
                                                <option value="1" {{ old('customer_id') == 1 ? 'selected' : '' }}>Pelanggan Umum (Walk-in)</option>
                                                @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                                    {{ $customer->name }} ({{ $customer->phone }})
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('customer_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="date">Tanggal <span class="text-danger">*</span></label>
                                            <input type="datetime" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', now()->format('Y-m-d H:i:s')) }}" required>
                                            @error('date')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- Bagian Item Penjualan --}}
                                <hr>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5>Item Sparepart</h5>
                                    <button type="button" class="btn btn-sm btn-success" id="add-item-btn"><i class="fas fa-plus"></i> Tambah Item</button>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped" id="sales-item-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 40%">Sparepart <span class="text-danger">*</span></th>
                                                <th style="width: 15%">Harga Jual <span class="text-danger">*</span></th>
                                                <th style="width: 15%">Qty <span class="text-danger">*</span></th>
                                                <th style="width: 20%">Subtotal</th>
                                                <th style="width: 10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {{-- Baris Item untuk data lama (old()) jika validasi gagal --}}
                                            @if(old('items'))
                                            @foreach (old('items') as $index => $oldItem)
                                            <tr>
                                                <td>
                                                    <select class="form-control item-sparepart select2-item" name="items[{{ $index }}][sparepart_id]" required data-index="{{ $index }}">
                                                        <option value="" selected>-- Pilih Sparepart --</option>
                                                        @foreach ($spareparts as $sparepart)
                                                        <option
                                                            value="{{ $sparepart->id }}"
                                                            data-price="{{ $sparepart->price_sell }}" {{-- Menggunakan Harga Jual --}}
                                                            {{ $oldItem['sparepart_id'] == $sparepart->id ? 'selected' : '' }}>
                                                            {{ $sparepart->code }} - {{ $sparepart->name }} (Stok: {{ $sparepart->stock }})
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control item-price" name="items[{{ $index }}][price]" value="{{ number_format($oldItem['price'] ?? 0, 0, ',', '.') }}" required>
                                                </td>
                                                <td>
                                                    <input type="number" min="1" class="form-control item-quantity" name="items[{{ $index }}][quantity]" value="{{ $oldItem['quantity'] ?? 1 }}" required>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control item-subtotal" value="{{ number_format($oldItem['sub_total'] ?? 0, 0, ',', '.') }}" readonly>
                                                    <input type="hidden" name="items[{{ $index }}][sub_total]" class="item-subtotal-submit" value="{{ $oldItem['sub_total'] ?? 0 }}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm remove-item-btn"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3" class="text-right"><strong>TOTAL KESELURUHAN (Rp)</strong></td>
                                                <td colspan="1">
                                                    {{-- Input tampilan Grand Total (format Rupiah) --}}
                                                    <input type="text" class="form-control font-weight-bold" id="grand-total" value="0" readonly>
                                                    {{-- Input Hidden Grand Total (nilai murni, dikirim ke Controller) --}}
                                                    <input type="hidden" name="grand_total_submit" id="grand-total-submit" value="0">
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                {{-- Tombol Submit --}}
                                <div class="text-right mt-4">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-floppy-disk"></i> Simpan Penjualan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Tentukan index awal berdasarkan jumlah baris yang ada (untuk old())
        let itemIndex = $('#sales-item-table tbody tr').length;

        // Fungsi untuk format angka ke Rupiah
        function formatRupiah(angka) {
            if (isNaN(angka) || angka === null) return '0';
            let number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return rupiah;
        }

        // Fungsi untuk membersihkan format Rupiah menjadi nilai float murni
        function cleanRupiah(angka) {
            // Menghilangkan 'Rp', pemisah ribuan (.), dan mengubah koma (,) desimal menjadi titik (.)
            return parseFloat(angka.replace(/[^0-9,]/g, '').replace(/\./g, '').replace(',', '.')) || 0;
        }

        // -------------------------------------------------------------
        // Fungsi Utama: Menghitung Subtotal dan Grand Total
        // -------------------------------------------------------------
        function updateTotal() {
            let grandTotal = 0;
            $('#sales-item-table tbody tr').each(function() {
                // Mengambil harga (dibersihkan dari format Rupiah)
                const priceString = $(this).find('.item-price').val();
                const price = cleanRupiah(priceString);

                const quantity = parseInt($(this).find('.item-quantity').val()) || 0;
                const subtotal = price * quantity;

                // Update subtotal (format Rupiah untuk tampilan)
                $(this).find('.item-subtotal').val(formatRupiah(subtotal));

                // Update subtotal hidden field (nilai murni untuk submit)
                $(this).find('.item-subtotal-submit').val(subtotal.toFixed(2));

                grandTotal += subtotal;
            });

            // Update grand total (format Rupiah untuk tampilan)
            $('#grand-total').val(formatRupiah(grandTotal));

            // PENTING: Update input hidden untuk dikirim ke controller (nilai murni)
            $('#grand-total-submit').val(grandTotal.toFixed(2));
        }

        // -------------------------------------------------------------
        // Template Baris Item Baru
        // -------------------------------------------------------------
        function getNewItemRowTemplate(index, price = 0) {
            return `
            <tr>
                <td>
                    <select class="form-control item-sparepart select2-item" name="items[${index}][sparepart_id]" required data-index="${index}">
                        <option value="" selected disabled>-- Pilih Sparepart --</option>
                        @foreach ($spareparts as $sparepart)
                            <option 
                                value="{{ $sparepart->id }}" 
                                data-price="{{ $sparepart->price_sell }}" 
                            >
                                {{ $sparepart->code }} - {{ $sparepart->name }} (Stok: {{ $sparepart->stock }})
                            </option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control item-price" name="items[${index}][price]" value="${formatRupiah(price)}" required>
                </td>
                <td>
                    <input type="number" min="1" class="form-control item-quantity" name="items[${index}][quantity]" value="1" required>
                </td>
                <td>
                    <input type="text" class="form-control item-subtotal" value="${formatRupiah(price)}" readonly>
                    <input type="hidden" name="items[${index}][sub_total]" class="item-subtotal-submit" value="${price.toFixed(2)}">
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-item-btn"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        `;
        }

        // Handler klik tombol Tambah Item
        $('#add-item-btn').on('click', function() {
            const newRow = getNewItemRowTemplate(itemIndex);
            $('#sales-item-table tbody').append(newRow);

            // Inisialisasi Select2 pada baris baru
            $(`#sales-item-table tbody tr:last-child .select2-item`).select2({
                placeholder: "-- Pilih Sparepart --",
                allowClear: true
            });

            itemIndex++;
            updateTotal();
        });

        // Handler klik tombol Hapus Item
        $(document).on('click', '.remove-item-btn', function() {
            $(this).closest('tr').remove();
            updateTotal();
        });

        // Handler ketika Sparepart dipilih (untuk mengisi Harga Jual)
        $(document).on('change', '.item-sparepart', function() {
            const selectedOption = $(this).find('option:selected');
            // Mengambil data-price (selling_price)
            const price = selectedOption.data('price') || 0;

            // Isi input harga dengan Harga Jual (format Rupiah)
            $(this).closest('tr').find('.item-price').val(formatRupiah(price));

            // Atur Quantity ke 1 secara default
            $(this).closest('tr').find('.item-quantity').val(1);

            updateTotal();
        });

        // Handler ketika Harga atau Kuantitas berubah
        $(document).on('input', '.item-price, .item-quantity', function() {
            updateTotal();
        });

        // Inisialisasi Select2 pada elemen yang sudah ada saat dimuat
        $('.select2-item').select2({
            placeholder: "-- Pilih Sparepart --",
            allowClear: true
        });

        // Jalankan updateTotal saat halaman dimuat (untuk data old() jika ada)
        updateTotal();
    });
</script>
@endpush