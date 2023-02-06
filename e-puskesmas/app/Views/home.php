<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Home &mdash; e-Puskesmas</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 card-primary">
                <div class="card-icon bg-primary pt-4" style="height:110px; width:110px">
                    <i class="fas fa-user-injured" style="font-size:62px"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Antrian Poli Umum</h4>
                    </div>
                    <div class="card-body">
                        <h3><?= counterPoliUmum()->num_count ?></h3>
                    </div>
                    <div class="form-row">
                        <div class="text-right mr-3">
                            <a href="<?= site_url('restapi/poliumum/counter/0') ?>" class="btn btn-icon icon-left btn-primary"><i class="fas fa-retweet"></i> Reset antrian</a>
                        </div>
                        <div class="text-right mr-3">
                            <a href="<?= site_url('restapi/poliumum/counter/1') ?>" class="btn btn-icon icon-left btn-primary"><i class="fas fa-arrow-right"></i> Antrian selanjutnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 card-danger">
                <div class="card-icon bg-danger pt-4" style="height:110px; width:110px">
                    <i class="fas fa-capsules" style="font-size:62px"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Antrian Poli KB</h4>
                    </div>
                    <div class="card-body">
                        <h3><?= counterPoliKb()->num_count ?></h3>
                    </div>
                    <div class="form-row">
                        <div class="text-right mr-3">
                            <a href="<?= site_url('restapi/polikb/counter/0') ?>" class="btn btn-icon icon-left btn-danger"><i class="fas fa-retweet"></i> Reset antrian</a>
                        </div>
                        <div class="text-right mr-3">
                            <a href="<?= site_url('restapi/polikb/counter/1') ?>" class="btn btn-icon icon-left btn-danger"><i class="fas fa-arrow-right"></i> Antrian selanjutnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 card-warning">
                <div class="card-icon bg-warning pt-4" style="height:110px; width:110px">
                    <i class="fas fa-user-nurse" style="font-size:62px"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Antrian Poli KIA</h4>
                    </div>
                    <div class="card-body">
                        <h3><?= counterPoliKia()->num_count ?></h3>
                    </div>
                    <div class="form-row">
                        <div class="text-right mr-3">
                            <a href="<?= site_url('restapi/polikia/counter/0') ?>" class="btn btn-icon icon-left btn-warning"><i class="fas fa-retweet"></i> Reset antrian</a>
                        </div>
                        <div class="text-right mr-3">
                            <a href="<?= site_url('restapi/polikia/counter/1') ?>" class="btn btn-icon icon-left btn-warning"><i class="fas fa-arrow-right"></i> Antrian selanjutnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1 card-success">
                <div class="card-icon bg-success pt-4" style="height:110px; width:110px">
                    <i class="fas fa-baby" style="font-size:62px"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Antrian Poli Anak</h4>
                    </div>
                    <div class="card-body">
                        <h3><?= counterPoliAnak()->num_count ?></h3>
                    </div>
                    <div class="form-row">
                        <div class="text-right mr-3">
                            <a href="<?= site_url('restapi/polianak/counter/0') ?>" class="btn btn-icon icon-left btn-success"><i class="fas fa-retweet"></i> Reset antrian</a>
                        </div>
                        <div class="text-right mr-3">
                            <a href="<?= site_url('restapi/polianak/counter/1') ?>" class="btn btn-icon icon-left btn-success"><i class="fas fa-arrow-right"></i> Antrian selanjutnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>