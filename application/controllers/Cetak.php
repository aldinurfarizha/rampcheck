<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('id_user')) {
			redirect(base_url('auth'));
		}
	}

	public function label()
	{
		$data['data'] = $this->Global_model->get_all('master_bus')->result();
		$this->load->view('cetak/label', $data);
	}
	public function printout_label()
	{
		$item = $this->input->post('item');
		if (sizeof($item) != 0) {
			$data['data'] = $item;
			$this->load->view('cetak/printout_label', $data);
			return;
		}
		echo "<script>alert('GAGAL. Pilih Minimal 1 BUS untuk di cetak labelnya !'); close();</script>";
	}
	public function printout_rampcheck()
	{
		$dari = $this->input->post('dari');
		$hingga = $this->input->post('hingga');
		if ($dari == null) {
			echo "<script>alert('Form Dari wajib di isi'); close();</script>";
			return;
		}
		if ($hingga == null) {
			echo "<script>alert('Form Hingga wajib di isi'); close();</script>";
			return;
		}
		$where = array(
			'tanggal_pemeriksaan >=' => $dari,
			'tanggal_pemeriksaan <=' => $hingga
		);
		$data['dari'] = $dari;
		$data['hingga'] = $hingga;
		$data['data'] = $this->Global_model->getRampcheck($where)->result();
		if (sizeof($data['data']) == 0) {
			echo "<script>alert('Tidak ada data pada rentang tanggal tersebut'); close();</script>";
			return;
		}
		$this->load->view('cetak/printout_rampcheck', $data);
	}
	public function printout_sopir()
	{
		$id_sopir = $this->input->post('id_sopir');
		if ($id_sopir == null) {
			echo "<script>alert('Sopir Wajib di pilih'); close();</script>";
			return;
		}
		$where = array(
			'id_sopir' => $id_sopir
		);

		$data['sopir'] = $this->Global_model->get_by_id('master_sopir', $where)->row();
		$data['data'] = $this->Global_model->getRampcheck(['rampcheck.id_sopir' => $id_sopir])->result();
		if (sizeof($data['data']) == 0) {
			echo "<script>alert('Tidak ada data pada sopir tersebut'); close();</script>";
			return;
		}
		$this->load->view('cetak/printout_sopir', $data);
	}
	public function printout_bus()
	{
		$id_bus = $this->input->post('id_bus');
		if ($id_bus == null) {
			echo "<script>alert('BUS Wajib di pilih'); close();</script>";
			return;
		}
		$where = array(
			'id_bus' => $id_bus
		);

		$data['bus'] = $this->Global_model->get_by_id('master_bus', $where)->row();
		$data['data'] = $this->Global_model->getRampcheck(['rampcheck.id_bus' => $id_bus])->result();
		if (sizeof($data['data']) == 0) {
			echo "<script>alert('Tidak ada data pada BUS tersebut'); close();</script>";
			return;
		}
		$this->load->view('cetak/printout_bus', $data);
	}
	public function printout_suratperingatan($id_rampcheck)
	{
		$data['rampcheck'] = $this->Global_model->getRampcheck(['rampcheck.id_rampcheck' => $id_rampcheck])->row();
		$this->load->view('cetak/printout_surat_peringatan', $data);
	}
}
