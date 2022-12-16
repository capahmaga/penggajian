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
                <form action="<?= base_url('pegawai/pengajuanpegawai/savePengajuanIzin'); ?> " method="post" id="formPengajuanIzin" enctype="multipart/form-data">
                    <input type="hidden" id="id_pegawai" name="id_pegawai" value=<?= $user['id_pegawai']; ?>>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="number" name="input_nik" id="input_nik" class="form-control" value="<?= $user['nik']; ?>">
                        <span id="nik_error" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="nama_pegawai">Nama Pegawai</label>
                        <input type="text" name="input_nama_pegawai" id="input_nama_pegawai" class="form-control" value="<?= $user['nama_pegawai']; ?>">
                        <span id="nama_pegawai_error" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="jenis_pengajuan">Jenis Pengajuan</label>
                        <select name="input_jenis_pengajuan" id="input_jenis_pengajuan" class="form-control">
                            <option value=""> -- Pilih Pengajuan --</option>
                            <option value="1">Sakit</option>
                            <option value="2">Izin</option>
                        </select>
                        <span id="jenis_pengajuan_error" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" name="input_tanggal_mulai" id="input_tanggal_mulai" class="form-control" value="<?= (set_value('tanggal_mulai') ? date("Y-m-d", strtotime(set_value('tanggal_mulai'))) : date("Y-m-d")); ?>">
                        <span id="tanggal_mulai_error" class="text-danger"></span>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_akhir">Tanggal Akhir</label>
                        <input type="date" name="input_tanggal_akhir" id="input_tanggal_akhir" class="form-control" value="<?= (set_value('tanggal_akhir') ? date("Y-m-d", strtotime(set_value('tanggal_akhir'))) : date("Y-m-d")); ?>">
                        <span id="tanggal_akhir_error" class="text-danger"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-info" data-dismiss="modal">Kembali</button>
                        <button type="button" id="btnSimpanIzin" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>