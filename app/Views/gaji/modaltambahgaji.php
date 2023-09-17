<div class="modal fade" id="modaltambahgaji" tabindex="-1" aria-labelledby="modaltambahgajiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modaltambahgajiLabel">Tambah Data Gaji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('gaji/simpan_gaji') ?>" method="POST">
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="alert alert-info" role="alert">
                                <h5><b>Perhatian!</b></h5>
                                <p>- Dimohon untuk mengecek kembali data sebelum disimpan</p>
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
                        <div class="col">
                            <div class="form-group">
                                <label for="periode_awal">Periode Gaji <span class="text-danger">*</span></label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="date" class="form-control" name="periode_awal" id="periode_awal" placeholder="Periode Awal" required>
                                    </div>
                                    <div class="col-md-1 text-center">
                                        s/d
                                    </div>
                                    <div class="col-md-3">
                                        <input type="date" class="form-control" name="periode_akhir" id="periode_akhir" placeholder="Periode Akhir" required>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="bpjs">
                                                <h5>BPJS</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="hitung_gaji">
                                            <button type="button" class="btn btn-primary hitung_gaji" onclick="hitung_gaji()">Hitung</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Data Personal Karyawan</h5>
                            <div class="form-group">
                                <label for="nama">Nama Karyawan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Karyawan" readonly>
                            </div>

                            <div class="form-group">
                                <label for="status">Status Karyawan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="status" id="status" placeholder="Status Karyawan" readonly>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_masuk">Tanggal Masuk <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal_masuk" id="tanggal_masuk" placeholder="Tanggal Masuk" readonly>
                            </div>

                            <div class="form-group">
                                <label for="masa_kerja">Masa Kerja (Tahun) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="masa_kerja" id="masa_kerja" placeholder="Masa Kerja" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5>Gaji Pokok & Tunjangan Karyawan</h5>
                            <div class="form-group">
                                <label for="gaji_pokok">Gaji Pokok Karyawan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control numeric" name="gaji_pokok" id="gaji_pokok" value="0" readonly>
                            </div>

                            <div class="form-group">
                                <label for="tunjangan">Tunjangan Karyawan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control numeric" name="tunjangan" id="tunjangan" value="0" readonly>
                            </div>

                            <div class="form-group">
                                <label for="insentif">Insentif Karyawan (Hanya Karyawan Tetap)<span class="text-danger">*</span></label>
                                <input type="text" class="form-control numeric" name="insentif" id="insentif" value="0" readonly>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h5>Lemburan</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>Jam Masuk</th>
                                        <th>Jam Keluar</th>
                                        <th>Lama Lembur</th>
                                        <th>Uang Lembur</th>
                                    </thead>
                                    <tbody id="data_lembur">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p><b>Total Bonus Lembur</b></p>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control numeric" name="total_lembur" id="total_lembur" value="0" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col">
                            <h5>NWNP (No Work No Pay)</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <th>Tanggal Ketidak Hadiran</th>
                                        <th>Keterangan</th>
                                    </thead>
                                    <tbody id="data_nwnp">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <p><b>Total Potongan NWNP</b></p>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control numeric" name="pot_nwnp" id="pot_nwnp" value="0" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <p><b>Total Potongan BPJS</b></p>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control numeric" name="pot_bpjs" id="pot_bpjs" value="0" readonly>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <h5><b>Total Gaji Karyawan</b></h5>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control numeric" name="total_gaji" id="total_gaji" value="0" readonly>
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
        let masa_kerja = ''
        $.ajax({
            type: "post",
            url: "<?= base_url('gaji/get_karyawan') ?>",
            dataType: "json",
            data: {
                id_karyawan: id_karyawan
            },
            success: function(response) {
                if (response.masa_kerja == '0') {
                    masa_kerja = '< 1'
                } else {
                    masa_kerja = response.masa_kerja
                }
                $('#nama').val(response.nama);
                $('#status').val(response.status);
                $('#tanggal_masuk').val(response.tanggal_masuk);
                $('#masa_kerja').val(masa_kerja);
                $('#gaji_pokok').val(parseInt(response.gaji_pokok));
                $('#gaji_pokok').autoNumeric('set', $('#gaji_pokok').val());
                $('#tunjangan').val(parseInt(response.tunjangan));
                $('#tunjangan').autoNumeric('set', $('#tunjangan').val());
                $('#insentif').val(parseInt(response.insentif));
                $('#insentif').autoNumeric('set', $('#insentif').val());
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // ceklist bpjs
    $("#bpjs").click(function() {
        let get_gaji_pokok = $('#gaji_pokok').autoNumeric('get')
        let gaji_pokok = parseInt(get_gaji_pokok, 10)
        let get_tunjangan = $('#tunjangan').autoNumeric('get')
        let tunjangan = parseInt(get_tunjangan, 10)
        let pot_bpjs = 0
        pot_bpjs = (gaji_pokok + tunjangan) * 0.03
        $('#pot_bpjs').val(parseInt(pot_bpjs));
        $('#pot_bpjs').autoNumeric('set', $('#pot_bpjs').val());
    });

    //Hitung gaji
    function hitung_gaji() {
        let id_karyawan = $('#id_karyawan').val()
        let periode_awal = $('#periode_awal').val()
        let periode_akhir = $('#periode_akhir').val()
        let get_gaji_pokok = $('#gaji_pokok').autoNumeric('get')
        let gaji_pokok = parseInt(get_gaji_pokok, 10)
        let get_tunjangan = $('#tunjangan').autoNumeric('get')
        let tunjangan = parseInt(get_tunjangan, 10)
        let get_insentif = $('#insentif').autoNumeric('get')
        let insentif = parseInt(get_insentif, 10)
        let get_pot_bpjs = $('#pot_bpjs').autoNumeric('get')
        let pot_bpjs = parseInt(get_pot_bpjs, 10)
        let total_gaji = 0
        $.ajax({
            type: "post",
            url: "<?= base_url('gaji/hitung_gaji') ?>",
            dataType: "json",
            data: {
                id_karyawan: id_karyawan,
                periode_awal: periode_awal,
                periode_akhir: periode_akhir,
                gaji_pokok: gaji_pokok,
            },
            beforeSend: function() {
                $('.hitung_gaji').html(`
                                <button class="btn btn-primary" type="button" disabled>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Loading...
                                </button>`)
            },
            success: function(response) {
                $('.hitung_gaji').html(`
                                    <button type="button" class="btn btn-primary hitung_gaji" onclick="hitung_gaji()">Hitung</button>`)
                let data_lembur = response.data_lembur
                let data_nwnp = response.data_nwnp
                $.each(data_lembur, function(key, value) {
                    $('#data_lembur').append("<tr>\
                    					<td>" + value.jam_masuk + "</td>\
                    					<td>" + value.jam_keluar + "</td>\
                    					<td>" + value.lama_lembur + "</td>\
                                        <td>" + value.uang_lembur + "</td>\
                    					</tr>");
                })
                $('#total_lembur').val(parseInt(response.total_lembur));
                $('#total_lembur').autoNumeric('set', $('#total_lembur').val());
                $.each(data_nwnp, function(key, value) {
                    $('#data_nwnp').append("<tr>\
                    					<td>" + value.tanggal_absen + "</td>\
                    					<td>" + value.ket + "</td>\
                    					</tr>");
                })
                $('#pot_nwnp').val(parseInt(response.pot_nwnp));
                $('#pot_nwnp').autoNumeric('set', $('#pot_nwnp').val());
                total_gaji = gaji_pokok + tunjangan + insentif + parseInt(response.total_lembur, 10) - parseInt(response.pot_nwnp, 10) - pot_bpjs
                $('#total_gaji').val(parseInt(total_gaji));
                $('#total_gaji').autoNumeric('set', $('#total_gaji').val());
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>