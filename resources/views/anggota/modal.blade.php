<div class="modal fade" id="new">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Ajukan Pinjam Buku</h5>
            </div>

            <div class="modal-body">

                <label>Buku</label>
                <select id="buku_id" class="form-control mb-2">
                    @foreach($bukus as $b)
                        <option value="{{ $b->id }}">
                            {{ $b->judul }} (Stok: {{ $b->stok_buku }})
                        </option>
                    @endforeach
                </select>

                <label>Tanggal Pinjam</label>
                <input type="date" id="tgl_pinjam" class="form-control mb-2" readonly>

                <label>Tanggal Kembali</label>
                <input type="date" id="tgl_kembali" class="form-control mb-2">

            </div>

            <div class="modal-footer">
                <button class="btn btn-success" onclick="Simpan()">Pinjam</button>
            </div>

        </div>
    </div>
</div>