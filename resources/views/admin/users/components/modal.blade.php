<!-- Modal for Create and Edit -->
<div class="modal fade" id="UsersModal" tabindex="-1" aria-labelledby="UsersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">User Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="userForm">
                    <input type="hidden" id="formUserId" name="id">
                    <div class="mb-3">
                        <label for="formUserName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="formUserName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="formUserEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="formUserEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_desa" class="form-label" id="no-title">Desa/Kampung</label>
                        <select id="id_desa" name="id_desa" class="form-control">
                            <option value="">Pilih Desa</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formUserRole" class="form-label">Role</label>
                        <select class="form-control" id="formUserRole" name="role">
                            <option value="Dinas">Dinas</option>
                            <option value="BPSB">BPSB</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveUserBtn">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="create" tabindex="-1" aria-labelledby="UsersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">User Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form for Create and Edit -->
                <form id="createUserForm">
                    <div class="mb-3">
                        <label for="formUserName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="formUserName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="formUserEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="formUserEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_desa" class="form-label" id="no-title">Desa/Kampung</label>
                        <select class="form-select" id="id_desa" name="id_desa">
                            @foreach (App\Models\Desa::orderBy('name')->get() as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="formUserRole" class="form-label">Role</label>
                        <select class="form-control" id="formUserRole" name="role">
                            <option value="Dinas">Dinas</option>
                            <option value="BPSB">BPSB</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createUserBtn">Save</button>
            </div>
        </div>
    </div>
</div>
