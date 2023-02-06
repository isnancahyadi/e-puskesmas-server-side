<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Riwayat Pemeriksaan Pasien &mdash; e-Puskesmas</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Riwayat Pasien</h1>
    </div>

    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">x</button>
                <b>Success !</b>
                <?= session()->getFlashdata('success') ?>
            </div>
        </div>
    <?php endif ?>
    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">x</button>
                <b>Error !</b>
                <?= session()->getFlashdata('error') ?>
            </div>
        </div>
    <?php endif ?>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Data Riwayat Pasien</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-md" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hari, Tanggal</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Poli</th>
                            <th>Dokter</th>
                            <th>Keluhan</th>
                            <th>Diagnosis</th>
                            <th>Resep Obat</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (json_decode($riwayat) as $key => $value) : ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $value->hari . ", " . date("d F Y", strtotime($value->tanggal)) ?></td>
                                <td><?= $value->nik ?></td>
                                <td><?= $value->pas_nama_depan . " " . $value->pas_nama_tengah . " " . $value->pas_nama_belakang ?></td>
                                <td><?= $value->nama_poli ?></td>
                                <td>
                                    <?php
                                    if ($value->dok_gelar_depan == '' && $value->dok_gelar_belakang == '') {
                                        if ($value->dok_nama_tengah == '' && $value->dok_nama_belakang == '') {
                                            echo $value->dok_nama_depan;
                                        } elseif ($value->dok_nama_tengah == '') {
                                            echo $value->dok_nama_depan . " " . $value->dok_nama_belakang;
                                        } elseif ($value->dok_nama_belakang == '') {
                                            echo $value->dok_nama_depan . " " . $value->dok_nama_tengah;
                                        } else {
                                            echo $value->dok_nama_depan . " " . $value->dok_nama_tengah . " " . $value->dok_nama_belakang;
                                        }
                                    } elseif ($value->dok_gelar_depan == '') {
                                        if ($value->dok_nama_tengah == '' && $value->dok_nama_belakang == '') {
                                            echo $value->dok_nama_depan . ", " . $value->dok_gelar_belakang;
                                        } elseif ($value->dok_nama_tengah == '') {
                                            echo $value->dok_nama_depan . " " . $value->dok_nama_belakang . ", " . $value->dok_gelar_belakang;
                                        } elseif ($value->dok_nama_belakang == '') {
                                            echo $value->dok_nama_depan . " " . $value->dok_nama_tengah . ", " . $value->dok_gelar_belakang;
                                        } else {
                                            echo $value->dok_nama_depan . " " . $value->dok_nama_tengah . " " . $value->dok_nama_belakang . ", " . $value->dok_gelar_belakang;
                                        }
                                    } elseif ($value->dok_gelar_belakang == '') {
                                        if ($value->dok_nama_tengah == '' && $value->dok_nama_belakang == '') {
                                            echo $value->dok_gelar_depan . ". " . $value->dok_nama_depan;
                                        } elseif ($value->dok_nama_tengah == '') {
                                            echo $value->dok_gelar_depan . ". " . $value->dok_nama_depan . " " . $value->dok_nama_belakang;
                                        } elseif ($value->dok_nama_belakang == '') {
                                            echo $value->dok_gelar_depan . ". " . $value->dok_nama_depan . " " . $value->dok_nama_tengah;
                                        } else {
                                            echo $value->dok_gelar_depan . ". " . $value->dok_nama_depan . " " . $value->dok_nama_tengah . " " . $value->dok_nama_belakang;
                                        }
                                    } else {
                                        if ($value->dok_nama_tengah == '' && $value->dok_nama_belakang == '') {
                                            echo $value->dok_gelar_depan . ". " . $value->dok_nama_depan . ", " . $value->dok_gelar_belakang;
                                        } elseif ($value->dok_nama_tengah == '') {
                                            echo $value->dok_gelar_depan . ". " . $value->dok_nama_depan . " " . $value->dok_nama_belakang . ", " . $value->dok_gelar_belakang;
                                        } elseif ($value->dok_nama_belakang == '') {
                                            echo $value->dok_gelar_depan . ". " . $value->dok_nama_depan . " " . $value->dok_nama_tengah . ", " . $value->dok_gelar_belakang;
                                        } else {
                                            echo $value->dok_gelar_depan . ". " . $value->dok_nama_depan . " " . $value->dok_nama_tengah . " " . $value->dok_nama_belakang . ", " . $value->dok_gelar_belakang;
                                        }
                                    }
                                    ?>
                                </td>
                                <td><?= $value->keluhan ?></td>
                                <td><?= $value->diagnosis ?></td>
                                <td><?= $value->obat ?></td>
                                <td><?= $value->catatan ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>