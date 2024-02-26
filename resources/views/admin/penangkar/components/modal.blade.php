<!-- Modal for Create and Edit -->
<div class="modal fade" id="desaModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="desaForm">
                    <input type="hidden" id="formDesaId" name="id">
                    <div class="mb-3">
                        <label for="formDesaName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="formDesaName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="formKecamatanIdKecamatan" class="form-label">Kecamatan</label>
                        <select class="form-select" id="formKecamatanIdKecamatan" name="id_kecamatan"></select>
                    </div>
                    <div class="mb-3">
                        <label for="formDesaDescription" class="form-label">Description</label>
                        <input type="text" class="form-control" id="formDesaDescription" name="description" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveDesaBtn">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Desa Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="createDesaForm">
                    <div class="mb-3">
                        <label for="formDesaName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="formDesaName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="formKecamatanIdKecamatanCreate" class="form-label">Kecamatan</label>
                        <select class="form-select" id="formKecamatanIdKecamatanCreate" name="id_kecamatan"></select>
                    </div>
                    <div class="mb-3">
                        <label for="formDesaDescription" class="form-label">Description</label>
                        <input type="text" class="form-control" id="formDesaDescription" name="description"
                            value="-" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createDesaBtn">Save</button>
            </div>
        </div>
    </div>
</div>
