@extends('layouts.app')

@section('title', 'Tambah Penjualan')

@push('style')
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
                <a href="{{ route('sales.index') }}"
                    class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Tambah Penjualan</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="/dashboard">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Penjualan</a></div>
                <div class="breadcrumb-item"><a href="{{ route('sales.index') }}">Data Penjualan</a></div>
                <div class="breadcrumb-item">Tambah penjualan</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Tambah Penjualan</h2>
            <p class="section-lead">
                Tambah data penjualan sparepart baru
            </p>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        {{-- Ganti action="#" dengan route yang benar (contoh: route('sales.store')) --}}
                        <form action="{{ route('sales.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="invoice_number">Nomor Invoice *</label>
                                        <input type="text" id="invoice_number" name="invoice_number"
                                            class="form-control" value="INV-{{ time() }}" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="date">Tanggal</label>
                                        <input type="text" id="date" name="date" class="form-control"
                                            value="{{ now()->format('d-m-Y H:i') }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="customer">Pelanggan</label>
                                    <select class="form-control selectric" id="customer" name="customer_id">
                                        <option value="1" selected>-- Pelanggan Umum --</option>
                                        @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}">{{ $customer->name }} - {{$customer->phone}}</option>
                                        @endforeach
                                    </select>
                                    <div class="text-muted mt-2">Kosongkan jika pelanggan tidak terdaftar.</div>
                                </div>

                                <div class="clearfix mb-3"></div>

                                <h4>Detail Item</h4>
                                <div class="text-right mb-2">
                                    <button type="button" class="btn btn-success" id="add-item-row">
                                        <i class="fas fa-plus"></i> Tambah Item
                                    </button>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-md" id="sales-item-table">
                                        <thead>
                                            <tr>
                                                <th style="width: 30%">Sparepart</th>
                                                <th style="width: 10%">Stok</th>
                                                <th style="width: 15%">Harga (Rp)</th>
                                                <th style="width: 10%">Jumlah</th>
                                                <th style="width: 20%">Subtotal (Rp)</th>
                                                <th style="width: 10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr data-item-index="0">
                                                <td>
                                                    <select class="form-control selectric item-sparepart" name="items[0][sparepart_id]">
                                                        <option value="">Pilih Sparepart</option>
                                                        @foreach ($spareparts as $sparepart)
                                                        <option value="{{ $sparepart->id }}">{{ $sparepart->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control item-stock" value="" readonly>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control item-price" name="items[0][price]" value="" placeholder="Harga (Rp)">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control item-quantity" name="items[0][quantity]" value="1" min="1">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control item-subtotal" value="0" readonly>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm remove-item-row"><i class="fas fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" class="text-right"><strong>Total</strong></td>
                                                <td colspan="1">
                                                    <input type="text" class="form-control" id="grand-total" value="0" readonly>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan Penjualan</button>
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
<script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>
<script src="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
<script src="{{ asset('library/upload-preview/upload-preview.js') }}"></script>

<script>
    // Perbaikan: Mengganti $item menjadi $spareparts dan menggunakan 'price_buy'
    const SPAREPARTS_DATA = {!! json_encode($spareparts->keyBy('id')->map(function ($spareparts) {
        return [
            // Kolom harga sekarang adalah 'price_buy'
            'price_buy' => $spareparts->price_buy, 
            'stock' => $spareparts->stock
        ];
    })) !!};

    let itemIndex = 1;

    $(document).ready(function() {
        $('.selectric').selectric();
        updateTotal();
    });

    // Fungsi untuk menambah baris item penjualan baru
    $('#add-item-row').on('click', function() {
        const newRow = `
            <tr data-item-index="${itemIndex}">
                <td>
                    <select class="form-control selectric item-sparepart" name="items[${itemIndex}][sparepart_id]">
                        <option value="">Pilih Sparepart</option>
                        @foreach ($spareparts as $sparepart)
                        <option value="{{ $sparepart->id }}">{{ $sparepart->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input type="number" class="form-control item-stock" value="" readonly>
                </td>
                <td>
                    <input type="text" class="form-control item-price" name="items[${itemIndex}][price]" value="" placeholder="Harga (Rp)">
                </td>
                <td>
                    <input type="number" class="form-control item-quantity" name="items[${itemIndex}][quantity]" value="1" min="1">
                </td>
                <td>
                    <input type="text" class="form-control item-subtotal" value="0" readonly>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-item-row"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        `;
        $('#sales-item-table tbody').append(newRow);
        // Re-inisialisasi selectric untuk elemen baru
        $('#sales-item-table tbody tr:last-child .selectric').selectric();
        itemIndex++;
    });

    // Fungsi untuk menghapus baris item penjualan
    $(document).on('click', '.remove-item-row', function() {
        $(this).closest('tr').remove();
        updateTotal(); // Perbarui total setelah menghapus
    });

    // Fungsi untuk menghitung subtotal dan total
    function updateTotal() {
        let grandTotal = 0;
        $('#sales-item-table tbody tr').each(function() {
            // Hilangkan format rupiah untuk mendapatkan angka murni
            const price = parseFloat($(this).find('.item-price').val().replace(/[^0-9]/g, '')) || 0;
            const quantity = parseInt($(this).find('.item-quantity').val()) || 0;
            const subtotal = price * quantity;

            // Update subtotal
            $(this).find('.item-subtotal').val(formatRupiah(subtotal));

            grandTotal += subtotal;
        });

        // Update grand total
        $('#grand-total').val(formatRupiah(grandTotal));
    }

    // Fungsi helper untuk format Rupiah (Contoh Sederhana)
    function formatRupiah(angka) {
        if (!angka) return '0';
        let number_string = angka.toString(),
            sisa = number_string.length % 3,
            rupiah = number_string.substr(0, sisa),
            ribuan = number_string.substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        return rupiah;
    }

    // Event listener untuk perubahan harga atau jumlah
    $(document).on('keyup change', '.item-price, .item-quantity', function() {
        if ($(this).hasClass('item-price')) {
            let value = $(this).val().replace(/[^0-9]/g, '');
            $(this).val(formatRupiah(parseInt(value) || 0));
        }
        updateTotal();
    });

    // Fungsionalitas untuk mengisi stok dan harga berdasarkan sparepart_id yang dipilih
    $(document).on('change', '.item-sparepart', function() {
        const selectedSparepartId = $(this).val();
        const $row = $(this).closest('tr');
        
        const $stockInput = $row.find('.item-stock');
        const $priceInput = $row.find('.item-price');
        const $quantityInput = $row.find('.item-quantity');

        if (selectedSparepartId && SPAREPARTS_DATA && SPAREPARTS_DATA[selectedSparepartId]) {
            const sparepart = SPAREPARTS_DATA[selectedSparepartId];
            
            let stock = sparepart.stock;
            // Perbaikan: Menggunakan 'price_buy'
            let price = sparepart.price_buy; 
            
            $stockInput.val(stock);
            $priceInput.val(formatRupiah(price));

            $quantityInput.attr('max', stock);
            let currentQuantity = parseInt($quantityInput.val()) || 1;

            if (currentQuantity > stock) {
                $quantityInput.val(stock > 0 ? stock : 1); 
            } else if (currentQuantity < 1) {
                $quantityInput.val(1);
            }
            
        } else {
            // Kosongkan jika tidak ada sparepart yang dipilih atau data tidak ditemukan
            $stockInput.val('');
            $priceInput.val('');
            $quantityInput.val(1).removeAttr('max');
        }
        
        // Selalu perbarui total setelah perubahan
        updateTotal();
    });

    // Tambahkan event listener untuk memvalidasi/memperbarui kuantitas saat diubah
    $(document).on('change keyup', '.item-quantity', function() {
        const $input = $(this);
        let quantity = parseInt($input.val()) || 1;
        const maxStock = parseInt($input.attr('max')) || Infinity;
        
        if (quantity > maxStock) {
            $input.val(maxStock);
        } else if (quantity < 1) {
            $input.val(1);
        }
        
        updateTotal();
    });
</script>
@endpush