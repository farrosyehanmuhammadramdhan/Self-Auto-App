@extends('layouts.app')

@section('title', 'Detail Pelanggan')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('customers.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Detail Pelanggan</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-primary">
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                {{-- Sidebar Kiri: Informasi Pelanggan --}}
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Informasi Pelanggan</h4>
                        </div>
                        <div class="card-body text-center">
                            <h5 class="mb-0">{{ $customer->name }}</h5>
                            <p class="text-muted">
                                <i class="fas fa-clock"></i> Pelanggan sejak {{ $customer->created_at->format('d M Y') }}
                            </p>

                            <ul class="list-group list-group-flush text-left">
                                <li class="list-group-item">
                                    <strong><i class="fas fa-phone"></i> No. HP:</strong>
                                    <span class="float-right">{{ $customer->phone ?? '-' }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong><i class="fas fa-envelope"></i> Email:</strong>
                                    <span class="float-right text-small">{{ $customer->email ?? '-' }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong><i class="fas fa-map-marker-alt"></i> Alamat:</strong> <br>
                                    <small class="text-muted">{{ $customer->address ?? '-' }}</small>
                                </li>
                            </ul>

                            <div class="mt-4">
                                {{-- Tombol aksi cepat (pastikan route sudah didefinisikan di web.php) --}}
                                <a href="{{ route('vehicle-masters.create') }}" class="btn btn-outline-primary btn-block mb-2"><i class="fas fa-motorcycle"></i> Tambah Kendaraan</a>
                                <a href="{{ route('services.create') }}" class="btn btn-outline-success btn-block mb-2"><i class="fas fa-tools"></i> Buat Service</a>
                                <a href="{{ route('sales.create') }}" class="btn btn-outline-info btn-block"><i class="fas fa-shopping-cart"></i> Buat Penjualan</a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Konten Kanan: Tabel Kendaraan & Riwayat --}}
                <div class="col-md-8">

                    {{-- Daftar Kendaraan --}}
                    <div class="card">
                        <div class="card-header bg-dark text-white d-flex justify-content-between">
                            <h4 class="text-white"><i class="fas fa-car"></i> Daftar Kendaraan</h4>
                            <a href="{{ route('vehicle-masters.create') }}" class="btn btn-sm btn-light"><i class="fas fa-plus"></i> Tambah</a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <thead>
                                        <tr>
                                            <th>No. Polisi</th>
                                            <th>Merk</th>
                                            <th>Model</th>
                                            <th>Tahun</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($customer->vehicles as $vehicle)
                                        <tr>
                                            <td><span class="badge badge-dark">{{ $vehicle->license_plate }}</span></td>
                                            <td>{{ $vehicle->brand }}</td>
                                            <td>{{ $vehicle->model }}</td>
                                            <td>{{ $vehicle->model_year }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-info btn-sm" title="Detail"><i class="fas fa-eye"></i></a>
                                                <a href="#" class="btn btn-success btn-sm" title="Service Baru"><i class="fas fa-tools"></i></a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">Tidak ada data kendaraan ditemukan.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Riwayat Service --}}
                    <div class="card mt-4">
                        <div class="card-header bg-dark text-white">
                            <h4 class="text-white"><i class="fas fa-history"></i> Riwayat Service</h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-md">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Kendaraan</th>
                                            <th>Jenis</th>
                                            <th>Biaya</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $hasService = false; @endphp
                                        @foreach($customer->vehicles as $vehicle)
                                        @foreach($vehicle->services as $service)
                                        @php $hasService = true; @endphp
                                        <tr>
                                            <td>
                                                <i class="fas fa-calendar-alt text-primary"></i>
                                                {{ \Carbon\Carbon::parse($service->service_date)->format('d/m/Y') }}
                                            </td>
                                            <td>
                                                <strong>{{ $vehicle->brand }}</strong><br>
                                                <small class="text-muted">{{ $vehicle->license_plate }}</small>
                                            </td>
                                            <td><span class="badge badge-info">{{ $service->type }}</span></td>
                                            <td>Rp {{ number_format($service->total_price, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endforeach

                                        @if(!$hasService)
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">Tidak ada riwayat service ditemukan.</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>
@endsection