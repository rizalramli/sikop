<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends CI_Controller {

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
		$this->load->model('rekap_model');

	}
	public function tabel_rekap()
	{
		$data['ambil'] = $this->rekap_model->tampil_data()->result();
		$this->load->view('rekap/tampil_rekap',$data);
	}
	public function chart(){
		$this->load->database();
		$sql2 = "SELECT SUM(nominal) as total_pemasukan from rekap where kategori='Pemasukan'";
		$sql = "SELECT SUM(nominal) as total_pengeluaran from rekap where kategori='Pengeluaran'";
		$query = $this->db->query($sql);
		$query2 = $this->db->query($sql2);
		$data_pengeluaran = $query->result_array();
		$data_pemasukan = $query2->result_array();
		$data['pemasukan'] = $data_pemasukan[0]['total_pemasukan'];
		$data['pengeluaran'] = $data_pengeluaran[0]['total_pengeluaran'];
		$this->load->view('rekap/chart',$data);
	}
	public function	print_rekap(){
		$this->load->database();
		$tgl_awal = $this->input->post('tgl_awal');
		$tgl_akhir	= $this->input->post('tgl_akhir');
		$sql = $this->db->query("SELECT * FROM rekap INNER JOIN anggota ON anggota.id_anggota=rekap.id_anggota WHERE tgl_rekap BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY id_rekap ASC");
		$data['ambil'] = $sql->result();
		$data['tgl_awal'] = $tgl_awal; 
		$data['tgl_akhir'] = $tgl_akhir; 
		$html=$this->load->view('rekap/print_rekap', $data, true);
 
        //this the the PDF filename that user will get to download
        $pdfFilePath = "print_rekap.pdf";
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I"); 
	}
}
