<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card bg-info text-light">
                <div class="card-body">
                    <h5 class="card-title">Presensi Masuk</h5>
                    <p class="card-text">Silahkan Lakukan Presensi Masuk</p>
                    <a href="<?= base_url('pegawai/presensi/masuk'); ?> " class="btn btn-primary">Presensi Sekarang!</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card bg-warning text-light">
                <div class="card-body">
                    <h5 class="card-title">Presensi Keluar</h5>
                    <p class="card-text">Silahkan Lakukan Presensi Keluar</p>
                    <a href="#" class="btn btn-primary">Presensi Sekarang!</a>
                </div>
            </div>
            </form>
        </div>
        </form>
    </div>

</div>


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
</script>