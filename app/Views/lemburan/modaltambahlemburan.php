<div class="modal fade" id="modaltambahlemburan" tabindex="-1" aria-labelledby="modaltambahlemburanLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modaltambahlemburanLabel">Tambah Lemburan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('lemburan/simpan_lemburan') ?>" method="POST">
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
                        <div class="col">
                            <div class="form-group">
                                <label for="id_karyawan">Silahkan Pilih Karyawan Terlebih Dahulu <span class="text-danger">*</span></label>
                                <select class="form-control form-control-sm" id="id_karyawan" name="id_karyawan" onchange="get_karyawan()">
                                    <option value="" disabled selected>-Pilih Nama Karyawan-</option>
                                    <?php
                                    foreach ($karyawan as $row) :
                                    ?>
                                        <option value="<?= $row->id_karyawan; ?>"><?= $row->nama; ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p>Data Karyawan</p>
                            <div class="form-group">
                                <label for="nama">Nama Karyawan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama" id="nama" readonly>
                            </div>
                            <div class="form-group">
                                <label for="status">Status Karyawan <span class="text-danger">*</span></label>
                                <input type="hidden" class="form-control" name="id_status" id="id_status" required>
                                <input type="text" class="form-control" name="status" id="status" readonly>
                            </div>
                            <div class="form-group">
                                <label for="gaji_pokok">Gaji Pokok <span class="text-danger">*</span></label>
                                <input type="text" class="form-control numeric" name="gaji_pokok" id="gaji_pokok" value="0" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tunjangan">Tunjangan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control numeric" name="tunjangan" id="tunjangan" value="0" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <p>Data Lemburan</p>
                            <div class="form-group">
                                <label for="jam_masuk">Jam Masuk <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" name="jam_masuk" id="jam_masuk" required>
                            </div>
                            <div class="form-group">
                                <label for="jam_keluar">Jam Keluar <span class="text-danger">*</span></label>
                                <input type="datetime-local" class="form-control" name="jam_keluar" id="jam_keluar" required>
                            </div>
                            <div class="form-group">
                                <label for="lama_lembur">Lama Lembur(Jam) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="lama_lembur" id="lama_lembur" value="0" readonly>
                            </div>
                            <div class="form-group">
                                <label for="uang_lembur">Uang Lembur</label>
                                <input type="text" class="form-control numeric" name="uang_lembur" id="uang_lembur" value="0" readonly>
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

    //ambil data karyawan
    function get_karyawan() {
        let id_karyawan = $('#id_karyawan').val()
        $.ajax({
            type: "post",
            url: "<?= base_url('lemburan/get_karyawan') ?>",
            dataType: "json",
            data: {
                id_karyawan: id_karyawan
            },
            success: function(response) {
                $('#nama').val(response.nama);
                $('#id_status').val(response.id_status);
                $('#status').val(response.status);
                $('#gaji_pokok').val(parseInt(response.gaji_pokok));
                $('#gaji_pokok').autoNumeric('set', $('#gaji_pokok').val());
                $('#tunjangan').val(parseInt(response.tunjangan));
                $('#tunjangan').autoNumeric('set', $('#tunjangan').val());
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

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
        let upah_lembur = upah_lembur_jam * penjabaran_jam
        $('#lama_lembur').val(parseInt(jam));
        $('#uang_lembur').val(parseInt(upah_lembur));
        $('#uang_lembur').autoNumeric('set', $('#uang_lembur').val());
    });
</script>