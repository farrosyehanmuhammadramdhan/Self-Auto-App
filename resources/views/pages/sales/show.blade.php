@extends('layouts.app')

@section('title', 'Detail Penjualan')

@push('style')
@endpush

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('sales.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Detail Penjualan</h1>
            <div class="section-header-button">
                <button class="btn btn-success btn-icon icon-left" onclick="window.print()"><i class="fas fa-print"></i> Cetak Invoice</button>
            </div>
            
        </div>

        <div class="section-body">
            <div class="invoice">
                <div class="invoice-print">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            {{-- Judul dan Nomor Invoice --}}
                            <div class="invoice-title">
                                <h2>INVOICE PENJUALAN</h2>
                                <div class="invoice-number text-primary h4">{{ $sale->invoice_number }}</div>
                            </div>
                            <hr style="margin-top: 5px; margin-bottom: 30px;">
                        </div>
                    </div>

                    <div class="row">
                        {{-- Kolom Kiri: Informasi Bengkel --}}
                        <div class="col-md-6">
                            <address>
                                <strong>Informasi Bengkel</strong><br>
                                {{ $bengkelInfo['name'] ?? 'Nama Bengkel' }}<br>
                                {{ $bengkelInfo['address'] ?? 'Alamat Bengkel' }}<br>
                                Telp: {{ $bengkelInfo['phone'] ?? 'Telepon Bengkel' }}
                            </address>
                        </div>

                        {{-- Kolom Kanan: Informasi Pelanggan --}}
                        <div class="col-md-6 text-md-right">
                            <address>
                                <strong>Informasi Pelanggan</strong><br>
                                {{-- Jika customer ada, tampilkan namanya, jika tidak, tampilkan "Pembeli Part" --}}
                                @php
                                    $customerName = $sale->customer->name ?? 'Pembeli Part';
                                @endphp
                                {{ $customerName }}<br>
                                {{-- Tampilkan informasi kontak pelanggan jika ada --}}
                                @if($sale->customer)
                                    {{ $sale->customer->phone }}<br>
                                @endif
                                {{ $sale->customer->address ?? 'Alamat Pelanggan' }}
                            </address>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <address>
                                <strong>Tanggal Penjualan</strong><br>
                                {{ $sale->created_at->format('d/m/Y') }}
                            </address>
                        </div>
                    </div>
                    
                    {{-- Bagian Tabel Item Penjualan --}}
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-md">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode</th>
                                            <th>Nama Sparepart</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-right">Harga</th>
                                            <th class="text-right">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @foreach ($sale->items as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            {{-- Safe access ke relasi sparepart (penting jika sparepart_id = NULL) --}}
                                            <td>{{ $item->sparepart->code ?? 'N/A' }}</td> 
                                            <td>{{ $item->sparepart->name ?? 'Sparepart Dihapus' }}</td>
                                            <td class="text-center">{{ number_format($item->quantity, 0, ',', '.') }}</td>
                                            {{-- Tampilan Harga Satuan --}}
                                            <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                            {{-- Tampilan Subtotal --}}
                                            <td class="text-right">Rp {{ number_format($item->sub_total, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        {{-- Baris Total --}}
                                        <tr>
                                            <th colspan="5" class="text-right">Total</th>
                                            {{-- Total Keseluruhan Penjualan --}}
                                            <th class="text-right h5 text-primary">Rp {{ number_format($sale->total, 0, ',', '.') }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            
                            {{-- Catatan dan Tanda Tangan --}}
                            <div class="row">
                                <div class="col-md-6 mt-4">
                                    <address>
                                        <strong>Catatan</strong><br>
                                        Terima kasih telah berbelanja di bengkel kami.<br>
                                        Barang yang sudah dibeli tidak dapat dikembalikan.
                                    </address>
                                </div>
                                <div class="col-md-6 text-right mt-4">
                                    <address>
                                        Hormat kami,<br><br><br><br>
                                        ( _______________ )<br>
                                        Kasir
                                    </address>
                                </div>
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
{{-- Tidak ada JS spesifik yang diperlukan untuk invoice statis ini --}}
@endpush