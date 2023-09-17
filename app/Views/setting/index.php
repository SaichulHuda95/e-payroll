<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Pengaturan</h1>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Pengaturan Aplikasi</code></h4>
            </div>
            <div class="card-body">
                <ul class="nav nav-pills" id="myTab3" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="jabatan-tab3" data-toggle="tab" href="#jabatan" role="tab" aria-controls="jabatan" aria-selected="true">Jabatan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="status-tab3" data-toggle="tab" href="#status" role="tab" aria-controls="status" aria-selected="false">Status Karyawan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="user-tab3" data-toggle="tab" href="#user" role="tab" aria-controls="user" aria-selected="false">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="role-tab3" data-toggle="tab" href="#role" role="tab" aria-controls="role" aria-selected="false">Hak Akses User</a>
                    </li>
                </ul>
                <hr>
                <div class="tab-content" id="myTabContent2">
                    <div class="tab-pane fade show active" id="jabatan" role="tabpanel" aria-labelledby="jabatan-tab3">
                        <div class="row mb-3">
                            <div class="col">
                                <button type="button" class="btn btn-sm btn-primary" onclick="tambah_jabatan()">Tambah</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="display table table-sm table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Jabatan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $nomor = 1;
                                            foreach ($jabatan as $row) :
                                            ?>
                                                <tr>
                                                    <th><?= $nomor++; ?></th>
                                                    <td><?= $row->jabatan; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-info" title="Edit Data" onclick="edit_jabatan('<?= $row->id_jabatan ?>')">
                                                            <i class="fa fa-pencil-alt"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus Data" onclick="hapus_jabatan('<?= $row->id_jabatan ?>', '<?= $row->jabatan ?>')">
                                                            <i class="fa fa-trash-alt"></i>
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
                    <div class="tab-pane fade" id="status" role="tabpanel" aria-labelledby="status-tab3">
                        <div class="row mb-3">
                            <div class="col">
                                <button type="button" class="btn btn-sm btn-primary" onclick="tambah_status()">Tambah</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="display table table-sm table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Status Karyawan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $nomor = 1;
                                            foreach ($status as $row) :
                                            ?>
                                                <tr>
                                                    <th><?= $nomor++; ?></th>
                                                    <td><?= $row->status; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-info" title="Edit Data" onclick="edit_status('<?= $row->id_status ?>')">
                                                            <i class="fa fa-pencil-alt"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus Data" onclick="hapus_status('<?= $row->id_status ?>', '<?= $row->status ?>')">
                                                            <i class="fa fa-trash-alt"></i>
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
                    <div class="tab-pane fade" id="user" role="tabpanel" aria-labelledby="user-tab3">
                        <div class="row mb-3">
                            <div class="col">
                                <a class="btn btn-sm btn-primary" href="<?= base_url(); ?>/pengaturan/add_user">
                                    Tambah User
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="display table table-sm table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Role Id</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $nomor = 1;
                                            foreach ($user as $row) :
                                            ?>
                                                <tr>
                                                    <th><?= $nomor++; ?></th>
                                                    <td>
                                                        <img id="img" width="30" class="rounded-circle mr-2" src="<?= base_url(); ?>/assets/img/profil/<?= $row->image; ?>" alt="" />
                                                        <?= $row->username; ?>
                                                    </td>
                                                    <td><?= $row->email; ?></td>
                                                    <td><span class="badge badge-dark"><?= $row->role; ?></span></td>
                                                    <?php
                                                    if ($row->is_active == 1) {
                                                        echo "<td class='text-center'><span class='badge badge-success'>Aktif</span></td>";
                                                    } else {
                                                        echo "<td class='text-center'><span class='badge badge-danger'>Tidak Aktif</span></td>";
                                                    }
                                                    ?>
                                                    <td>
                                                        <a class="btn btn-sm btn-info" title="Edit Data" href="<?= base_url(); ?>/pengaturan/edit_user/<?= $row->id ?>">
                                                            <i class="fa fa-pencil-alt"></i>
                                                        </a>
                                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus Data" onclick="hapus_user('<?= $row->id ?>', '<?= $row->username ?>')">
                                                            <i class="fa fa-trash-alt"></i>
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
                    <div class="tab-pane fade" id="role" role="tabpanel" aria-labelledby="role-tab3">
                        <div class="row mb-3">
                            <div class="col">
                                <button type="button" class="btn btn-sm btn-primary" onclick="tambah_role()">Tambah</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="table-responsive">
                                    <table class="display table table-sm table-hover">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Hak Akses</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $nomor = 1;
                                            foreach ($role as $row) :
                                            ?>
                                                <tr>
                                                    <th><?= $nomor++; ?></th>
                                                    <td><?= $row->role; ?></td>
                                                    <td>
                                                        <a href="<?= base_url(); ?>/pengaturan/roleaccess/<?= $row->id; ?>" class="btn btn-sm btn-warning">Akses</a>
                                                        <button type="button" class="btn btn-sm btn-info" title="Edit Data" onclick="edit_role('<?= $row->id ?>')">
                                                            <i class="fa fa-pencil-alt"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus Data" onclick="hapus_role('<?= $row->id ?>', '<?= $row->role ?>')">
                                                            <i class="fa fa-trash-alt"></i>
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
            </div>
        </div>
    </div>
</div>
<script>
    // edit jabatan
    function edit_jabatan(id_jabatan) {
        $.ajax({
            type: "post",
            url: "<?= base_url('pengaturan/edit_jabatan') ?>",
            data: {
                id_jabatan: id_jabatan
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaleditjabatan').on('shown.bs.modal', function(event) {});
                    $('#modaleditjabatan').modal('show');
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // hapus jabatan
    function hapus_jabatan(id_jabatan, nama) {
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
                    url: "<?= base_url('pengaturan/hapus_jabatan') ?>",
                    data: {
                        id_jabatan: id_jabatan
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

    // edit status
    function edit_status(id_status) {
        $.ajax({
            type: "post",
            url: "<?= base_url('pengaturan/edit_status') ?>",
            data: {
                id_status: id_status
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaleditstatus').on('shown.bs.modal', function(event) {});
                    $('#modaleditstatus').modal('show');
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // hapus status
    function hapus_status(id_status, nama) {
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
                    url: "<?= base_url('pengaturan/hapus_status') ?>",
                    data: {
                        id_status: id_status
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

    // hapus user
    function hapus_user(id, nama) {
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
                    url: "<?= base_url('pengaturan/hapus_user') ?>",
                    data: {
                        id: id
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

    // edit role
    function edit_role(id) {
        $.ajax({
            type: "post",
            url: "<?= base_url('pengaturan/edit_role') ?>",
            data: {
                id: id
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.viewmodal').html(response.data).show();
                    $('#modaleditrole').on('shown.bs.modal', function(event) {
                        $('#nama_objek').focus();
                    });
                    $('#modaleditrole').modal('show');
                }
            },
            error: function(xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // hapus role
    function hapus_role(id, nama) {
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
                    url: "<?= base_url('pengaturan/hapus_role') ?>",
                    data: {
                        id: id
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