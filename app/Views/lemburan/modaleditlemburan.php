<div class="modal fade" id="modaleditlemburan" tabindex="-1" aria-labelledby="modaleditlemburanLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modaleditlemburanLabel">Tambah Lemburan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('lemburan/update_lemburan') ?>/<?= $id_lembur ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-info" role="alert">
                                <h5><b>Rumusan lembur :</b></h5>
                                <p>- Upah lembur per jam status tetap dan kontrak = gaji pokok + tunjangan tetap / 173</p>
                                <p>- Upah lembur per jam status HL = gaji pokok / 173</p>
                                <p>- Jam lembur penjabaran = 4 jam pertama dikali 1, di atas 4 jam dikali 2 setelah di kurangi 4 jam pertama</p>
                                <p>- Upah lembur = upah lembur per jam * jam lembur penjabaran</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Data Karyawan</p>
                            <div class="form-group">
                                <label for="nama">Nama Karyawan <span class="text-danger">*</span></label>
                                <input type="hidden" class="form-control" name="id_karyawan" id="id_karyawan" value="<?= $id_karyawan ?>" required>
                                <input type="text" class="form-control" name="nama" id="nama" value="<?= $nama ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="status">Status Karyawan <span class="text-danger">*</span></label>
                                <input type="hidden" class="form-control" name="id_status" id="id_status" value="<?= $id_status ?>" required>
                                <input type="text" class="form-control" name="status" id="status" value="<?= $status ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="gaji_pokok">Gaji Pokok <span class="text-danger">*</span></label>
                                <input type="text" class="form-control numeric" name="gaji_pokok" id="gaji_pokok" value="<?= $gaji_pokok ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tunjangan">Tunjangan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control numeric" name="tunjangan" id="tunjangan" value="<?= $tunjangan ?>" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>Data Lemburan</p>
                            <div class="form-group">
                                <label for="jam_masuk">Jam Masuk <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" name="jam_masuk" id="jam_masuk" value="<?= $jam_masuk ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="jam_keluar">Jam Keluar <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" name="jam_keluar" id="jam_keluar" value="<?= $jam_keluar ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="lama_lembur">Lama Lembur(Jam) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="lama_lembur" id="lama_lembur" value="<?= $lama_lembur ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="uang_lembur">Uang Lembur</label>
                                <input type="text" class="form-control numeric" name="uang_lembur" id="uang_lembur" value="<?= $uang_lembur ?>" readonly>
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

    // jumlah uang lembur
    $(document).on('keyup', "#jam_keluar", function() {
        let get_gaji_pokok = $('#gaji_pokok').autoNumeric('get')
        let gaji_pokok = parseInt(get_gaji_pokok, 10)
        let get_tunjangan = $('#tunjangan').autoNumeric('get');
        let tunjangan = parseInt(get_tunjangan, 10)
        let jam_masuk = new Date($('#jam_masuk').val())
        let jam_keluar = new Date($('#jam_keluar').val())
        let lama_lembur = new Date(jam_keluar - jam_masuk)
        let jam = lama_lembur.getUTCHours()
        let penjabaran_jam = 0;
        if (jam <= 4) {
            penjabaran_jam = jam
        } else {
            penjabaran_jam = (2 * jam) - 4
        }
        let upah_lembur_jam = (gaji_pokok + tunjangan) / 173
        console.log(upah_lembur_jam)
        let upah_lembur = upah_lembur_jam * penjabaran_jam
        $('#lama_lembur').val(parseInt(jam));
        $('#uang_lembur').val(parseInt(upah_lembur));
        $('#uang_lembur').autoNumeric('set', $('#uang_lembur').val());
    });
    $(document).on('keyup', "#jam_masuk", function() {
        let get_gaji_pokok = $('#gaji_pokok').autoNumeric('get')
        let gaji_pokok = parseInt(get_gaji_pokok, 10)
        let get_tunjangan = $('#tunjangan').autoNumeric('get');
        let tunjangan = parseInt(get_tunjangan, 10)
        let jam_masuk = new Date($('#jam_masuk').val())
        let jam_keluar = new Date($('#jam_keluar').val())
        let lama_lembur = new Date(jam_keluar - jam_masuk)
        let jam = lama_lembur.getUTCHours()
        let penjabaran_jam = 0;
        if (jam <= 4) {
            penjabaran_jam = jam
        } else {
            penjabaran_jam = (2 * jam) - 4
        }
        let upah_lembur_jam = (gaji_pokok + tunjangan) / 173
        console.log(upah_lembur_jam)
        let upah_lembur = upah_lembur_jam * penjabaran_jam
        $('#lama_lembur').val(parseInt(jam));
        $('#uang_lembur').val(parseInt(upah_lembur));
        $('#uang_lembur').autoNumeric('set', $('#uang_lembur').val());
    });
</script>