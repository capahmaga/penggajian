<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi_model extends CI_Model
{
	public function joinPegawaiJabatan($bulanTahun)
	{
		$this->db->select('*');
		$this->db->from('kehadiran');
		$this->db->join('pegawai', 'pegawai.id_pegawai = kehadiran.id_pegawai');
		$this->db->join('jabatan', 'jabatan.id_jabatan = kehadiran.id_jabatan');
		$this->db->where('kehadiran.bulan', $bulanTahun);
		return $this->db->get()->result_array();
	}

	public function InputjoinPegawaiJabatan($bulanTahun)
	{
		return $this->db->query("
			SELECT pegawai.*, jabatan.nama_jabatan FROM pegawai 
			INNER JOIN jabatan ON pegawai.id_jabatan = jabatan.id_jabatan 
			WHERE NOT EXISTS (SELECT * FROM kehadiran 
			WHERE bulan = '$bulanTahun' AND pegawai.nik = kehadiran.nik)")->result_array();
	}

	public function tambah_batch($data)
	{
		$jumlahData = count($data);
		// var_dump($jumlahData); die;
		if ($jumlahData > 0) {
			$this->db->insert_batch('kehadiran', $data);
		}
	}

	public function getPegawaiByUserID($id_user)
	{
		$this->db->select('*');
		$this->db->from('pegawai');
		$this->db->where('id_user', $id_user);
		return $this->db->get()->row();
	}

	public function presensi_masuk($data)
	{
		$jumlahData = count($data);
		// var_dump($jumlahData); die;
		if ($jumlahData > 0) {
			$this->db->insert('kehadiran_detail', $data);
		}
	}

	public function presensi_keluar($data, $id_pegawai, $tanggal_absen)
	{
		$jumlahData = count($data);
		// var_dump($jumlahData); die;
		if ($jumlahData > 0) {
			$this->db->where('id_pegawai', $id_pegawai);
			$this->db->where('tanggal', $tanggal_absen);
			$this->db->update('kehadiran_detail', $data);
		}
	}

	public function cekPresensiStatus($id_pegawai, $tanggal_absen)
	{
		$this->db->select('*');
		$this->db->from('kehadiran_detail');
		$this->db->where('id_pegawai', $id_pegawai);
		$this->db->where('tanggal', $tanggal_absen);
		return $this->db->get()->row();
	}

	public function getPengajuanAbsensi($id_pegawai, $bulan, $tahun)
	{
		$this->db->select('*');
		$this->db->from('kehadiran_detail');
		$this->db->join('pegawai', 'kehadiran_detail.id_pegawai = pegawai.id_pegawai');
		$this->db->where('kehadiran_detail.id_pegawai', $id_pegawai);
		$this->db->where('YEAR(tanggal)=' . $tahun);
		$this->db->where('MONTH(tanggal)=' . $bulan);
		$this->db->where('(sakit=1 or izin=1)');
		return $this->db->get()->result_array();
	}

	public function getPegawaiAbsensi($id_pegawai, $bulan, $tahun)
	{
		$this->db->select('*');
		$this->db->from('kehadiran_detail');
		$this->db->join('pegawai', 'kehadiran_detail.id_pegawai = pegawai.id_pegawai');
		$this->db->where('kehadiran_detail.id_pegawai', $id_pegawai);
		$this->db->where('YEAR(tanggal)=' . $tahun);
		$this->db->where('MONTH(tanggal)=' . $bulan);
		return $this->db->get()->result_array();
	}

	public function simpan_izin($data)
	{
		$jumlahData = count($data);
		// var_dump($jumlahData); die;
		if ($jumlahData > 0) {
			$this->db->insert('kehadiran_detail', $data);
		}
	}
}
