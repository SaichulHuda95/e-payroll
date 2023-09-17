<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Daftar Lemburan</h1>
</div>
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <button type="button" class="btn btn-sm btn-primary" onclick="tambah_lemburan()">Tambah Lemburan</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Uang Lembur</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $nomor = 1;
                            foreach ($lembur as $row) :
                                $get_jam_masuk = date_create($row->jam_masuk);
                                $jam_masuk = date_format($get_jam_masuk, 'H:i');
                                $get_jam_keluar = date_create($row->jam_keluar);
                                $jam_keluar = date_format($get_jam_keluar, 'H:i');
                            ?>
                                <tr>
                                    <th><?= $nomor++; ?></th>
                                    <td><?= $row->nama; ?></td>
                                    <td><?= $jam_masuk ?></td>
                                    <td><?= $jam_keluar ?></td>
                                    <td><?= "Rp " . number_format($row->uang_lembur, 2, ",", "."); ?></td>
                                    <td><?= date_indo($row->created_date); ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" title="Edit Data" onclick="edit('<?= $row->id_lembur ?>')">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus Data" onclick="hapus('<?= $row->id_lembur ?>', '<?= $row->nama ?>')">
                                            <i class="bi bi-trash"></i>
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
    function edit(id_lembur) {
        $.ajax({
            type: "post",
            url: "<?= base_url('lemburan/edit_lemburan') ?>",
            data: {
                id_lembur: id_lembur
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaleditlemburan').on('shown.bs.modal', function(event) {
                        $('#jam_masuk').focus();
                    });
                    $('#modaleditlemburan').modal('show');
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function hapus(id_lembur, nama) {
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
                    url: "<?= base_url('lemburan/hapus_lemburan') ?>",
                    data: {
                        id_lembur: id_lembur
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