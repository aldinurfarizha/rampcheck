<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Master extends CI_Controller
{

	public function bus()
	{
		$data['data'] = $this->Global_model->get_all('master_bus')->result();
		$this->load->view('master/bus', $data);
	}
	public function sopir()
	{
		$data['data'] = $this->Global_model->get_all('master_sopir')->result();
		$this->load->view('master/sopir', $data);
	}
	public function pengguna()
	{
		$data['data'] = $this->Global_model->get_all('user')->result();
		$this->load->view('master/pengguna', $data);
	}
	public function struktural()
	{
		$data['data'] = $this->Global_model->get_all('master_struktural')->row();
		$this->load->view('master/struktural', $data);
	}
	public function detail_bus($id_bus)
	{
		$where = array(
			'id_bus' => $id_bus
		);

		$data['bus'] = $this->Global_model->get_by_id('master_bus', $where)->row();
		$data['data'] = $this->Global_model->getRampcheck(['rampcheck.id_bus' => $id_bus])->result();
		$this->load->view('master/detail_bus', $data);
	}
	public function detail_sopir($id_sopir)
	{
		$where = array(
			'id_sopir' => $id_sopir
		);

		$data['sopir'] = $this->Global_model->get_by_id('master_sopir', $where)->row();
		$data['data'] = $this->Global_model->getRampcheck(['rampcheck.id_sopir' => $id_sopir])->result();
		$this->load->view('master/detail_sopir', $data);
	}
	public function add_bus()
	{
		$initial_start=$this->input->post('initial_start');
		$number=$this->input->post('number');
		$initial_end=$this->input->post('initial_end');
		$nomor_plat_kendaraan = $initial_start.$number.$initial_end;
		$jenis_angkutan = $this->input->post('jenis_angkutan', true);
		$nama_po = $this->input->post('nama_po', true);
		$trayek = $this->input->post('trayek', true);
		if (isPlatExist($nomor_plat_kendaraan)) {
			return responseBAD("Nomor Plat Kendaraan ini '" . $nomor_plat_kendaraan . "' Sudah terpakai !");
		}
		$id_bus = vigenereCipher($nomor_plat_kendaraan, 'encrypt'); // Mengenkrispi dengan Algoritma Vignere Chipper
		$data = array(
			'id_bus' => $id_bus,
			'nomor_plat_kendaraan' => strtoupper($nomor_plat_kendaraan),
			'jenis_angkutan' => $jenis_angkutan,
			'nama_po' => $nama_po,
			'trayek' => $trayek
		);
		$this->Global_model->insert('master_bus', $data);
		$this->load->library('ciqrcode');
		$fill = $id_bus;
		$config['cacheable']    = true;
		$config['cachedir']     = './assets/';
		$config['errorlog']     = './assets/';
		$config['imagedir']     = '.' . QR_PATH;
		$config['quality']      = true;
		$config['size']         = '1024';
		$config['black']        = array(224, 255, 255);
		$config['white']        = array(70, 130, 180);
		$this->ciqrcode->initialize($config);
		$image_name = $id_bus . '.png';
		$params['data'] = $fill;
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH . $config['imagedir'] . $image_name;
		$this->ciqrcode->generate($params);
		responseOK("Berhasil");
	}
	public function delete_bus()
	{
		$id = $this->input->post('id');
		$param = array(
			'id_bus' => $id
		);
		$this->Global_model->delete('master_bus', $param);
		$this->Global_model->delete('rampcheck', $param);
		$QR_NAME = $id;
		if ($QR_NAME && file_exists('.' . QR_PATH . $QR_NAME)) {
			unlink('.' . QR_PATH . $QR_NAME);
		}
		responseOK("Berhasil");
	}
	public function edit_bus()
	{
		$id_bus = $this->input->post('id_bus');
		$nama_po = $this->input->post('nama_po');
		$jenis_angkutan = $this->input->post('jenis_angkutan');
		$trayek = $this->input->post('trayek');

		$where = array(
			'id_bus' => $id_bus
		);
		$data = array(
			'nama_po' => $nama_po,
			'jenis_angkutan' => $jenis_angkutan,
			'trayek' => $trayek
		);
		$this->Global_model->update('master_bus', $where, $data);
		responseOK("Berhasil");
	}
	public function add_sopir()
	{
		$data = array(
			'nama_sopir' => $this->input->post('nama_sopir', true),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'telepon' => $this->input->post('telepon'),
			'alamat' => $this->input->post('alamat'),
		);
		$this->Global_model->insert('master_sopir', $data);
		responseOK("Berhasil");
	}
	public function edit_sopir()
	{
		$data = array(
			'nama_sopir' => $this->input->post('nama_sopir'),
			'tgl_lahir' => $this->input->post('tgl_lahir'),
			'telepon' => $this->input->post('telepon'),
			'alamat' => $this->input->post('alamat'),
		);
		$where = array(
			'id_sopir' => $this->input->post('id_sopir')
		);
		$this->Global_model->update('master_sopir', $where, $data);
		responseOK("Berhasil");
	}
	public function delete_sopir()
	{
		$id = $this->input->post('id');
		$param = array(
			'id_sopir' => $id
		);
		$this->Global_model->delete('master_sopir', $param);
		responseOK("Berhasil");
	}
	public function add_pengguna()
	{
		$username = $this->input->post('username', true);
		$data = array(
			'username' => $username,
			'password' => $this->input->post('password'),
			'nama' => $this->input->post('nama_lengkap'),
			'nip' => $this->input->post('nip'),
			'role' => $this->input->post('role'),
		);
		if (isUsernameExist($username)) {
			return responseBAD("Username '" . $username . "' Telah di gunakan !");
		}
		$this->Global_model->insert('user', $data);
		responseOK("Berhasil");
	}
	public function delete_pengguna()
	{
		$id = $this->input->post('id');
		$role = $this->input->post('role');
		$param = array(
			'id_user' => $id
		);
		if (isAdminLeftOne() && $role == 1) {
			return responseBAD("Pengguna admin Hanya tersisa 1 maka Tidak bisa di hapus !");
		}
		$this->Global_model->delete('user', $param);
		responseOK("Berhasil");
	}
	public function edit_pengguna()
	{
		$data = array(
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'nama' => $this->input->post('nama_lengkap'),
			'nip' => $this->input->post('nip'),
			'role' => $this->input->post('role'),
		);
		$where = array(
			'id_user' => $this->input->post('id_user')
		);
		$this->Global_model->update('user', $where, $data);
		responseOK("Berhasil");
	}
	public function edit_struktural()
	{
		$nama_penyidik = $this->input->post('nama_penyidik');
		$nip_penyidik = $this->input->post('nip_penyidik');
		$this->db->query("INSERT INTO master_struktural (id_struktural, nama_penyidik, nip_penyidik) VALUES(1, '$nama_penyidik', '$nip_penyidik') ON DUPLICATE KEY UPDATE nama_penyidik='$nama_penyidik', nip_penyidik='$nip_penyidik'");
		responseOK("Berhasil");
	}
}
