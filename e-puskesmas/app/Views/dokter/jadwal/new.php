<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Tambah Jadwal Dokter &mdash; e-Puskesmas</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <div class="section-header-back">
            <a href="<?= site_url('jadwaldokter/tampil') ?>" class="btn"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Tambah Jadwal Dokter</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Buat Jadwal Dokter Baru</h4>
            </div>
            <div class="card-body col-md-6">
                <?php $validation = \Config\Services::validation() ?>
                <?php $errors = session()->getFlashdata('errors') ?>
                <form action="<?= site_url('jadwaldokter/store') ?>" method="POST" autocomplete="off">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label>Dokter *</label>
                        <select name="sip" class="form-control <?= isset($errors['sip']) ? 'is-invalid' : null ?>">
                            <option value="" hidden></option>
                            <?php foreach ($dok as $key => $value) : ?>
                                <option value="<?= $value->sip ?>" <?= old('sip') == $value->sip ? 'selected' : null ?>>
                                    <?php
                                    if ($value->gelar_depan == '' && $value->gelar_belakang == '') {
                                        if ($value->nama_tengah == '' && $value->nama_belakang == '') {
                                            echo $value->nama_depan;
                                        } elseif ($value->nama_tengah == '') {
                                            echo $value->nama_depan . " " . $value->nama_belakang;
                                        } elseif ($value->nama_belakang == '') {
                                            echo $value->nama_depan . " " . $value->nama_tengah;
                                        } else {
                                            echo $value->nama_depan . " " . $value->nama_tengah . " " . $value->nama_belakang;
                                        }
                                    } elseif ($value->gelar_depan == '') {
                                        if ($value->nama_tengah == '' && $value->nama_belakang == '') {
                                            echo $value->nama_depan . ", " . $value->gelar_belakang;
                                        } elseif ($value->nama_tengah == '') {
                                            echo $value->nama_depan . " " . $value->nama_belakang . ", " . $value->gelar_belakang;
                                        } elseif ($value->nama_belakang == '') {
                                            echo $value->nama_depan . " " . $value->nama_tengah . ", " . $value->gelar_belakang;
                                        } else {
                                            echo $value->nama_depan . " " . $value->nama_tengah . " " . $value->nama_belakang . ", " . $value->gelar_belakang;
                                        }
                                    } elseif ($value->gelar_belakang == '') {
                                        if ($value->nama_tengah == '' && $value->nama_belakang == '') {
                                            echo $value->gelar_depan . ". " . $value->nama_depan;
                                        } elseif ($value->nama_tengah == '') {
                                            echo $value->gelar_depan . ". " . $value->nama_depan . " " . $value->nama_belakang;
                                        } elseif ($value->nama_belakang == '') {
                                            echo $value->gelar_depan . ". " . $value->nama_depan . " " . $value->nama_tengah;
                                        } else {
                                            echo $value->gelar_depan . ". " . $value->nama_depan . " " . $value->nama_tengah . " " . $value->nama_belakang;
                                        }
                                    } else {
                                        if ($value->nama_tengah == '' && $value->nama_belakang == '') {
                                            echo $value->gelar_depan . ". " . $value->nama_depan . ", " . $value->gelar_belakang;
                                        } elseif ($value->nama_tengah == '') {
                                            echo $value->gelar_depan . ". " . $value->nama_depan . " " . $value->nama_belakang . ", " . $value->gelar_belakang;
                                        } elseif ($value->nama_belakang == '') {
                                            echo $value->gelar_depan . ". " . $value->nama_depan . " " . $value->nama_tengah . ", " . $value->gelar_belakang;
                                        } else {
                                            echo $value->gelar_depan . ". " . $value->nama_depan . " " . $value->nama_tengah . " " . $value->nama_belakang . ", " . $value->gelar_belakang;
                                        }
                                    }
                                    ?>
                                </option>
                            <?php endforeach ?>
                            <div class="invalid-feedback">
                                <?= isset($errors['sip']) ? $errors['sip'] : null ?>
                            </div>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Poli *</label>
                        <select name="ID_poli" class="form-control <?= isset($errors['ID_poli']) ? 'is-invalid' : null ?>">
                            <option value="" hidden></option>
                            <?php foreach ($poli as $key => $value) : ?>
                                <option value="<?= $value->ID_poli ?>" <?= old('ID_poli') == $value->ID_poli ? 'selected' : null ?>>
                                    <?= $value->nama_poli ?>
                                </option>
                            <?php endforeach ?>
                            <div class="invalid-feedback">
                                <?= isset($errors['ID_poli']) ? $errors['ID_poli'] : null ?>
                            </div>
                        </select>
                    </div>
                    <div class="form-row">
                        <label>Hari *</label>
                        <div class="form-group col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="hari" value="senin">
                                <label class="form-check-label">
                                    Senin
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="hari" value="selasa">
                                <label class="form-check-label">
                                    Selasa
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="hari" value="rabu">
                                <label class="form-check-label">
                                    Rabu
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="hari" value="kamis">
                                <label class="form-check-label">
                                    Kamis
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="hari" value="jumat">
                                <label class="form-check-label">
                                    Jumat
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="hari" value="sabtu">
                                <label class="form-check-label">
                                    Sabtu
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jam</label>
                        <input type="text" name="jam" class="form-control timepicker">
                        <div class="text-small text-muted">*AM => 00:00 - 11:59*</div>
                        <div class="text-small text-muted">*PM => 12:00 - 23:59*</div>
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