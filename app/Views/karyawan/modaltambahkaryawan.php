<div class="modal fade" id="modaltambahkaryawan" tabindex="-1" aria-labelledby="modaltambahkaryawanLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modaltambahkaryawanLabel">Tambah Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('karyawan/simpan_karyawan') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Data Personal</h4>
                            <div class="form-group">
                                <label for="nama">Nama Karyawan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Karyawan" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Karyawan <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Email Karyawan" required>
                            </div>

                            <div class="form-group">
                                <label for="tempat_lahir">Tempat Lahir <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" required>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_lahir">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" placeholder="Tanggal Lahir" required>
                            </div>

                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" id="jenis_kelamin" name="jenis_kelamin" required>
                                    <option value="" disabled selected>-Pilih Jenis Kelamin-</option>
                                    <?php
                                    foreach ($jenis_kelamin as $row) :
                                    ?>
                                        <option value="<?= $row->id_jenis_kelamin; ?>"><?= $row->jenis_kelamin; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4>Data Perusahaan</h4>
                            <div class="form-group">
                                <label for="jabatan">Jabatan <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" id="jabatan" name="jabatan" required>
                                    <option value="" disabled selected>-Pilih Jabatan-</option>
                                    <?php
                                    foreach ($jabatan as $row) :
                                    ?>
                                        <option value="<?= $row->id_jabatan; ?>"><?= $row->jabatan; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="status">Status Karyawan <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" id="status" name="status" required>
                                    <option value="" disabled selected>-Pilih Status-</option>
                                    <?php
                                    foreach ($status as $row) :
                                    ?>
                                        <option value="<?= $row->id_status; ?>"><?= $row->status; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="gaji_pokok">Gaji Pokok <span class="text-danger">*</span></label>
                                <input type="text" class="form-control numeric" name="gaji_pokok" id="gaji_pokok" placeholder="Gaji Pokok" required>
                            </div>

                            <div class="form-group">
                                <label for="tunjangan">Tunjangan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control numeric" name="tunjangan" id="tunjangan" placeholder="Tunjangan" required>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_masuk">Tanggal Masuk <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk" placeholder="Tanggal Masuk" required>
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
<script>
    $(document).ready(function() {
        // numeric
        jQuery(function($) {
            $('input.numeric').autoNumeric('init', {
                mDec: '0',
                aSep: '.',
                aDec: ','
            });
        });
    });
</script>