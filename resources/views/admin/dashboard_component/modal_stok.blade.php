<div class="modal fade" id="update-stok" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Stok</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="updateStok">
                    <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                    <input type="hidden" name="id_varietas" id="idVarieatas">
                    <input type="hidden" name="id_kelas_benih" id="idKelasBenih">
                    <input type="hidden" name="id_penangkar" id="idPenangkar">
                    <input type="hidden" name="id_sertifikasi" id="idSertifikasi">
                    <div class="input-group">
                        <select class="form-select" id="jeniStok" name="jenis_stok">
                            <option value="tambah">Tambah Stok</option>
                            <option value="kurang">Kurangi Stok</option>
                        </select>
                        <input type="number" placeholder="Jumlah Stok" name="jumlah_stok" class="form-control">
                        <span class="input-group-text">Kg</span>
                        <button class="btn btn-outline-primary" type="button" id="saveStok">Update</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
