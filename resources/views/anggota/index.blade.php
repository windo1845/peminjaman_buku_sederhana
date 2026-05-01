@extends('partials.app')

@section('content')

<div class="container-fluid">
    <h4>Pinjam Buku</h4>
    <hr>
</div>

<div class="card mb-3">
    <div class="card-header">
        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#new">
            + Ajukan Pinjam
        </button>
    </div>

    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach($pengajuans as $p)
                <tr>
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('anggota.modal')
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let today = new Date().toISOString().split('T')[0];
        document.getElementById('tgl_pinjam').value = today;
    });

    function Simpan() {
        fetch("{{ route('pinjam.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                buku_id: buku_id.value,
                tgl_pinjam: tgl_pinjam.value,
                tgl_kembali: tgl_kembali.value
            })
        })
        .then(res => res.json())
        .then(data => {

            if (data.success) {

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Pengajuan pinjaman berhasil dikirim',
                    timer: 2000,
                    showConfirmButton: false
                });
                
                let modalEl = document.getElementById('new');
                let modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();
                
                buku_id.value = "";
                tgl_kembali.value = "";

                setTimeout(() => {
                    location.reload();
                }, 2000);

            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: data.message ?? 'Terjadi kesalahan'
                });

            }
        })
        .catch(() => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Server tidak merespon'
            });
        });
    }
</script>
@endpush
@endsection