<!-- Modal for Create and Edit -->
<div class="modal fade" id="varietasModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="varietasForm">
                    <input type="hidden" id="formVarietasId" name="id">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="mb-3">
                                <label for="formVarietasName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="formVarietasName" name="name"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="formVarietasDescription" class="form-label">Description</label>
                                <input type="text" class="form-control" id="formVarietasDescription"
                                    name="description" required>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="formVarietasUmur" class="form-label">Umur</label>
                                    <div class="input-group input-group-marge">
                                        <span class="input-group-text" id="basic-addon33">±</span>
                                        <input type="number" class="form-control" id="formVarietasUmur" name="umur"
                                            required>
                                        <span class="input-group-text" id="basic-addon33">Hari</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="formVarietasPotensiHasil" class="form-label">Potensi Hasil</label>
                                    <div class="input-group input-group-marge">
                                        <span class="input-group-text" id="basic-addon33">±</span>
                                        <input type="number" class="form-control" id="formVarietasPotensiHasil"
                                            name="potensi_hasil">
                                        <span class="input-group-text" id="basic-addon33">t/ha</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-7">
                            <div class="mb-3">
                                <label for="formVarietasKetahananHama" class="form-label">Ketahanan Terhadap
                                    Hama</label>
                                <textarea class="form-control" id="formVarietasKetahananHama" name="ketahanan_hama">
                                </textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formVarietasKetahananPenyakit" class="form-label">Ketahanan Terhadap
                                    Penyakit</label>
                                <textarea class="form-control" id="formVarietasKetahananPenyakit" name="ketahanan_penyakit"> </textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formVarietasKetahananAbiotik" class="form-label">Ketahanan Terhadap
                                    Abiotik</label>
                                <textarea class="form-control" id="formVarietasKetahananAbiotik" name="ketahanan_abiotik"> </textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formVarietasAnjuranTanam" class="form-label">Anjuran Penanaman</label>
                                <textarea class="form-control" id="formVarietasAnjuranTanam" name="anjuran_tanam"> </textarea>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveVarietasBtn">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Varietas Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="createVarietasForm">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="mb-3">
                                <label for="formCreateVarietasName" class="form-label">Name</label>
                                <input type="text" class="form-control" id="formCreateVarietasName"
                                    name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="formCreateVarietasDescription" class="form-label">Description</label>
                                <input type="text" class="form-control" id="formCreateVarietasDescription"
                                    name="description" required>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="formCreateVarietasUmur" class="form-label">Umur</label>
                                    <div class="input-group input-group-marge">
                                        <span class="input-group-text" id="basic-addon33">±</span>
                                        <input type="number" class="form-control" id="formCreateVarietasUmur"
                                            name="umur">
                                        <span class="input-group-text" id="basic-addon33">Hari</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="formCreateVarietasPotensiHasil" class="form-label">Potensi
                                        Hasil</label>
                                    <div class="input-group input-group-marge">
                                        <span class="input-group-text" id="basic-addon33">±</span>
                                        <input type="number" class="form-control"
                                            id="formCreateVarietasPotensiHasil" name="potensi_hasil">
                                        <span class="input-group-text" id="basic-addon33">/ha KG</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-7">
                            <div class="mb-3">
                                <label for="formCreateVarietasKetahananHama" class="form-label">Ketahanan Terhadap
                                    Hama</label>
                                <textarea class="form-control" id="formCreateVarietasKetahananHama" name="ketahanan_hama">
                                </textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formCreateVarietasKetahananPenyakit" class="form-label">Ketahanan Terhadap
                                    Penyakit</label>
                                <textarea class="form-control" id="formCreateVarietasKetahananPenyakit" name="ketahanan_penyakit"> </textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formCreateVarietasKetahananAbiotik" class="form-label">Ketahanan Terhadap
                                    Abiotik</label>
                                <textarea class="form-control" id="formCreateVarietasKetahananAbiotik" name="ketahanan_abiotik"> </textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formCreateVarietasAnjuranTanam" class="form-label">Anjuran
                                    Penanaman</label>
                                <textarea class="form-control" id="formCreateVarietasAnjuranTanam" name="anjuran_tanam"> </textarea>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createVarietasBtn">Save</button>
            </div>
        </div>
    </div>
</div>
