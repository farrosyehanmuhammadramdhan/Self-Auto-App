@extends('layouts.app')

@section('title', 'Detail Service')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('services.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Detail Service: {{ $service->service_number ?? 'N/A' }}</h1>
            <div class="section-header-breadcrumb">
                <button class="btn btn-success btn-sm mr-1"><i class="fas fa-file-export"></i> Surat Jalan</button>
                <button class="btn btn-warning btn-sm mr-1"><i class="fas fa-print"></i> Nota Jasa</button>
                <button class="btn btn-info btn-sm mr-1"><i class="fas fa-cog"></i> Nota Sparepart</button>
                <button class="btn btn-dark btn-sm"><i class="fas fa-print"></i> Cetak Semua</button>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Ringkasan Layanan</h2>
            <p class="section-lead">Informasi lengkap mengenai histori dan rincian biaya pengerjaan kendaraan.</p>

            <div class="row">
                {{-- Kartu Informasi Service --}}
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4><i class="fas fa-info-circle text-primary"></i> Informasi Pengerjaan</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm">
                                <tr>
                                    <th width="150">Tanggal Service</th>
                                    <td>: {{ \Carbon\Carbon::parse($service->service_date)->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Service</th>
                                    <td>: <span class="badge badge-primary">{{ $service->type }}</span></td>
                                </tr>
                                <tr>
                                    <th>Teknisi</th>
                                    <td>: {{ $service->technician->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>:
                                        @if($service->status == 'Selesai')
                                        <span class="badge badge-success">Selesai</span>
                                        @elseif($service->status == 'Pending')
                                        <span class="badge badge-warning">Pending</span>
                                        @elseif ($service->status == 'Sedang_dikerjakan')
                                        <span class="badge badge-info">Sedang dikerjakan</span>
                                        @else
                                        <span class="badge badge-danger">Dibatalkan</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Kartu Informasi Kendaraan --}}
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h4><i class="fas fa-car text-info"></i> Informasi Kendaraan</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm">
                                <tr>
                                    <th width="150">No. Polisi</th>
                                    <td>: <strong class="text-uppercase">{{ $service->vehicle->license_plate ?? '-' }}</strong></td>
                                </tr>
                                <tr>
                                    <th>Model Kendaraan</th>
                                    <td>: {{ $service->vehicle->brand }} {{ $service->vehicle->model }}</td>
                                </tr>
                                <tr>
                                    <th>Pemilik / Pelanggan</th>
                                    <td>: {{ $service->vehicle->customer->name ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Keluhan</th>
                                    <td>: <span class="text-muted italic">{{ $service->notes ?? 'Tidak ada catatan' }}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tabel Jasa --}}
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-tools text-success"></i> Rincian Jasa Service</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-md mb-0">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Deskripsi Jasa</th>
                                    <th class="text-right">Biaya</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($service->items as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->serviceMaster->service_name }}</td>
                                    <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center">Tidak ada detail jasa.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Tabel Sparepart --}}
            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-box text-warning"></i> Sparepart yang Digunakan</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-md mb-0">
                            <thead>
                                <tr>
                                    <th width="50">#</th>
                                    <th>Nama Sparepart</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-right">Harga Satuan</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($service->spareparts as $index => $sp)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $sp->sparepart->name }}</td>
                                    <td class="text-center">{{ $sp->quantity }}</td>
                                    <td class="text-right">Rp {{ number_format($sp->price, 0, ',', '.') }}</td>
                                    <td class="text-right">Rp {{ number_format($sp->subtotal, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Tidak ada sparepart yang digunakan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Kalkulasi Total --}}
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table mb-0">
                                <tr>
                                    <td class="font-weight-bold">Total Biaya Jasa</td>
                                    <td class="text-right">Rp {{ number_format($service->items->sum('price'), 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Total Biaya Sparepart</td>
                                    <td class="text-right">Rp {{ number_format($service->spareparts->sum('subtotal'), 0, ',', '.') }}</td>
                                </tr>
                                <tr class="bg-primary text-white">
                                    <td class="font-weight-bold" style="font-size: 1.1rem">TOTAL AKHIR</td>
                                    <td class="text-right" style="font-size: 1.1rem; font-weight: bold;">
                                        Rp {{ number_format($service->total_price, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection