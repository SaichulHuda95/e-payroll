<div class="modal fade" id="modaldetailgaji" tabindex="-1" aria-labelledby="modaldetailgajiLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="modaldetailgajiLabel">Detail Gaji Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col text-center">
                        <h3>PT. MAJU JAYA</h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col text-center">
                        <p>Jl. Mawar No.1 Gresik Jawa Timur</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col text-center">
                        <h5>Slip Gaji</h5>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-3">
                        Periode
                    </div>
                    <div class="col">
                        : <?= date_indo($periode_awal) ?> - <?= date_indo($periode_akhir) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        Nama Karyawan
                    </div>
                    <div class="col">
                        : <?= $nama ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        Jabatan
                    </div>
                    <div class="col">
                        : <?= $jabatan ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        Status
                    </div>
                    <div class="col">
                        : <?= $status ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <b>PENERIMAAN</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        - Gaji Pokok
                    </div>
                    <div class="col-md-6 text-right">
                        <?= number_format($gaji_pokok, 2, ",", "."); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        - Tunjangan
                    </div>
                    <div class="col-md-6 text-right">
                        <?= number_format($tunjangan, 2, ",", "."); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        - Insentif
                    </div>
                    <div class="col-md-6 text-right">
                        <?= number_format($insentif, 2, ",", "."); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        - Lembur
                    </div>
                    <div class="col-md-6 text-right">
                        <?= number_format($total_lembur, 2, ",", "."); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <b>PENGURANGAN</b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        - NWNP
                    </div>
                    <div class="col-md-6 text-right">
                        <?= number_format($pot_nwnp, 2, ",", "."); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        - BPJS
                    </div>
                    <div class="col-md-6 text-right">
                        <?= number_format($pot_bpjs, 2, ",", "."); ?>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h5>Total Gaji</h5>
                    </div>
                    <div class="col-md-6 text-right">
                        <?= number_format($total_gaji, 2, ",", "."); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger" title="Pending" onclick="pending('<?= $id_gaji ?>')">
                    Pending
                </button>
                <button type="button" class="btn btn-sm btn-success" title="Verifikasi" onclick="verifikasi('<?= $id_gaji ?>')">
                    <i class="bi bi-check2-circle"></i> Verifikasi
                </button>
            </div>
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

    function pending(id_gaji) {
        $.ajax({
            type: "post",
            url: "<?= base_url('verifikasi/pending_gaji') ?>",
            data: {
                id_gaji: id_gaji
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    Swal.fire(
                        'Berhasil',
                        response.sukses,
                        'success'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function verifikasi(id_gaji) {
        $.ajax({
            type: "post",
            url: "<?= base_url('verifikasi/verifikasi_gaji') ?>",
            data: {
                id_gaji: id_gaji
            },
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    Swal.fire(
                        'Berhasil',
                        response.sukses,
                        'success'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload();
                        }
                    });
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>