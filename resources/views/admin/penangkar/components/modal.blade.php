<!-- Modal for Create and Edit -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="customersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Penangkaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="list-group">

                            <span class="list-group-item list-group-item-action">Nama Penangkaran : <span id="Nama"
                                    class="text-primary"></span></span>
                            <span class="list-group-item list-group-item-action">Nama Ketua : <span id="Ketua"
                                    class="text-primary"></span></span>
                            <span class="list-group-item list-group-item-action">Jenis Penangkaran : <span
                                    id="Jenis" class="text-primary"></span></span>
                            <span class="list-group-item list-group-item-action">Jumlah Anggota : <span
                                    id="Jumlah_anggota" class="text-primary"></span></span>
                            <span class="list-group-item list-group-item-action">Alamat Penangkaran : <span
                                    id="Alamat" class="text-primary"></span></span>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div id="gmap" style="height: 400px; width:100%;"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
