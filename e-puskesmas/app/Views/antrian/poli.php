<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Antrian &mdash; e-Puskesmas</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Antrian</h1>
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
                <h4>Data Antrian</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-md" id="table1">
                    <thead>
                        <tr>
                            <th>No. Antrian</th>
                            <th>NIK</th>
                            <th>Nama Pasien</th>
                            <th>Jenis Kelamin</th>
                            <th>Poli</th>
                            <th>Hari, Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (json_decode($antrian) as $key => $value) : ?>
                            <tr>
                                <td><?= $value->no_antrian ?></td>
                                <td><?= $value->nik ?></td>
                                <td><?= $value->pas_nama_depan . " " . $value->pas_nama_tengah . " " . $value->pas_nama_belakang ?></td>
                                <td><?= $value->pas_jenis_kelamin == '1' ? "Pria" : ($value->pas_jenis_kelamin == '0' ? "Wanita" : "0") ?></td>
                                <td><?= $value->nama_poli ?></td>
                                <td><?= $value->hari . ", " . date("d F Y", strtotime($value->tanggal)) ?></td>
                                <td>
                                    <?php
                                    if ($value->status == 0) :
                                    ?>
                                        <a href="<?= site_url('restapi/antrian/updatestatus/' . $value->ID) ?>" class="badge badge-warning">Antri</a>
                                    <?php
                                    elseif ($value->status == 1) :
                                    ?>
                                        <a href="<?= site_url('restapi/antrian/updatestatus/' . $value->ID) ?>" class="badge badge-info">Periksa</a>
                                    <?php
                                    elseif ($value->status == 2) :
                                    ?>
                                        <a href="<?= site_url('restapi/antrian/updatestatus/' . $value->ID) ?>" class="badge badge-success">Selesai</a>
                                    <?php
                                    elseif ($value->status == 3) :
                                    ?>
                                        <a href="<?= site_url('restapi/antrian/updatestatus/' . $value->ID) ?>" class="badge badge-danger">Gagal</a>
                                    <?php endif ?>
                                    <div class="text-small text-muted">*Klik untuk mengubah status</div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>