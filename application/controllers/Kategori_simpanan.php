<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_simpanan extends CI_Controller {

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
		$this->load->model('kategori_simpanan_model');

	}
	public function tabel_kategori_simpanan()
	{
		$data['ambil'] = $this->kategori_simpanan_model->tampil_data()->result();
		$this->load->view('kategori_simpanan/tampil_kategori_simpanan',$data);
	}
	public function input_kategori_simpanan(){
		$data['kode'] = $this->kategori_simpanan_model->buat_kode();
		$this->load->view('kategori_simpanan/input_kategori_simpanan',$data);
	}
	public function input_aksi(){
		$data = array(
			'kode_kategori_simpanan' => $this->input->post('kode_kategori_simpanan'),
			'nama_simpanan' => $this->input->post('nama_simpanan')
			);
		$this->kategori_simpanan_model->input_data($data,'kategori_simpanan');
		redirect('kategori_simpanan');
	}
	public function hapus_kategori_simpanan($id){
		$where = array('kode_kategori_simpanan' => $id);
		$this->kategori_simpanan_model->hapus_data($where,'kategori_simpanan');
		redirect('kategori_simpanan');
	}
	public function edit_kategori_simpanan($id){
		$where = array('kode_kategori_simpanan' => $id);
		$data['ambil'] = $this->kategori_simpanan_model->edit_data($where,'kategori_simpanan')->result();
		$this->load->view('kategori_simpanan/edit_kategori_simpanan',$data);
	}
	public function update_kategori_simpanan(){
		$data = array(
			'nama_simpanan' => $this->input->post('nama_simpanan')
			);
		$where = array('kode_kategori_simpanan' => $this->input->post('kode_kategori_simpanan'));
		$this->kategori_simpanan_model->update_data($where,$data,'kategori_simpanan');
		redirect('kategori_simpanan');
	}
}
