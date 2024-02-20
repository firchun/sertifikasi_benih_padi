<!-- Modal for Create and Edit -->
<div class="modal fade" id="kecamatanModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="kecamatanForm">
                    <input type="hidden" id="formKecamatanId" name="id">
                    <div class="mb-3">
                        <label for="formKecamatanName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="formKecamatanName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="formKecamatanDescription" class="form-label">Description</label>
                        <input type="text" class="form-control" id="formKecamatanDescription" name="description"
                            required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveKecamatanBtn">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Kecamatan Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="createKecamatanForm">
                    <div class="mb-3">
                        <label for="formKecamatanName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="formKecamatanName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="formKecamatanDescription" class="form-label">Description</label>
                        <input type="text" class="form-control" id="formKecamatanDescription" name="description"
                            required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createKecamatanBtn">Save</button>
            </div>
        </div>
    </div>
</div>
