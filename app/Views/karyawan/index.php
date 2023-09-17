<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Daftar Karyawan</h1>
</div>
<div class="row">
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <button type="button" class="btn btn-sm btn-primary" onclick="tambah_karyawan()">Tambah Karyawan</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Id Karyawan</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Jenis Kelamin</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $nomor = 1;
                            foreach ($karyawan as $row) :
                            ?>
                                <tr>
                                    <th><?= $nomor++; ?></th>
                                    <td><?= $row->id_karyawan; ?></td>
                                    <td><?= $row->nama; ?></td>
                                    <td><?= $row->jabatan; ?></td>
                                    <td><?= $row->jenis_kelamin; ?></td>
                                    <td><?= $row->status; ?></td>
                                    <td>
                                        <a href="<?= base_url('karyawan/detail_karyawan') ?>/<?= $row->id_karyawan ?>" class="btn btn-sm btn-info" title="Detail Data">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-warning" title="Edit Data" onclick="edit('<?= $row->id_karyawan ?>')">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus Data" onclick="hapus('<?= $row->id_karyawan ?>', '<?= $row->nama ?>')">
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
    function edit(id_karyawan) {
        $.ajax({
            type: "post",
            url: "<?= base_url('karyawan/edit_karyawan') ?>",
            data: {
                id_karyawan: id_karyawan
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaleditkaryawan').on('shown.bs.modal', function(event) {
                        $('#nama').focus();
                    });
                    $('#modaleditkaryawan').modal('show');
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function hapus(id_karyawan, nama) {
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
                    url: "<?= base_url('karyawan/hapus_karyawan') ?>",
                    data: {
                        id_karyawan: id_karyawan
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