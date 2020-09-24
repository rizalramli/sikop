<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_pinjaman extends CI_Controller {

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
		$this->load->model('kategori_pinjaman_model');

	}
	public function tabel_kategori_pinjaman()
	{
		$data['ambil'] = $this->kategori_pinjaman_model->tampil_data()->result();
		$this->load->view('kategori_pinjaman/tampil_kategori_pinjaman',$data);
	}
	public function input_kategori_pinjaman(){
		$data['kode'] = $this->kategori_pinjaman_model->buat_kode();
		$this->load->view('kategori_pinjaman/input_kategori_pinjaman',$data);
	}
	public function input_aksi(){
		$data = array (
			'kode_kategori_pinjaman' => $this->input->post('kode_kategori_pinjaman'),
			'nama_pinjaman' => $this->input->post('nama_pinjaman'),
			'persentase_pinjaman' => $this->input->post('persentase_pinjaman')
			);
		$this->kategori_pinjaman_model->input_data($data,'kategori_pinjaman');
		redirect('kategori_pinjaman');
	}
	public function hapus_kategori_pinjaman($id){
		$where = array('kode_kategori_pinjaman' => $id);
		$this->kategori_pinjaman_model->hapus_data($where,'kategori_pinjaman');
		redirect('kategori_pinjaman');
	}
	public function edit_kategori_pinjaman($id){
		$where = array('kode_kategori_pinjaman' => $id);
		$data['ambil'] = $this->kategori_pinjaman_model->edit_data($where,'kategori_pinjaman')->result();
		$this->load->view('kategori_pinjaman/edit_kategori_pinjaman',$data);
	}
	public function update_kategori_pinjaman($id){
		$where = array('kode_kategori_pinjaman' => $this->input->post('kode_kategori_pinjaman'));
		$data = array(
			'nama_pinjaman' => $this->input->post('nama_pinjaman'),
			'persentase_pinjaman' => $this->input->post('persentase_pinjaman')
			);
		$this->kategori_pinjaman_model->update_data($where,$data,'kategori_pinjaman');
		redirect('kategori_pinjaman');
	}
}
