<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Daftar Gaji</h1>
</div>
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <button type="button" class="btn btn-sm btn-primary" onclick="tambah_gaji()">Tambah Data Gaji</button>
            </div>
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
                                <th>Status Pengesahan</th>
                                <th>Verifikator</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $nomor = 1;
                            foreach ($gaji as $row) :
                            ?>
                                <tr>
                                    <th><?= $nomor++; ?></th>
                                    <td><?= $row->id_karyawan; ?></td>
                                    <td><?= $row->nama; ?></td>
                                    <td><?= date_indo($row->periode_awal); ?> - <?= date_indo($row->periode_akhir); ?></td>
                                    <td><?= "Rp " . number_format($row->total_gaji, 2, ",", "."); ?></td>
                                    <?php
                                    if ($row->status_gaji == '0') {
                                        echo "<td class='text-info'>Menunggu Verifikasi</td>";
                                    } else if ($row->status_gaji == '1') {
                                        echo "<td class='text-success'>Terverifikasi</td>";
                                    } else {
                                        echo "<td class='text-danger'>Pending</td>";
                                    }
                                    ?>
                                    <td><?= $row->verifikator; ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info" title="Detail Data" onclick="detail('<?= $row->id_gaji ?>')">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus Data" onclick="hapus('<?= $row->id_gaji ?>', '<?= $row->nama ?>')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <?php
                                        if ($row->status_gaji == '1') : ?>
                                            <a href="<?= base_url('gaji/cetak_gaji') ?>/<?= $row->id_gaji ?>" class="btn btn-sm btn-success" title="Cetak Data" target="_blank">
                                                <i class="bi bi-printer"></i> Cetak
                                            </a>
                                        <?php endif ?>
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
            url: "<?= base_url('gaji/detail_gaji') ?>",
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

    function hapus(id_gaji, nama) {
        Swal.fire({
            title: 'Hapus Data',
            html: `Yakin ingin menghapus data <strong>${nama}</strong>?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('gaji/hapus_gaji') ?>",
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
        })
    }
</script>
<?= $this->endSection(); ?>