<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Dokter &mdash; e-Puskesmas</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Dokter</h1>
        <div class="section-header-button">
            <a href="<?= site_url('dokter/add') ?>" class="btn btn-primary">Add New</a>
        </div>
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
                <h4>Data Dokter</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-md" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>SIP</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Spesialis</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (json_decode($dokter) as $key => $value) : ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $value->sip ?></td>
                                <td>
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
                                </td>
                                <td><?= $value->jenis_kelamin == '1' ? "Pria" : ($value->jenis_kelamin == '0' ? "Wanita" : "0") ?></td>
                                <td><?= $value->tempat_lahir . ", " . date("d F Y", strtotime($value->tanggal_lahir)) ?></td>
                                <td><?= $value->alamat ?></td>
                                <td><?= $value->spesialis ?></td>
                                <td class="text-center" style="width: 15%">
                                    <a href="<?= site_url('dokter/edit/' . $value->sip) ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                    <form action="<?= site_url('dokter/delete/' . $value->sip) ?>" method="POST" class="d-inline" id="del-<?= $value->sip ?>">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-danger btn-sm" data-confirm="Hapus Data?|Apakah Anda yakin?" data-confirm-yes="submitDel(<?= $value->sip ?>)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
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