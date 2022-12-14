<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>

    </div>
    <div class="row">

        <?php if ($sakit == '1') { ?>
            <div class="col-md-6">
                <div class="card bg-danger text-light">
                    <div class="card-body">
                        <h5 class="card-title">Presensi Izin</h5>
                        <?php if ($this->session->flashdata('pesan')) : ?>
                            <div class="alert alert-success alert-dismissible show fade" role="alert">
                                <?= $this->session->flashdata('pesan');; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <p class="card-text">Telah Melakukan Presensi Izin</p>
                        <?php endif; ?>
                        <p class="card-text">Telah Melakukan Presensi Izin</p>
                        <a href="<?= base_url('pegawai/absensipegawai/presensi_masuk'); ?> " class="btn btn-primary disabled" aria-disabled="true">Presensi Sekarang!</a>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="col-md-6">
                <div class="card bg-info text-light">
                    <div class="card-body">
                        <h5 class="card-title">Presensi Masuk</h5>
                        <?php if ($this->session->flashdata('pesan')) : ?>
                            <div class="alert alert-success alert-dismissible show fade" role="alert">
                                <?= $this->session->flashdata('pesan');; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif;
                        if ($this->session->waktu_absen) { ?>
                            <p class="card-text">Telah Melakukan Presensi Masuk</p>
                            <a href="<?= base_url('pegawai/absensipegawai/presensi_masuk'); ?> " class="btn btn-primary disabled" aria-disabled="true">Presensi Sekarang!</a>
                        <?php } else { ?>
                            <p class="card-text">Silahkan Lakukan Presensi Masuk</p>
                            <a href="<?= base_url('pegawai/absensipegawai/presensi_masuk'); ?> " class="btn btn-primary">Presensi Sekarang!</a>
                        <?php } ?>


                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-warning text-light">
                    <div class="card-body">
                        <h5 class="card-title">Presensi Keluar</h5>
                        <?php if ($this->session->flashdata('pesan_keluar')) : ?>
                            <div class="alert alert-success alert-dismissible show fade" role="alert">
                                <?= $this->session->flashdata('pesan_keluar');; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php endif;
                        if ($this->session->waktu_absen) { ?>
                            <p class="card-text">Telah Melakukan Presensi Keluar</p>
                            <a href="<?= base_url('pegawai/absensipegawai/presensi_keluar'); ?> " class="btn btn-primary">Presensi Keluar Sekarang!</a>
                        <?php } else { ?>
                            <p class="card-text">Silahkan Lakukan Presensi Keluar</p>
                            <a href="<?= base_url('pegawai/absensipegawai/presensi_keluar'); ?> " class="btn btn-primary">Presensi Keluar Sekarang!</a>
                        <?php } ?>
                    </div>
                </div>
                </form>
            </div>
        <?php } ?>

        </form>
    </div>

</div>

<!-- 
<script>
    getLocation();

    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser");
        }

    }

    function showPosition(position) {
        //  x.innerHTML = "Latitude :" + position.coords.latitude + "<br
        //  Longitude: "+ position.coords.longitude;
        $('#lat').val(position.coords.latitude);
        $('#long').val(position.coords.longitude);
        alert(position.coords.latitude);
        alert(position.coords.longitude);
    }
</script> -->