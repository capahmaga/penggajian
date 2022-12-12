<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title> <?php echo $title ?> </title>
	<style type="text/css">
		body {
			font-family: sans-serif;
			color: black;
		}

		.rangkasurat {
			width: 980px;
			margin: 0 auto;
			background-color: #fff;
			height: 250px;
			padding: 20px;
		}

		.tablesurat {
			border-bottom: 5px solid #000;
			padding: 2px
		}

		.tengah {
			text-align: center;
			line-height: 3px;
		}
	</style>
</head>

<body>

	<?php
	if ((isset($_POST['bulan']) && $_POST['bulan'] != null) && (isset($_POST['tahun']) && $_POST['tahun'] != null)) {
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];
		$bulanTahun = $bulan . $tahun;
	} else {
		$bulan = date('m');
		$tahun = date('Y');
		$bulanTahun = $bulan . $tahun;
	}
	?>
	<div class="row">
		<div class="col-md">
			<div class="card">
				<div class="rangkasurat">
					<div class="tablesurat">
						<table width="100%">
							<tr>
								<td><img src="<?php echo base_url('/assets/img/logo.png') ?>" width=" 140px"> </td>
								<td class=" tengah">
									<h3>YAYASAN PENDIDIKAN SYIFAUZZAHRA PEKALONGAN</h3>
									<h3>TPA-TK-PAUD ASSYIFA SIDOREJO</h3>
									<h3>KECAMATAN TIRTO KABUPATEN PEKALONGAN</h3>
									<b>Alamat : Perumahan Taman Sejahtera No. 2 Sidorejo Kecamatan Tirto Kabupaten Pekalongan</b>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-4">
							<div class="table-responsive">
								<table class="table">
									<tr>
										<th>Bulan</th>
										<td><?= $bulan; ?></td>
									</tr>
									<tr>
										<th>Tahun</th>
										<td><?= $tahun; ?></td>
									</tr>
									<tr>
										<th></th>
										<td></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md">
							<div class="table-responsive">
								<table class="table table-bordered table-striped">
									<tr>
										<th>No</th>
										<th>NIK</th>
										<th>Nama Pegawai</th>
										<th>Kelamin</th>
										<th>Jabatan</th>
										<th>Hadir</th>
										<th>Sakit</th>
										<th>Alpa</th>
									</tr>
									<?php $no = 1;
									foreach ($absensi as $a) : ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= $a['nik']; ?></td>
											<td><?= $a['nama_pegawai']; ?></td>
											<td><?= $a['jk_kehadiran'] == 'L' ? 'Pria' : 'Perempuan'; ?></td>
											<td><?= $a['nama_jabatan']; ?></td>
											<td><?= $a['hadir']; ?></td>
											<td><?= $a['sakit']; ?></td>
											<td><?= $a['alpa']; ?></td>
										</tr>
									<?php endforeach; ?>
								</table>
								<?php if (empty($absensi)) : ?>
									<div class="alert alert-danger text-center" role="alert">Data tidak ditemukan.</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 offset-md-9">
							<table>
								<tr>
									<td></td>
									<td>
										<p>Pekalongan, <?= date('d M Y'); ?><br>Bagian Administrasi
											<br><br>
										<p>_______________________</p>
										</p>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		window.print();
	</script>