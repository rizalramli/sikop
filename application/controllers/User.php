<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('user_model');

	}
	public function tabel_user()
	{
		$data['ambil'] = $this->user_model->tampil_data()->result();
		$this->load->view('user/tampil_user',$data);
	}
	public function input_user(){
		$data['kode'] = $this->user_model->buat_kode_user();
		$data['kodes'] = $this->user_model->buat_kode_petugas();
		$data['ambil_anggota'] = $this->user_model->tampil_anggota()->result();
		$this->load->view('user/input_user',$data);
	}
	public function input_aksi(){
		$id_anggota = $this->input->post('id_anggota');
			$data_user = array(
			'id_user' => $this->input->post('id_user'),
			'id_petugas' => $this->input->post('id_petugas'),
			'username' => $this->input->post('username'),
			'password' => $this->input->post('password'),
			'level' => $this->input->post('level')
			);
		$data_petugas = array(
			'id_petugas' => $this->input->post('id_petugas'),
			'id_anggota' => $this->input->post('id_anggota')
			);
		$this->user_model->input_data($data_user,'user');
		$this->user_model->input_data($data_petugas,'petugas');
		redirect('user');
	}
	public function hapus_user($id){
		$where = array('id_petugas' => $id);
		$this->user_model->hapus_data($where,'user');
		$this->user_model->hapus_data($where,'petugas');
		redirect('user');
	}
	public function ubah_password($id){
		$where = array('id_user' => $id);
		$data['ambil'] = $this->user_model->edit_data($where,'user')->result();
		$this->load->view('user/ubah_password',$data);
	}
	public function update_password(){
		$password = $this->input->post('password');
		$password_lama = $this->input->post('password_lama');
		$password_baru = $this->input->post('password_baru');
		$konfirm_password = $this->input->post('konfirm_password');
		if ($password==$password_lama && $password_baru==$konfirm_password) {
			
		$where = array('id_user' => $this->input->post('id_user'));
		$data = array(
			'password' => $password_baru
			);
		$this->user_model->update_data($where,$data,'user');
		redirect('user');
		} else {
			$this->load->view('error_user');
		}

	}
}
