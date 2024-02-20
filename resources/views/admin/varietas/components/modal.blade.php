<!-- Modal for Create and Edit -->
<div class="modal fade" id="varietasModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Update Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="varietasForm">
                    <input type="hidden" id="formVarietasId" name="id">
                    <div class="mb-3">
                        <label for="formVarietasName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="formVarietasName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="formVarietasDescription" class="form-label">Description</label>
                        <input type="text" class="form-control" id="formVarietasDescription" name="description"
                            required>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Varietas Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="createVarietasForm">
                    <div class="mb-3">
                        <label for="formCustomerName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="formCustomerName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="formCustomerDescription" class="form-label">Description</label>
                        <input type="text" class="form-control" id="formCustomerDescription" name="description"
                            required>
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
