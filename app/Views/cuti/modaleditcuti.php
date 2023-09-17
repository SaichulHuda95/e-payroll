<div class="modal fade" id="modaleditcuti" tabindex="-1" aria-labelledby="modaleditcutiLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modaleditcutiLabel">Edit Cuti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('cuti/update_cuti') ?>/<?= $id_cuti; ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="nama">Nama Karyawan <span class="text-danger">*</span></label>
                                <input type="hidden" class="form-control" name="id_karyawan" id="id_karyawan" value="<?= $id_karyawan; ?>" readonly>
                                <input type="text" class="form-control" name="nama" id="nama" value="<?= $nama; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_cuti">Tanggal Ketidak Hadiran <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal_cuti" id="tanggal_cuti" value="<?= $tanggal_cuti; ?>">
                            </div>
                            <div class="form-group">
                                <label for="ket">Keterangan (Alasan Tidak Hadir)</label>
                                <textarea class="form-control" id="ket" name="ket" rows="10"><?= $ket; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>