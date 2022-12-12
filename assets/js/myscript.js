function GetBase() {
	var baseUrl='';
      baseUrl = 'http://localhost:9090/penggajian';          
    return baseUrl;
  }

$(function() {
	// Halaman Jabatan
	$('.tombolTambahJabatan').click(function() {
		$('#formModalLabelJabatan').html('Tambah Data Jabatan');
		$('.modal-footer button[type=submit]').html('Tambah');

		$('#id_jabatan').val('');
		$('#jabatan').val('');
		$('#gapok').val('');
		$('#tj_transport').val('');
		$('#uang_makan').val('');
	});

	$('.tombolUbahJabatan').click(function() {
		$('#formModalLabelJabatan').html('Ubah Data Jabatan');
		$('.modal-footer button[type=submit]').html('Ubah');
		$('.modal-body form').attr('action', GetBase()+'/admin/jabatan/ubahjabatan');
		const id = $(this).data('id');
		// console.log(id);

		$.ajax({
			url:  GetBase()+'/admin/jabatan/getjabatan',
			method: 'post',
			dataType: 'json',
			data: {id: id},
			success: function(data) {
				// console.log(data);
				$('#id_jabatan').val(data.id_jabatan);
				$('#jabatan').val(data.nama_jabatan);
				$('#gapok').val(data.gaji_pokok);
				$('#tj_transport').val(data.tj_transport);
				$('#uang_makan').val(data.uang_makan);
			}
		})
	});
	// Akhir Halaman Jabatan


	// Halaman Pegawai
	$('.tombolTambahPegawai').click(function() {
		$('#formModalLabelJabatan').html('Tambah Data Pegawai');
		$('.modal-footer button[type=submit]').html('Tambah');

		$('#id_pegawai').val('');
		$('#nama_pegawai').val('');
		$('#nama_jabatan').val('');
		$('#nik').val('');
		$('#jk').val('');
		$('#tgl_masuk').val('');
		$('#status').val('');
		$('#editTampilPhoto').attr('src', '');
		$('#photoLama').val('');
	});

	$('.tombolUbahPegawai').click(function() {
		$('#formModalLabelJabatan').html('Ubah Data Pegawai');
		$('.modal-footer button[type=submit]').html('Ubah');
		$('.modal-body form').attr('action', GetBase()+'/admin/pegawai/ubahpegawai');

		const id = $(this).data('id');
		// console.log(id);

		$.ajax({
			url: GetBase()+'/admin/pegawai/getpegawai',
			method: 'post',
			dataType: 'json',
			data: {id: id},
			success: function(data) {
				console.log(data);
				$('#id_pegawai').val(data.id_pegawai);
				$('#nama_pegawai').val(data.nama_pegawai);
				$('#nama_jabatan').val(data.id_jabatan);
				$('#nik').val(data.nik);
				$('#jk').val(data.jk_pegawai);
				$('#tgl_masuk').val(data.tgl_masuk);
				$('#status').val(data.status);
				$('#editTampilPhoto').attr('src', GetBase()+'/assets/img/pegawai/' + data.photo);
				$('#photoLama').val(data.photo);
			}
		})
	});
	// Akhir Halaman Pegawai


	// Halaman Potongan Gaji
	$('.tombolTambahPotonganGaji').click(function() {
		$('#formModalLabelPotonganGaji').html('Tambah Data Potongan');
		$('.modal-footer button[type=submit]').html('Tambah');
	
	});

	$('.tombolUbahPotonganGaji').click(function() {
		$('#formModalLabelPotonganGaji').html('Ubah Data Potongan');
		$('.modal-footer button[type=submit]').html('Ubah');
		$('.modal-body form').attr('action', GetBase()+'/admin/potongangaji/ubahpotongan');

		const id = $(this).data('id');
		// console.log(id);

		$.ajax({
			url: GetBase()+'/admin/potongangaji/getpotongan',
			method: 'post',
			dataType: 'json',
			data: {id: id},
			success: function(data) {
				console.log(data);
				$('#id_poga').val(data.id_poga);
				$('#potongan').val(data.potongan);
				$('#jml').val(data.jml_potongan);
			}
		})
	});
	// Akhir Halaman Potongan Gaji


	// Halaman Setting Intensif Gaji
	$('.tombolTambahIntensif').click(function() {
		$('#id_intensif').val('');
		$('#intensif').val('');
		$('#jml_intensif').val('');
		$('#formModalLabelIntensif').html('Tambah Data Intensif');
		$('.modal-footer button[type=submit]').html('Tambah');
		
	});

	$('.tombolUbahIntensif').click(function() {
		$('#formModalLabelIntensif').html('Ubah Data Intensif');
		$('.modal-footer button[type=submit]').html('Ubah');
		$('.modal-body form').attr('action', GetBase()+'/admin/intensif/ubahintensif');

		const id = $(this).data('id');

		$.ajax({
			url: GetBase()+'/admin/intensif/getintensif',
			method: 'post',
			dataType: 'json',
			data: {id: id},
			success: function(data) {
				console.log(data);
				$('#id_intensif').val(data.id_intensif);
				$('#intensif').val(data.intensif);
				$('#jml_intensif').val(data.jml_intensif);
			}
		})
	});
	// Akhir Halaman Intensif Gaji

});