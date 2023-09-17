<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?= $title ?></title>
    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>/assets/img/logo2.png">
    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/fontawesome/css/all.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/bootstrap-icons/bootstrap-icons.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/components.css">
    <!-- SweetAlert -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.min.css">
    <!-- Jquery -->
    <script src="<?= base_url() ?>/assets/plugins/jquery/jquery.min.js"></script>
    <!-- data tables -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/DataTables/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/assets/plugins/DataTables/css/buttons.bootstrap4.min.css">
    <!-- custom css -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/mycustom.css">
</head>

<body>
    <div id="app">

        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="<?= base_url() ?>/assets/img/profil/<?= $session->image ?>" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, <?= $session->username ?></div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="<?= base_url() ?>/profil" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profil
                            </a>
                            <?php
                            if ($session->role_id == '1') {
                                echo "<a href='" . base_url() . "/pengaturan' class='dropdown-item has-icon'>
                                <i class='fas fa-cog'></i> Pengaturan Aplikasi
                            </a>";
                            }
                            ?>
                            <div class="dropdown-divider"></div>
                            <a href="<?= base_url() ?>/auth/logout" class="dropdown-item has-icon text-danger logout">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <img alt="image" src="<?= base_url() ?>/assets/img/logo2.png" class="rounded-circle mr-1" style="max-width: 20px;">
                        <a href="#"><b>E-PAYROLL</b></a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="#"><b>E-PAY</b></a>
                    </div>
                    <ul class="sidebar-menu" id="myDIV">
                        <?php
                        //query menu
                        $db      = \Config\Database::connect();
                        $role_id = $session->role_id;
                        $builder = $db->table('user_menu');
                        $builder->select('user_menu.id, menu');
                        $builder->join('user_access_menu', 'user_menu.id=user_access_menu.menu_id');
                        $builder->where(['user_access_menu.role_id' => $role_id]);
                        $menu = $builder->get()->getResultArray();

                        //menu
                        foreach ($menu as $m) {
                            echo '<li class="menu-header">
                                    ' . $m['menu'] . '
                                </li>';
                            //query submenu
                            $db      = \Config\Database::connect();
                            $menuId = $m['id'];
                            $builder = $db->table('user_sub_menu');
                            // $builder->select('user_sub_menu');
                            $builder->where(['menu_id' => $menuId]);
                            $builder->where(['is_active' => 1]);
                            $subMenu = $builder->get()->getResultArray();
                            //submenu
                            foreach ($subMenu as $sm) {
                                if ($title == $sm['title']) {
                                    echo '<li class="active">
                                            <a class="nav-link" href="' . base_url($sm['url']) . '">';
                                } else {
                                    echo '<li>
                                            <a class="nav-link" href="' . base_url($sm['url']) . '">';
                                }
                                echo '<i class="' . $sm['icon'] . '"></i>';
                                echo '<span>' . $sm['title'] . '</span></a>';
                            }
                        }
                        ?>
                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <div id="flash" data-flash="<?= session()->getFlashdata('success'); ?>"></div>
                <div id="flashfail" data-flash="<?= session()->getFlashdata('fail'); ?>"></div>
                <section class="section">
                    <?= $this->renderSection('content-page'); ?>
                </section>

                <!-- modal -->
                <div class="viewmodal"></div>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    <strong>Copyright &copy; <a href="https://saichulhuda95.github.io/">SAICHUL HUDA</a>.</strong> All rights
                    reserved.
                </div>
                <div class="footer-right">
                    <b>Version</b> 1.0
                </div>
            </footer>
        </div>

    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url() ?>/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/assets/plugins/jquery.nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?= base_url() ?>/assets/js/stisla.js"></script>
    <!-- Template JS File -->
    <script src="<?= base_url() ?>/assets/js/scripts.js"></script>
    <script src="<?= base_url() ?>/assets/js/custom.js"></script>
    <!-- SwweetAlert -->
    <script src="<?= base_url() ?>/assets/plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- autonumeric -->
    <script charset="utf8" src="<?= base_url() ?>/assets/plugins/autoNumeric/autoNumeric-2.0.js"></script>
    <!-- data tables -->
    <script charset="utf8" src="<?= base_url() ?>/assets/plugins/DataTables/js/jquery.dataTables.min.js"></script>
    <script charset="utf8" src="<?= base_url() ?>/assets/plugins/DataTables/js/dataTables.bootstrap4.min.js"></script>
    <script charset="utf8" src="<?= base_url() ?>/assets/plugins/DataTables/js/dataTables.buttons.min.js"></script>
    <script charset="utf8" src="<?= base_url() ?>/assets/plugins/DataTables/js/buttons.bootstrap4.min.js"></script>
    <script charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script charset="utf8" src="<?= base_url() ?>/assets/plugins/DataTables/js/buttons.html5.min.js"></script>
    <script charset="utf8" src="<?= base_url() ?>/assets/plugins/DataTables/js/buttons.print.min.js"></script>
    <script charset="utf8" src="https://cdn.datatables.net/plug-ins/1.12.1/api/sum().js"></script>
    <!-- custom js -->
    <script>
        // Log Off
        let log_off = new Date();
        log_off.setMinutes(log_off.getMinutes() + 30)
        log_off = new Date(log_off)

        let int_logoff = setInterval(function() {
            let now = new Date();
            if (now > log_off) {
                alert("Maaf sesi anda telah habis")
                window.location.assign("<?= base_url() ?>/auth/logout");
                clearInterval(int_logoff);
            }
        }, 30000);

        // Alert Logout
        $(function() {
            $('.logout').click(function() {
                if (confirm('Anda yakin ingin keluar?')) {
                    return true;
                }
                return false;
            });
        });

        // Alert Success
        var flash = $('#flash').data('flash');
        if (flash) {
            Swal.fire({
                icon: 'success',
                // title: 'Berhasil',
                showConfirmButton: false,
                timer: 1400,
                text: flash,
                customClass: {
                    container: 'position-absolute'
                },
                toast: true,
                position: 'top-right'
            })
        }

        //Alert Fail
        var flashfail = $('#flashfail').data('flash');
        if (flashfail) {
            Swal.fire({
                icon: 'error',
                // title: 'Gagal',
                showConfirmButton: false,
                timer: 1400,
                text: flashfail,
                customClass: {
                    container: 'position-absolute'
                },
                toast: true,
                position: 'top-right'
            })
        }

        // DataTables
        $(document).ready(function() {
            $('.display').DataTable({
                "language": {
                    "emptyTable": "Data Kosong"
                }
            });
        });

        // modal tambah karyawan
        function tambah_karyawan() {
            $.ajax({
                type: "post",
                url: "<?= base_url('karyawan/tambah_karyawan') ?>",
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modaltambahkaryawan').on('shown.bs.modal', function(event) {
                            $('#nama').focus();
                        });
                        $('#modaltambahkaryawan').modal('show');
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }

        // modal tambah lemburan
        function tambah_lemburan() {
            $.ajax({
                type: "post",
                url: "<?= base_url('lemburan/tambah_lemburan') ?>",
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modaltambahlemburan').on('shown.bs.modal', function(event) {});
                        $('#modaltambahlemburan').modal('show');
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }

        // modal tambah nwnp
        function tambah_nwnp() {
            $.ajax({
                type: "post",
                url: "<?= base_url('nwnp/tambah_nwnp') ?>",
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modaltambahnwnp').on('shown.bs.modal', function(event) {});
                        $('#modaltambahnwnp').modal('show');
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }

        // modal tambah cuti
        function tambah_cuti() {
            $.ajax({
                type: "post",
                url: "<?= base_url('cuti/tambah_cuti') ?>",
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modaltambahcuti').on('shown.bs.modal', function(event) {});
                        $('#modaltambahcuti').modal('show');
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }

        // modal tambah gaji
        function tambah_gaji() {
            $.ajax({
                type: "post",
                url: "<?= base_url('gaji/tambah_gaji') ?>",
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modaltambahgaji').on('shown.bs.modal', function(event) {});
                        $('#modaltambahgaji').modal('show');
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }

        // modal tambah jabatan
        function tambah_jabatan() {
            $.ajax({
                type: "post",
                url: "<?= base_url('pengaturan/tambah_jabatan') ?>",
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modaltambahjabatan').on('shown.bs.modal', function(event) {});
                        $('#modaltambahjabatan').modal('show');
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }

        // modal tambah status
        function tambah_status() {
            $.ajax({
                type: "post",
                url: "<?= base_url('pengaturan/tambah_status') ?>",
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modaltambahstatus').on('shown.bs.modal', function(event) {});
                        $('#modaltambahstatus').modal('show');
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }

        // modal tambah role
        function tambah_role() {
            $.ajax({
                type: "post",
                url: "<?= base_url('pengaturan/tambah_role') ?>",
                dataType: "json",
                success: function(response) {
                    if (response.data) {
                        $('.viewmodal').html(response.data).show();
                        $('#modaltambahrole').on('shown.bs.modal', function(event) {});
                        $('#modaltambahrole').modal('show');
                    }
                },
                error: function(xhr, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        }
    </script>
</body>

</html>