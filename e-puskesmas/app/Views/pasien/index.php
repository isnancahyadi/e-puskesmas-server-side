<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Pasien &mdash; e-Puskesmas</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Pasien</h1>
        <div class="section-header-button">
            <a href="<?= site_url('pasien/add') ?>" class="btn btn-primary">Add New</a>
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
                <h4>Data Pasien</h4>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-md" id="table1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Tempat, Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Foto KTP</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (json_decode($pasien) as $key => $value) : ?>
                            <tr>
                                <td><?= $key + 1 ?></td>
                                <td><?= $value->nik ?></td>
                                <td><?= $value->nama_depan . " " . $value->nama_tengah . " " . $value->nama_belakang ?></td>
                                <td><?= $value->jenis_kelamin == '1' ? "Pria" : ($value->jenis_kelamin == '0' ? "Wanita" : "0") ?></td>
                                <td><?= $value->tempat_lahir . ", " . date("d F Y", strtotime($value->tanggal_lahir)) ?></td>
                                <td><?= $value->alamat ?></td>
                                <td><img src="<?= base_url('/img/ktp/' . $value->foto_ktp) ?>" alt="" width="100px"></td>
                                <td class="text-center" style="width: 15%">
                                    <a href="<?= site_url('pasien/edit/' . $value->nik) ?>" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                    <form action="<?= site_url('pasien/delete/' . $value->nik) ?>" method="POST" class="d-inline" id="del-<?= $value->nik ?>">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button class="btn btn-danger btn-sm" data-confirm="Hapus Data?|Apakah Anda yakin?" data-confirm-yes="submitDel(<?= $value->nik ?>)">
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