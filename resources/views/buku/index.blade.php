@extends('partials.app')

@section('content')
<div class="container-fluid">
    <h4>Data Buku</h4>
    <hr>
</div>

<div class="card">
    <div class="card-header">
        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#new">
             <i class="fa fa-plus"></i> Tambah Buku
        </button>
    </div>

    <div class="card-body">
        <table id="bukuTable" class="table">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Tahun</th>
                    <th>Penulis</th>
                    <th>Stok</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bukus as $buku)
                <tr>
                    <td>{{ $buku->kode }}</td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->tahun_terbit }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ $buku->stok_buku }}</td>
                    <td>
                        <button class="btn btn-primary btn-sm"
                            onclick="Edit({{ $buku->id }}, '{{ $buku->kode }}', '{{ $buku->judul }}', '{{ $buku->tahun_terbit }}', '{{ $buku->penulis }}', '{{ $buku->stok_buku }}')">
                            Edit
                        </button>

                        <button class="btn btn-danger btn-sm" onclick="Delete({{ $buku->id }})">
                            Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('buku.modal')
@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
    function Simpan() {
    fetch("{{ route('buku.store') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            kode: kode.value,
            judul: judul.value,
            tahun_terbit: tahun.value,
            penulis: penulis.value,
            stok_buku: stok.value
        })
    }).then(() => location.reload());
}

function Edit(id, kode, judul, tahun, penulis, stok) {
    edit_id.value = id;
    edit_kode.value = kode;
    edit_judul.value = judul;
    edit_tahun.value = tahun;
    edit_penulis.value = penulis;
    edit_stok.value = stok;

    new bootstrap.Modal(document.getElementById('edit')).show();
}

function Update() {
    fetch("{{ route('buku.update') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({
            id: edit_id.value,
            kode: edit_kode.value,
            judul: edit_judul.value,
            tahun_terbit: edit_tahun.value,
            penulis: edit_penulis.value,
            stok_buku: edit_stok.value
        })
    }).then(() => location.reload());
}

function Delete(id) {
    fetch("{{ route('buku.delete') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ id })
    }).then(() => location.reload());
}
</script>
@endpush
@endsection