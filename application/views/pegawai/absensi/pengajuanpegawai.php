<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-md">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Filter Data Absensi Pegawai
                </div>
                <div class="card-body">
                    <form class="form-inline" method="post" action="">
                        <div class="form-group mb-2">
                            <label for="bulan">Bulan</label>
                            <select name="bulan" id="bulan" class="form-control ml-2">
                                <option value="">-- Pilih Bulan --</option>
                                <option value="01">Januari</option>
                                <option value="02">Februari</option>
                                <option value="03">Maret</option>
                                <option value="04">April</option>
                                <option value="05">Mei</option>
                                <option value="06">Juni</option>
                                <option value="07">Juli</option>
                                <option value="08">Agustus</option>
                                <option value="09">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                            </select>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <label for="tahun">Tahun</label>
                            <select name="tahun" id="tahun" class="form-control ml-2">
                                <option value="">-- Pilih Tahun --</option>
                                <?php $thn = date('Y');
                                for ($i = 2020; $i < $thn + 5; $i++) { ?>
                                    <option value="<?= $i; ?>"><?= $i; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i> Tampilkan Data</button>
                        <a href="#" class="btn btn-success mb-2 ml-2" data-toggle="modal" data-target="#formPengajuanIzin"><i class="fas fa-plus"></i> Input Pengajuan Izin</a>
                    </form>
                </div>
            </div>

            <?php
            if ((isset($_POST['bulan']) && $_POST['bulan'] != null) && (isset($_POST['tahun']) && $_POST['tahun'] != null)) {
                $bulan = $this->input->post('bulan');
                $tahun = $this->input->post('tahun');
                $bulanTahun = $bulan . $tahun;
            } else {
                $bulan = date('m');
                $tahun = date('Y');
                $bulanTahun = $bulan . $tahun;
            }

            ?>

            <!-- Info Tanggal & Tahun -->
            <div class="alert alert-info mt-4" role="alert">Menampilkan Data Izin Pegawai Bulan: <strong><?= $bulan; ?></strong> Tahun: <strong><?= $tahun; ?></strong></div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Pegawai</th>
                        <th>Tanggal</th>
                        <th>Sakit</th>
                        <th>Izin</th>
                    </tr>
                    <?php $no = 1;
                    foreach ($absensi as $a) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $a['nik']; ?></td>
                            <td><?= $a['nama_pegawai']; ?></td>
                            <td><?= $a['tanggal']; ?></td>
                            <td><?= $a['sakit']; ?></td>
                            <td><?= $a['izin']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <?php if (empty($absensi)) : ?>
                    <div class="alert alert-danger text-center" role="alert">Data tidak ditemukan.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Content Row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="formPengajuanIzin" tabindex="-1" aria-labelledby="formLabelPengajuanIzin" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formLabelPengajuanIzin">Pengajuan Izin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="id_pegawai" name="id_pegawai">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="number" name="nik" id="nik" class="form-control" value="<?= set_value('nik'); ?>">
                        <small class="muted text-danger"><?= form_error('nik'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama_pegawai">Nama Pegawai</label>
                        <input type="text" name="nama_pegawai" id="nama_pegawai" class="form-control" value="<?= set_value('nama_pegawai'); ?>">
                        <small class="muted text-danger"><?= form_error('nama_pegawai'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select name="jk" id="jk" class="form-control">
                            <option value=""> -- Pilih Kelamin --</option>
                            <option value="L">Pria</option>
                            <option value="P">Perempuan</option>
                        </select>
                        <small class="muted text-danger"><?= form_error('jk'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="nama_jabatan">Nama Jabatan</label>
                        <select name="nama_jabatan" id="nama_jabatan" class="form-control">
                            <option value="">-- Pilih Jabatan --</option>
                            <?php foreach ($jabatan as $j) : ?>
                                <option value="<?= $j['id_jabatan']; ?>"><?= $j['nama_jabatan']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="muted text-danger"><?= form_error('nama_jabatan'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="user">User</label>
                        <select name="user" id="user" class="form-control">
                            <option value="">-- Pilih User --</option>
                            <?php foreach ($users as $j) : ?>
                                <option value="<?= $j['id_user']; ?>"><?= $j['username']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <small class="muted text-danger"><?= form_error('nama_jabatan'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="tgl_masuk">Tanggal Masuk</label>
                        <input type="date" name="tgl_masuk" id="tgl_masuk" class="form-control" value="<?= date('Y-m-d'); ?>">
                        <small class="muted text-danger"><?= form_error('tgl_masuk'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value=""> -- Pilih Status --</option>
                            <option value="1">Pegawai Tetap</option>
                            <option value="0">Pegawai Tidak Tetap</option>
                        </select>
                        <small class="muted text-danger"><?= form_error('status'); ?></small>
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label><br>
                        <img src="" width="100" id="editTampilPhoto">
                        <input type="file" name="photo" id="photo" class="form-control-file">
                        <input type="hidden" name="photoLama" id="photoLama" class="form-control">
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-info" data-dismiss="modal">Kembali</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>