<?= $this->extend('layout'); ?>

<?= $this->section('content-page'); ?>
<div class="section-header">
    <h1>Data Karyawan Detail</h1>
</div>
<div class="row mb-3">
    <div class="col">
        <a href="<?= base_url('karyawan') ?>" class="btn btn-sm btn-secondary"><i class="bi bi-backspace-fill"></i> Kembali</a>
    </div>
</div>
<div class="row">
    <div class="col-md-3 mb-3">
        <img src="<?= base_url(); ?>/assets/img/profil/default.jpg" class="img-fluid rounded-start" alt="default.jpg">
    </div>
    <div class="col">
        <div class="card card-outline card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h3 class="text-center text-primary"><i class="bi bi-card-text"></i> Biografi Karyawan</h3>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <h5 class="text-primary"><i class="bi bi-person-circle"></i> Data Personal</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p><b>Nama</b></p>
                    </div>
                    <div class="col">
                        <p><?= $karyawan_detil->nama ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p><b>Email</b></p>
                    </div>
                    <div class="col">
                        <p><?= $karyawan_detil->email ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p><b>Jenis Kelamin</b></p>
                    </div>
                    <div class="col">
                        <p><?= $karyawan_detil->jenis_kelamin ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p><b>Tempat Lahir</b></p>
                    </div>
                    <div class="col">
                        <p><?= $karyawan_detil->tempat_lahir ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p><b>Tanggal Lahir</b></p>
                    </div>
                    <div class="col">
                        <p><?= date_indo($karyawan_detil->tanggal_lahir) ?></p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col">
                        <h5 class="text-primary"><i class="bi bi-building"></i> Data Perusahaan</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p><b>Jabatan</b></p>
                    </div>
                    <div class="col">
                        <p><?= $karyawan_detil->jabatan ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p><b>Status Karyawan</b></p>
                    </div>
                    <div class="col">
                        <p><?= $karyawan_detil->status ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p><b>Gaji Pokok</b></p>
                    </div>
                    <div class="col">
                        <p><?= "Rp " . number_format($karyawan_detil->gaji_pokok, 2, ",", "."); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p><b>Tunjangan</b></p>
                    </div>
                    <div class="col">
                        <p><?= "Rp " . number_format($karyawan_detil->tunjangan, 2, ",", "."); ?></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <p><b>Tanggal Masuk</b></p>
                    </div>
                    <div class="col">
                        <p><?= date_indo($karyawan_detil->tanggal_masuk) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>