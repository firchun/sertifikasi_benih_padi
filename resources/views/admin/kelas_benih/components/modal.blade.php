<!-- Modal for Create and Edit -->
<div class="modal fade" id="kelasBenihModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="kelasBenihForm">
                    <input type="hidden" id="formKelasBenihId" name="id">
                    <div class="mb-3">
                        <label for="formKelasBenihName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="formKelasBenihName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="formKelasBenihCode" class="form-label">Kode Kelas</label>
                        <input type="text" class="form-control" id="formKelasBenihCode" name="code" required>
                    </div>
                    <div class="mb-3">
                        <label for="formKelasBenihPrice" class="form-label">Haga Benih /Kg</label>
                        <input type="number" class="form-control" id="formKelasBenihPrice" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="formKelasBenihDescription" class="form-label">Description</label>
                        <input type="text" class="form-control" id="formKelasBenihDescription" name="description"
                            required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveKelasBenihBtn">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Kelas Benih Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="createKelasBenihForm">
                    <div class="mb-3">
                        <label for="formKelasBenihrName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="formKelasBenihrName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="formKelasBenihCode" class="form-label">Kode Kelas</label>
                        <input type="text" class="form-control" id="formKelasBenihCode" name="code" required>
                    </div>
                    <div class="mb-3">
                        <label for="formKelasBenihPrice" class="form-label">Haga Benih /Kg</label>
                        <input type="number" class="form-control" id="formKelasBenihPrice" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="formKelasBenihrDescription" class="form-label">Description</label>
                        <input type="text" class="form-control" id="formKelasBenihrDescription" name="description"
                            required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createKelasBenihBtn">Save</button>
            </div>
        </div>
    </div>
</div>
