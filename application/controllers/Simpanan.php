<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simpanan extends CI_Controller {

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
		$this->load->model('simpanan_model');
	}
	public function tabel_simpanan_pokok(){
		$data['ambil'] = $this->simpanan_model->tampil_simpanan_pokok()->result();
		$this->load->view('simpanan/tampil_simpanan_pokok',$data);
	}
	public function tabel_simpanan_wajib(){
		$this->load->database();
		$tgl_awal = date('Y-m-01');
		$tgl_akhir = date('Y-m-t');
		$sql = "SELECT * FROM anggota WHERE status_keluar='1' AND id_anggota NOT IN (SELECT id_anggota FROM simpanan WHERE kode_kategori_simpanan ='KTS002' AND tgl_simpanan BETWEEN '$tgl_awal' AND '$tgl_akhir')";
		$query = $this->db->query($sql);
		$data['belum_bayar'] = $query->result();
		$data['ambil'] = $this->simpanan_model->tampil_simpanan_wajib()->result();
		$this->load->view('simpanan/tampil_simpanan_wajib',$data);
	}
	public function tabel_simpanan_sukarela(){
		$data['ambil'] = $this->simpanan_model->tampil_simpanan_sukarela()->result();
		$this->load->view('simpanan/tampil_simpanan_sukarela',$data);
	}
	public function input_simpanan_wajib(){
		$data['kode'] = $this->simpanan_model->buat_kode();
		$data['ambil'] = $this->simpanan_model->tampil_anggota_wajib()->result();
		$this->load->view('simpanan/input_simpanan_wajib',$data);
	}
	public function input_simpanan_sukarela(){
		$data['kode'] = $this->simpanan_model->buat_kode();
		$data['ambil'] = $this->simpanan_model->tampil_anggota_sukarela()->result();
		$this->load->view('simpanan/input_simpanan_sukarela',$data);

	}
	public function hapus_simpanan_wajib($id){
		$where = array('id_simpanan' => $id);
		$this->simpanan_model->hapus_data($where,'simpanan');
		redirect('simpanan_wajib');
	}
	public function hapus_simpanan_pokok($id){
		$where = array('id_simpanan' => $id);
		$this->simpanan_model->hapus_data($where,'simpanan');
		redirect('simpanan_pokok');
	}
	public function insert_simpanan_sukarela(){
		$id_anggota = $this->input->post('id_anggota');
		$tgl = date('Y-m-d');
		$data = array(
		'id_simpanan' => $this->input->post('id_simpanan'),
		'kode_kategori_simpanan' => $this->input->post('kode_kategori_simpanan'),
		'id_anggota' => $id_anggota,
		'tgl_simpanan' => $tgl,
		'besar_simpanan' => $this->input->post('besar_simpanan'),
		'ket_simpanan' => $this->input->post('ket_simpanan')
			);
		$data_rekap = array(
		'id_rekap' => NULL,
		'id_anggota' => $id_anggota,
		'kategori' => 'Pemasukan',
		'tgl_rekap' => $tgl,
		'nominal' => $this->input->post('besar_simpanan'),
		'ket' => 'Menabung Simpanan Sukarela'
			);
		$this->simpanan_model->input_data($data_rekap,'rekap');
		$this->simpanan_model->input_data($data,'simpanan');

		$this->load->database();
		$query = $this->db->query("SELECT * FROM simpanan INNER JOIN anggota ON anggota.id_anggota=simpanan.id_anggota");
		$row = $query->result_array();
		$id_anggota = $row[0]['nama'];
		$data['tanggal'] = $tgl;
		$data['id_simpanan'] = $this->input->post('id_simpanan');
		$data['id_anggota'] = $id_anggota;
		$data['nominal'] = $this->input->post('besar_simpanan');
		$html=$this->load->view('simpanan/print_sukarela_awal', $data, true);
 
        //this the the PDF filename that user will get to download
        $pdfFilePath = "asd.pdf";
        
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I"); 

		
	}
	public function tambah_simpanan_sukarela($id){
		$where = array('id_simpanan' => $id);
		$data['ambil'] = $this->simpanan_model->edit_data($where,'simpanan')->result();
		$this->load->view('simpanan/tambah_simpanan_sukarela',$data); 
	}
	public function	ambil_simpanan_sukarela($id){
		$where = array('id_simpanan' => $id);
		$data['ambil'] = $this->simpanan_model->edit_data($where,'simpanan')->result();
		$this->load->view('simpanan/ambil_simpanan_sukarela',$data); 
	}
	public function print_wajib($id){
		$this->load->database();
		$where = array('id_simpanan' => $id);
		$sql = "SELECT * FROM simpanan INNER JOIN anggota ON anggota.id_anggota=simpanan.id_anggota INNER JOIN kategori_simpanan ON kategori_simpanan.kode_kategori_simpanan=simpanan.kode_kategori_simpanan WHERE id_simpanan='$id'";
		$query = $this->db->query($sql);
		$data['ambil'] = $query->result();
		$html=$this->load->view('simpanan/print_wajib', $data, true);
 		
        //this the the PDF filename that user will get to download
        $pdfFilePath = "blbla.pdf";
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
	}
	public function print_pokok($id){
		$this->load->database();
		$where = array('id_simpanan' => $id);
		$sql = "SELECT * FROM simpanan INNER JOIN anggota ON anggota.id_anggota=simpanan.id_anggota INNER JOIN kategori_simpanan ON kategori_simpanan.kode_kategori_simpanan=simpanan.kode_kategori_simpanan WHERE id_simpanan='$id'";
		$query = $this->db->query($sql);
		$data['ambil'] = $query->result();
		$html=$this->load->view('simpanan/print_pokok', $data, true);
 		
        //this the the PDF filename that user will get to download
        $pdfFilePath = "blbla.pdf";
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
	}
	public function tabung_sukarela(){
		$tgl = date('Y-m-d');
		$tambahan = $this->input->post('tambahan');
		$id_simpanan = $this->input->post('id_simpanan');
		$kode_kategori_simpanan = $this->input->post('kode_kategori_simpanan');
		$id_anggota = $this->input->post('id_anggota');
		$total_tabungan = $this->input->post('total_tabungan');
		$ket = 'Simpanan Sukarela';
		$where = array('id_simpanan' => $id_simpanan);
		$data = array(
		'kode_kategori_simpanan' => $kode_kategori_simpanan,
		'id_anggota' => $id_anggota,
		'tgl_simpanan' => $tgl,
		'besar_simpanan' => $total_tabungan,
		'ket_simpanan' => $ket
			);
		$data_rekap = array(
		'id_rekap' => NULL,
		'id_anggota' => $id_anggota,
		'kategori' => 'Pemasukan',
		'tgl_rekap' => $tgl,
		'nominal' => $tambahan,
		'ket' => 'Menabung Simpanan Sukarela'
			);
		$this->simpanan_model->input_data($data_rekap,'rekap');
		$this->simpanan_model->update_data($where,$data,'simpanan');
		$data['ambil'] = $this->simpanan_model->print_sukarela()->result();
		$datas = $this->simpanan_model->print_sukarela()->result_array();
		$id = $datas[0]['nama'];
		$ke = $datas[0]['tgl_simpanan'];
		$data['blabla'] = $tambahan;
		// $datas = $this->simpanan_model->print_sukarela()->result_array();
		// $id = $datas[0][''];

		$html=$this->load->view('simpanan/print_sukarela', $data, true);
 
        //this the the PDF filename that user will get to download
        $pdfFilePath = "".$id."_simpanan sukarela_".$ke.".pdf";
        
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I"); 

	}
	public function ambil_sukarela(){
		$tgl = date('Y-m-d');
		$tambahan = $this->input->post('tambahan');
		$id_simpanan = $this->input->post('id_simpanan');
		$kode_kategori_simpanan = $this->input->post('kode_kategori_simpanan');
		$id_anggota = $this->input->post('id_anggota');
		$total_tabungan = $this->input->post('total_tabungan');
		$ket = 'Simpanan Sukarela';
		$where = array('id_simpanan' => $id_simpanan);
		$data = array(
		'kode_kategori_simpanan' => $kode_kategori_simpanan,
		'id_anggota' => $id_anggota,
		'tgl_simpanan' => $tgl,
		'besar_simpanan' => $total_tabungan,
		'ket_simpanan' => $ket
			);
		$data_rekap = array(
		'id_rekap' => NULL,
		'id_anggota' => $id_anggota,
		'kategori' => 'Pengeluaran',
		'tgl_rekap' => $tgl,
		'nominal' => $tambahan,
		'ket' => 'Pengambilan Simpanan Sukarela'
			);
		$this->simpanan_model->input_data($data_rekap,'rekap');
		$this->simpanan_model->update_data($where,$data,'simpanan');
		$data['ambil'] = $this->simpanan_model->print_sukarela()->result();
		$datas = $this->simpanan_model->print_sukarela()->result_array();
		$id = $datas[0]['nama'];
		$ke = $datas[0]['tgl_simpanan'];
		$data['blabla'] = $tambahan;
		// $datas = $this->simpanan_model->print_sukarela()->result_array();
		// $id = $datas[0][''];

		$html=$this->load->view('simpanan/ambil_sukarela', $data, true);
 
        //this the the PDF filename that user will get to download
        $pdfFilePath = "".$id."_ambil sukarela_".$ke.".pdf";
        
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I"); 
	}
	
	public function input_aksi_wajib(){

		$id_anggota = $this->input->post('id_anggota');
		$tgl = date('Y-m-d');
			$data = array(
		'id_simpanan' => $this->input->post('id_simpanan'),
		'kode_kategori_simpanan' => $this->input->post('kode_kategori_simpanan'),
		'id_anggota' => $id_anggota,
		'tgl_simpanan' => $tgl,
		'besar_simpanan' => $this->input->post('besar_simpanan'),
		'ket_simpanan' => 'Pembayaran Simpanan Wajib'
			);
			$data_rekap =array(
			'id_rekap' => NULL,
			'id_anggota' => $id_anggota,
			'kategori' => 'Pemasukan',
			'tgl_rekap' => $tgl,
			'nominal' => $this->input->post('besar_simpanan'),
			'ket' => 'Pembayaran Simpanan Wajib'	
				);
		$this->simpanan_model->input_data($data,'simpanan');
		$this->simpanan_model->input_data($data_rekap,'rekap');
		redirect('simpanan_wajib');
		}
		
}