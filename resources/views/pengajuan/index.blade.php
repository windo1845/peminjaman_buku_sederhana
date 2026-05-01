@extends('partials.app')

@section('content')
<div class="container-fluid">
    <h4>Pengajuan & Peminjaman Buku</h4>
    <hr>
</div>

<div class="card">
    <div class="card-body">

        <table class="table" id="pengajuanTable">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Opsi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($pengajuans as $p)
                <tr>
                    <td>{{ $p->user->name }}</td>
                    <td>{{ $p->buku->judul }}</td>
                    <td>{{ $p->tgl_pinjam }}</td>
                    <td>{{ $p->tgl_kembali }}</td>
                    <td>
                        <span class="badge 
                            @if($p->status == 'pending') bg-warning
                            @elseif($p->status == 'approved') bg-success
                            @elseif($p->status == 'rejected') bg-danger
                            @else bg-secondary
                            @endif">
                            {{ $p->status }}
                        </span>
                    </td>

                    <td>
                        @if($p->status == 'pending')
                        <button class="btn btn-success btn-sm" onclick="approve({{ $p->id }})">
                            Approve
                        </button>

                        <button class="btn btn-danger btn-sm" onclick="reject({{ $p->id }})">
                            Reject
                        </button>
                        @endif

                        @if($p->status == 'approved')
                        <button class="btn btn-primary btn-sm" onclick="returned({{ $p->id }})">
                            Buku Dikembalikan
                        </button>
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function approve(id) {
        Swal.fire({
            title: 'Yakin?',
            text: "Pengajuan akan di-approve",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, approve!',
            cancelButtonText: 'Tidak'
        }).then((result) => {

            if (result.isConfirmed) {

                fetch("{{ url('/pengajuanbuku/approve') }}/" + id, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(res => res.json())
                .then(data => {

                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Pengajuan di-approve',
                            showConfirmButton: false,
                            timer: 1200
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Stok buku tidak cukup',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }

                    setTimeout(() => location.reload(), 1200);
                });

            }

        });
    }

    function reject(id) {
        Swal.fire({
            title: 'Yakin?',
            text: "Pengajuan akan ditolak",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, tolak!',
            cancelButtonText: 'Tidak'
        }).then((result) => {

            if (result.isConfirmed) {

                fetch("{{ url('/pengajuanbuku/reject') }}/" + id, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(res => res.json())
                .then(() => {

                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Pengajuan ditolak',
                        showConfirmButton: false,
                        timer: 1200
                    });

                    setTimeout(() => location.reload(), 1200);
                });

            }

        });
    }

    function returned(id) {
        Swal.fire({
            title: 'Yakin?',
            text: "Buku akan dikembalikan",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, kembalikan!',
            cancelButtonText: 'Tidak'
        }).then((result) => {

            if (result.isConfirmed) {

                fetch("{{ url('/pengajuanbuku/returned') }}/" + id, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(res => res.json())
                .then(() => {
            
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Buku dikembalikan',
                        showConfirmButton: false,
                        timer: 1200
                    });

                    setTimeout(() => location.reload(), 1200);
                });

            }

        });
    }
</script>
@endpush
@endsection