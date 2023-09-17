<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Daftar Gaji</h1>
</div>
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Karyawan</th>
                                <th>Nama</th>
                                <th>Periode Gaji</th>
                                <th>Total Gaji</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $nomor = 1;
                            foreach ($verifikasi_gaji as $row) :
                            ?>
                                <tr>
                                    <th><?= $nomor++; ?></th>
                                    <td><?= $row->id_karyawan; ?></td>
                                    <td><?= $row->nama; ?></td>
                                    <td><?= date_indo($row->periode_awal); ?> - <?= date_indo($row->periode_akhir); ?></td>
                                    <td><?= "Rp " . number_format($row->total_gaji, 2, ",", "."); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info" title="Detail Data" onclick="detail('<?= $row->id_gaji ?>')">
                                            <i class="bi bi-eye"></i> Lihat Data
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function detail(id_gaji) {
        $.ajax({
            type: "post",
            url: "<?= base_url('verifikasi/detail_gaji') ?>",
            data: {
                id_gaji: id_gaji
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaldetailgaji').on('shown.bs.modal', function(event) {});
                    $('#modaldetailgaji').modal('show');
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>
<?= $this->endSection(); ?>