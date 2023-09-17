<div class="modal fade" id="modaltambahnwnp" tabindex="-1" aria-labelledby="modaltambahnwnpLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modaltambahnwnpLabel">Tambah NWNP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('nwnp/simpan_nwnp') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="data_karyawan">Nama Karyawan <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" id="data_karyawan" name="data_karyawan">
                                    <option value="" disabled selected>-Pilih Nama Karyawan-</option>
                                    <?php
                                    foreach ($karyawan as $row) :
                                    ?>
                                        <option value="<?= $row->id_karyawan; ?>_<?= $row->nama; ?>"><?= $row->nama; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_absen">Tanggal Ketidak Hadiran <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal_absen" id="tanggal_absen">
                            </div>
                            <div class="form-group">
                                <label for="ket">Keterangan (Alasan Tidak Hadir)</label>
                                <textarea class="form-control" id="ket" name="ket" rows="10"></textarea>
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