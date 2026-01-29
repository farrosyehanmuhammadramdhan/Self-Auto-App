@extends('layouts.app')

@section('title', 'Detail Kendaraan')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <div class="section-header-back">
                <a href="{{ route('vehicle-masters.index') }}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
            </div>
            <h1>Detail Kendaraan</h1>
            <div class="section-header-breadcrumb">
                <a href="{{ route('vehicle-masters.edit', $vehicle->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Kendaraan
                </a>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                {{-- Kiri: Informasi Kendaraan --}}
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-car"></i> Informasi Kendaraan</h4>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <h4 class="mb-0">{{ strtoupper($vehicle->brand) }} {{ strtoupper($vehicle->model) }}</h4>
                                <span class="badge badge-dark">{{ $vehicle->license_plate }}</span>
                                <p class="text-muted">{{ $vehicle->model_year }} - {{ $vehicle->type }} - {{ $vehicle->wheels }} Roda</p>
                            </div>

                            <table class="table table-sm">
                                <tr>
                                    <th width="150">Warna</th>
                                    <td><span class="badge border text-dark">{{ $vehicle->color ?? '-' }}</span></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Roda</th>
                                    <td><span class="badge badge-secondary">{{ $vehicle->wheels }} Roda</span></td>
                                </tr>
                                <tr>
                                    <th>Nomor Rangka</th>
                                    <td>{{ $vehicle->vin ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Nomor Mesin</th>
                                    <td>{{ $vehicle->engine_number ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Tahun Pembelian</th>
                                    <td>{{ $vehicle->purchase_year ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><hr></td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pendaftaran</th>
                                    <td>{{ $vehicle->created_at->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Terakhir Diperbarui</th>
                                    <td>{{ $vehicle->updated_at->format('d F Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Catatan</th>
                                    <td>{{ $vehicle->note ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Kanan: Informasi Pemilik --}}
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-user"></i> Informasi Pemilik</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-4">
                                <div class="avatar-item mr-3">
                                    <div class="badge badge-primary rounded-circle p-3">
                                        <i class="fas fa-user fa-2x"></i>
                                    </div>
                                </div>
                                <div>
                                    <h5 class="mb-0">{{ $vehicle->customer->name }}</h5>
                                    <small class="text-muted">ID: #{{ $vehicle->customer->id }}</small>
                                </div>
                            </div>

                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong><i class="fas fa-phone"></i> Telepon</strong>
                                    <a href="tel:{{ $vehicle->customer->phone }}" class="text-primary">{{ $vehicle->customer->phone }}</a>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <strong><i class="fas fa-envelope"></i> Email</strong>
                                    <span class="text-primary">{{ $vehicle->customer->email ?? '-' }}</span>
                                </li>
                                <li class="list-group-item">
                                    <strong><i class="fas fa-map-marker-alt"></i> Alamat</strong>
                                    <p class="mb-0 text-muted small">{{ $vehicle->customer->address }}</p>
                                </li>
                            </ul>
                            
                            <div class="mt-3">
                                <a href="{{ route('customers.show', $vehicle->customer_id) }}" class="btn btn-outline-primary btn-block">
                                    <i class="fas fa-user-circle"></i> Lihat Profil Pelanggan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bawah: Riwayat Service --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-dark d-flex justify-content-between">
                            <h4 class="text-white"><i class="fas fa-history"></i> Riwayat Service</h4>
                            <a href="{{ route('services.create', ['vehicle_id' => $vehicle->id]) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> Tambah Service
                            </a>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tanggal Service</th>
                                            <th>Jenis Service</th>
                                            <th>Teknisi</th>
                                            <th>Biaya</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($vehicle->services as $index => $service)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ \Carbon\Carbon::parse($service->service_date)->format('d/m/Y') }}</td>
                                            <td><span class="badge badge-info">{{ $service->type }}</span></td>
                                            <td>{{ $service->technician->name ?? '-' }}</td>
                                            <td>Rp {{ number_format($service->total_price ?? 0, 0, ',', '.') }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('services.show', $service->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                                <a href="{{ route('services.edit', $service->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada riwayat service untuk kendaraan ini.</td>
                                        </tr>
                                        @endforelse
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