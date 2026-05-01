<div class="modal fade" id="new" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Tambah Buku</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="row">

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Kode Buku</label>
                        <input type="text" id="kode" class="form-control" placeholder="Kode buku" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Judul</label>
                        <input type="text" id="judul" class="form-control" placeholder="Judul buku" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Tahun Terbit</label>
                        <input type="number" id="tahun" class="form-control" placeholder="Tahun terbit" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Penulis</label>
                        <input type="text" id="penulis" class="form-control" placeholder="Nama penulis" required>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Stok Buku</label>
                        <input type="number" id="stok" class="form-control" placeholder="Jumlah stok" required>
                    </div>

                </div>
            </div>

            <div class="modal-footer d-flex justify-content-between">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-success" onclick="Simpan()">Simpan</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="delete" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <img src="/assets/img/content/info.png" width="50%">
                <hr>
                <div style="font-size:18px; color:#dd3343;">
                    <b>DELETE BUKU</b>
                </div>
                <div style="font-size:12px;">
                    Apakah kamu yakin ingin menghapus buku ini?
                </div>

                <input type="hidden" id="iddel">
            </div>

            <div class="modal-footer d-flex justify-content-between">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                <button class="btn btn-success" onclick="YakinDelete()">Yakin</button>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="edit" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Buku</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="edit_id">

                <div class="mb-3">
                    <label class="form-label">Kode Buku</label>
                    <input type="text" id="edit_kode" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" id="edit_judul" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tahun Terbit</label>
                    <input type="number" id="edit_tahun" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Penulis</label>
                    <input type="text" id="edit_penulis" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Stok Buku</label>
                    <input type="number" id="edit_stok" class="form-control">
                </div>
            </div>

            <div class="modal-footer d-flex justify-content-between">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-success" onclick="Update()">Update</button>
            </div>

        </div>
    </div>
</div>