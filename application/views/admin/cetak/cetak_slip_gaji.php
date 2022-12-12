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
										<th>Nama Pegawai</th>
										<td><?= $slip['nama_pegawai']; ?></td>
									</tr>
									<tr>
										<th>Jabatan</th>
										<td><?= $slip['nama_jabatan']; ?></td>
									</tr>
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
										<th>Keterangan</th>
										<th>Jumlah</th>
									</tr>
									<tr>
										<td>1</td>
										<td>Gaji Pokok</td>
										<td>Rp.<?= number_format($slip['gaji_pokok'], 0, ',', '.'); ?></td>
									</tr>
									<tr>
										<td>2</td>
										<td>Tj.Transportasi</td>
										<td>Rp.<?= number_format($slip['tj_transport'], 0, ',', '.'); ?></td>
									</tr>
									<tr>
										<td>3</td>
										<td>Tj.Uang Makan</td>
										<td>Rp.<?= number_format($slip['uang_makan'], 0, ',', '.'); ?></td>
									</tr>
									<tr>
										<?php foreach ($potongan as $p) : ?>
											<?php $alpa = $p['jml_potongan'] * $slip['alpa']; ?>
										<?php endforeach; ?>
										<td>4</td>
										<td>Potongan / Alpa</td>
										<td>Rp.<?= number_format($alpa, 0, ',', '.'); ?></td>
									</tr>
									<tr class="text-center font-weight-bold">
										<td></td>
										<td>Total Gaji</td>
										<td>Rp.<?= number_format($slip['uang_makan'] + $slip['tj_transport'] + $slip['gaji_pokok'] - $alpa, 0, ',', '.'); ?></td>
									</tr>
								</table>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 offset-md-9">
							<table>
								<tr>
									<td></td>
									<td>
										<p>Pekalongan, <?= date('d M Y'); ?><br>Staff Administrasi
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