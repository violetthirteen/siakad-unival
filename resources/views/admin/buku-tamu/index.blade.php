@extends('layouts.admin')
@section('title', 'Buku Tamu - Admin - SIAKAD Unival')

@section('content')
<div class="page-header">
    <div>
        <h1>Buku Tamu</h1>
        <p>Daftar pesan dari pengunjung website</p>
    </div>
</div>

@if(session('success'))
<div class="alert-modern alert-success">
    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" onclick="this.parentElement.remove()">&times;</button>
</div>
@endif

<div class="card-modern">
    <div class="card-modern-body p-0">
        <div class="table-responsive">
            <table class="table-modern">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bukuTamu as $b)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $b->nama }}</strong></td>
                        <td>{{ $b->email ?? '-' }}</td>
                        <td>{{ $b->no_hp ?? '-' }}</td>
                        <td>{{ Str::limit($b->pesan, 50) }}</td>
                        <td>{{ $b->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.buku-tamu.destroy', $b) }}" onsubmit="return confirm('Yakin hapus pesan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-modern btn-danger btn-sm"><i class="bi bi-trash3"></i> Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-state-icon"><i class="bi bi-chat-square-slash"></i></div>
                                <h5>Belum Ada Pesan</h5>
                                <p>Belum ada pesan dari pengunjung.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
