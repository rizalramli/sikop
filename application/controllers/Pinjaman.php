<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pinjaman extends CI_Controller {

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
		$this->load->model('pinjaman_model');

	}
	public function tabel_pinjaman()
	{
		$data['ambil'] = $this->pinjaman_model->tampil_data()->result();
		$this->load->view('pinjaman/tampil_pinjaman',$data);
	}
	public function input_pinjaman(){
		$data['ambil'] = $this->pinjaman_model->tampil_anggota()->result();
		$data['ambils'] = $this->pinjaman_model->tampil_kategori_pinjaman()->result();
		$data['kode'] = $this->pinjaman_model->buat_kode();
		$this->load->view('pinjaman/input_pinjaman',$data);
	}
	public function input_aksi(){
		$datas = $this->pinjaman_model->tampil_persentase()->result_array();
		$persentase_pinjaman = $datas[0]['persentase_pinjaman'];
		$besar_pinjaman = $this->input->post('besar_pinjaman');
		$idanggota = $this->input->post('id_anggota');
		$tenor = $this->input->post('tenor'); 
		// $persentase = $persentase_pinjaman / '12';
		$angsuran_pokok_per_bulan = $besar_pinjaman / $tenor;
		$angsuran_bunga_per_bulan = $besar_pinjaman * $persentase_pinjaman / '100';
		$angsuran_total_per_bulan = $angsuran_pokok_per_bulan + $angsuran_bunga_per_bulan;
		$total_pinjaman = $angsuran_total_per_bulan * $tenor;
		$tgl_pelunasan = '';
		$status_pinjaman = 'Belum Lunas';
		$tgl_pinjaman = date('Y-m-d');
		$data_pinjaman = array(
			'id_pinjaman' => $this->input->post('id_pinjaman'),
			'id_anggota' => $this->input->post('id_anggota'),
			'kode_kategori_pinjaman' => $this->input->post('kode_kategori_pinjaman'),
			'besar_pinjaman' => $besar_pinjaman,
			'total_pinjaman' => $total_pinjaman,
			'tgl_pengajuan_pinjaman' => $this->input->post('tgl_pengajuan_pinjaman'),
			'tgl_acc_pinjaman' => $this->input->post('tgl_acc_pinjaman'),
			'tgl_pinjaman' => $tgl_pinjaman,
			'tgl_pelunasan' => $tgl_pelunasan,
			'tenor' => $tenor,
			'sisa' => $total_pinjaman,
			'status_pinjaman' => $status_pinjaman,
			'ket_pinjaman' => $this->input->post('ket_pinjaman')
			);
		$data_rekap = array(
			'id_rekap' => NULL,
			'id_anggota' => $this->input->post('id_anggota'),
			'kategori' => 'Pengeluaran',
			'tgl_rekap' => $tgl_pinjaman,
			'nominal' => $besar_pinjaman,
			'ket' => 'Peminjaman Uang'
			);
		$this->pinjaman_model->input_data($data_rekap,'rekap');
		$this->pinjaman_model->input_data($data_pinjaman,'pinjaman');

		$this->load->database();
		$query = $this->db->query("SELECT * FROM pinjaman INNER JOIN anggota ON anggota.id_anggota=pinjaman.id_anggota WHERE pinjaman.id_anggota='$idanggota' ORDER BY id_pinjaman DESC");
		$datax = $query->result_array();
		$data['nama'] = $datax[0]['nama'];  
		$data['idpinjam'] = $datax[0]['id_pinjaman'];  
		$data['tgl_pinjaman'] = $datax[0]['tgl_pinjaman'];  
		$data['besar_pinjaman'] = $datax[0]['besar_pinjaman'];  
		$data['total_pinjaman'] = $datax[0]['total_pinjaman'];  
		$data['tenor'] = $datax[0]['tenor'];  
		$html=$this->load->view('pinjaman/print_pinjaman', $data, true);
 
        //this the the PDF filename that user will get to download
        $pdfFilePath = "asd.pdf";
        
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I"); 
	for ($a=1; $a<=$tenor; $a++){
		$kodejadi = $this->pinjaman_model->buat_kodes();
	  $tgl_jatuh_tempo = date('Y-m-d',strtotime('+'.$a.' month', strtotime($tgl_pinjaman)));
	  $data_angsuran = array(
	  'id_angsuran' => $kodejadi,
	  'id_pinjaman' => $this->input->post('id_pinjaman'),
	  'tgl_pembayaran' => '',
	  'angsuran_ke' => $a,
	  'besar_angsuran' => $angsuran_pokok_per_bulan,
	  'besar_angsuran_bunga' => $angsuran_bunga_per_bulan,
	  'ket_angsuran' => 'Belum Lunas',
	  'tgl_jatuh_tempo' => $tgl_jatuh_tempo,
			);
	  $this->pinjaman_model->input_data($data_angsuran,'angsuran');
	}
	$where_status_anggota = array('id_anggota' => $this->input->post('id_anggota'));
	$data_update = array(
		'status_anggota' => 'Sedang Pinjam',
		);
	$this->pinjaman_model->update_data($where_status_anggota,$data_update,'anggota');
	redirect('pinjaman');
	}
	
	public function hapus_pinjaman($id){
		$where = array('id_pinjaman' => $id);
		$this->pinjaman_model->hapus_data($where,'pinjaman');
		redirect('pinjaman');
	}
	public function detail_pinjaman($id){
		$this->load->database();
		$where = array('id_pinjaman' => $id);
		$data['detail'] = $this->pinjaman_model->detail_data($where,'angsuran')->result();
		$sql = "SELECT * FROM pinjaman INNER JOIN anggota ON anggota.id_anggota=pinjaman.id_anggota INNER JOIN kategori_pinjaman ON kategori_pinjaman.kode_kategori_pinjaman=pinjaman.kode_kategori_pinjaman WHERE id_pinjaman='$id'";
		$query = $this->db->query($sql);
		$data['details'] = $query->result();
		$this->load->view('pinjaman/detail_pinjaman',$data);
	}
	public function angsuran(){
		$where_angsuran = array('id_angsuran' => $this->input->post('angsuran'));
		$data_angsuran = $this->pinjaman_model->tampil_angsuran()->result_array();
		$id_pinjaman = $data_angsuran[0]['id_pinjaman'];
		$id_anggota = $data_angsuran[0]['id_anggota'];
		$sisa = $data_angsuran[0]['sisa'];
		$where_pinjaman = array('id_pinjaman' => $id_pinjaman);
		$penambahan = $data_angsuran[0]['besar_angsuran'] + $data_angsuran[0]['besar_angsuran_bunga'];
		$pengurangan = $sisa - $penambahan;
		$tgl_sekarang = date('Y-m-d');
		$update_angsuran = array(
			'ket_angsuran' => 'Lunas',
			'tgl_pembayaran' => $tgl_sekarang,
			'sisa_pinjaman' => $pengurangan,
			);
		$update_pinjaman = array(
			'sisa' => $pengurangan
			);
		$data_rekap = array(
			'id_rekap' => NULL,
			'id_anggota' => $id_anggota,
			'kategori' => 'Pemasukan',
			'tgl_rekap' => $tgl_sekarang,
			'nominal' => $penambahan,
			'ket' => 'Pembayaran Angsuran'
			);
		$this->pinjaman_model->input_data($data_rekap,'rekap');
		$this->pinjaman_model->update_data($where_angsuran,$update_angsuran,'angsuran');
		$this->pinjaman_model->update_data($where_pinjaman,$update_pinjaman,'pinjaman');


		if ($pengurangan < '500'){
		$this->load->database();
		$sql = "SELECT * FROM `angsuran` WHERE id_pinjaman='$id_pinjaman' ORDER BY id_angsuran DESC LIMIT 1";
		$query = $this->db->query($sql);
		$data = $query->result_array();
		$sisa_pinjam = $data[0]['id_angsuran'];
		if ($sisa_pinjam==$where_angsuran) {
			$pengurangan = '0';

		}

		$row_pinjaman = $this->pinjaman_model->detail_data($where_pinjaman,'pinjaman')->result_array();
		$row_id_anggota = $row_pinjaman[0]['id_anggota'];
		$where_id_anggota = array('id_anggota' => $row_id_anggota);
		$update_sisa_pinjaman = array(
			'status_pinjaman' => 'Lunas',
			'tgl_pelunasan' => $tgl_sekarang, 
			'sisa' => '0'
			);
		$update_status_anggota = array(
			'status_anggota' => 'Belum Pinjam'
			);
		$update_angsuran = array(
			'sisa_pinjaman' => '0' 
			);

			$this->pinjaman_model->update_data($where_id_anggota,$update_status_anggota,'anggota');
			$this->pinjaman_model->update_data($where_angsuran,$update_angsuran,'angsuran');
			$this->pinjaman_model->update_data($where_pinjaman,$update_sisa_pinjaman,'pinjaman');
		}
		redirect('pinjaman/detail_pinjaman/'.$id_pinjaman);
	}
	public function print_angsuran(){
		$data['angsuran'] = $this->pinjaman_model->tampil_print()->result();
		$datas = $this->pinjaman_model->tampil_print()->result_array();

		$id = $datas[0]['nama'];
		$ke = $datas[0]['angsuran_ke'];
		$html=$this->load->view('pinjaman/print_angsuran', $data, true);
 
        //this the the PDF filename that user will get to download
        $pdfFilePath = "".$id." angsuran ke-".$ke.".pdf";
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I"); 

	}
}
