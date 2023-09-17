<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Daftar NWNP</h1>
</div>
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <button type="button" class="btn btn-sm btn-primary" onclick="tambah_nwnp()">Tambah NWNP</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Tanggal Ketidak Hadiran</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $nomor = 1;
                            foreach ($nwnp as $row) :
                            ?>
                                <tr>
                                    <th><?= $nomor++; ?></th>
                                    <td><?= $row->nama; ?></td>
                                    <td><?= date_indo($row->tanggal_absen); ?></td>
                                    <td><?= $row->ket ?></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" title="Edit Data" onclick="edit('<?= $row->id_nwnp ?>')">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus Data" onclick="hapus('<?= $row->id_nwnp ?>', '<?= $row->nama ?>')">
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
    function edit(id_nwnp) {
        $.ajax({
            type: "post",
            url: "<?= base_url('nwnp/edit_nwnp') ?>",
            data: {
                id_nwnp: id_nwnp
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaleditnwnp').on('shown.bs.modal', function(event) {
                        $('#jam_masuk').focus();
                    });
                    $('#modaleditnwnp').modal('show');
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function hapus(id_nwnp, nama) {
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
                    url: "<?= base_url('nwnp/hapus_nwnp') ?>",
                    data: {
                        id_nwnp: id_nwnp
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