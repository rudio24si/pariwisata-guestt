@extends('layouts.guest.app')

@section('content')
    <div class="container py-5">
        <div class="card border-0 shadow-lg mb-5">
            <div class="card-header text-white py-4" style="background-color: #004d60;">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="h3 mb-0">
                            <i class="bi bi-person-circle me-2"></i>Detail Data User
                        </h1>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('user.index') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="row g-0">
                    <div class="col-md-4 bg-light p-5 text-center border-end">
                        <div class="mb-4">
                            <div class="avatar-circle mx-auto mb-3">
                                {{-- Icon User Standar --}}
                                <i class="bi bi-person text-primary" style="font-size: 5rem;"></i>
                            </div>
                            <h3 class="mb-1">{{ $user->name }}</h3>
                        </div>

                        <div class="d-grid gap-2">
                            @if($user->email)
                                <a href="mailto:{{ $user->email }}" class="btn btn-outline-success">
                                    <i class="bi bi-envelope me-2"></i> Kirim Email
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-8 p-5">
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <h5 class="text-primary mb-3 border-bottom pb-2">
                                    <i class="bi bi-card-text me-2"></i>Informasi Akun
                                </h5>
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">User ID</span>
                                        <span class="text-muted">#{{ $user->id }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">Nama Lengkap</span>
                                        <span class="text-dark">{{ $user->name }}</span>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between px-0">
                                        <span class="fw-medium">Alamat Email</span>
                                        <span class="text-dark">{{ $user->email }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 mb-4">
                                <h5 class="text-info mb-3 border-bottom pb-2">
                                    <i class="bi bi-clock-history me-2"></i>Riwayat Akun
                                </h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="card bg-light border-0">
                                            <div class="card-body">
                                                <small class="text-muted d-block">Terdaftar Pada</small>
                                                <strong>{{ $user->created_at->format('d M Y, H:i') }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="card bg-light border-0">
                                            <div class="card-body">
                                                <small class="text-muted d-block">Pembaruan Terakhir</small>
                                                <strong>{{ $user->updated_at->format('d M Y, H:i') }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer bg-light py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="text-muted small">Tipe Entitas: User System</span>
                    </div>
                    <div class="btn-group">
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash me-1"></i> Hapus User
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .avatar-circle {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            border: 4px solid white;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .card {
            border-radius: 15px;
        }

        .card-header {
            border-radius: 15px 15px 0 0 !important;
        }
    </style>
@endsection