<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Tambah Data Pasien &mdash; e-Puskesmas</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('pasien/tampil') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Tambah Data Pasien</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Buat Data Pasien Baru</h4>
            </div>
            <div class="card-body col-md-6">
                <?php $validation = \Config\Services::validation() ?>
                <?php $errors = session()->getFlashdata('errors') ?>
                <form action="<?= site_url('pasien/store') ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label>No. Induk Keluarga *</label>
                        <input type="text" name="nik" value="<?= old('nik') ?>" class="form-control <?= isset($errors['nik']) ? 'is-invalid' : null ?>" placeholder="NIK">
                        <div class="invalid-feedback">
                            <?= isset($errors['nik']) ? $errors['nik'] : null ?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Nama Depan *</label>
                            <input type="text" name="nama_depan" class="form-control" placeholder="Nama Depan">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Nama Tengah</label>
                            <input type="text" name="nama_tengah" class="form-control" placeholder="Nama Tengah">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Nama Belakang</label>
                            <input type="text" name="nama_belakang" class="form-control" placeholder="Nama Belakang">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Jenis Kelamin *</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="Pria">
                                <label class="form-check-label">
                                    Laki-laki
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="jenis_kelamin" value="Wanita">
                                <label class="form-check-label">
                                    Perempuan
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Tempat Lahir *</label>
                            <input type="text" name="tempat_lahir" class="form-control" placeholder="Tempat Lahir">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal Lahir *</label>
                            <input type="text" name="tanggal_lahir" class="form-control datepicker">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Alamat *</label>
                        <textarea class="form-control" name="alamat" required="" style="height: 150px;"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Foto KTP</label>
                        <div class="col-md-12">
                            <div id="image-preview" class="image-preview">
                                <label for="image-upload" id="image-label">Choose File</label>
                                <input type="file" name="foto_ktp_web" id="image-upload" />
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-success"><i class="fas fa-paper-plane"> Save</i></button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>