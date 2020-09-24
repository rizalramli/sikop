<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota extends CI_Controller {

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
		$this->load->model('anggota_model');

	}
	public function tabel_anggota()
	{
		$this->load->database();
		$sql = $this->db->query("SELECT * FROM anggota WHERE status_keluar='1'");
		$data['ambil'] = $sql->result();
		$this->load->view('anggota/tampil_anggota',$data);
	}
	public function input_anggota(){
		$data['kode'] = $this->anggota_model->buat_kode();
		$this->load->view('anggota/input_anggota',$data);
	}
	public function input_aksi(){
		$tgl_lahir = $this->input->post('tahun')."-".$this->input->post('bulan')."-".$this->input->post('tanggal');
		$config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 0;
                $config['max_width']            = 0;
                $config['max_height']           = 0;
                $config['file_name'] = $_FILES['foto']['name'];

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('foto'))
                {
                        redirect('input_anggota');
                }
                else
                {
                		$uploadData = $this->upload->data();
                		$picture = $uploadData['file_name'];

						$data = array(
						'id_anggota' => $this->input->post('id_anggota'),
						'nama' => $this->input->post('nama'),
						'alamat' => $this->input->post('alamat'),
						'no_tlp' => $this->input->post('no_tlp'),
						'tempat_lahir' => $this->input->post('tempat_lahir'),
						'tgl_lahir' => $tgl_lahir,
						'jen_kel' => $this->input->post('jen_kel'),
						'status_anggota' => 'Belum Pinjam',
						'kets' => $this->input->post('ket'),
						'foto' => $picture,
						'status_keluar' => '1'
							);
						$kodes = $this->anggota_model->buat_kodes();
						$tgl = date('Y-m-d');
						$data_simpanan = array(
						'id_simpanan' => $kodes,
						'kode_kategori_simpanan' => 'KTS001',
						'id_anggota' => $this->input->post('id_anggota'),
						'tgl_simpanan' => $tgl,
						'besar_simpanan' => '50000',
						'ket_simpanan' => 'Uang Pendaftaran'
							);
						$data_rekap = array(
						'id_rekap' => NULL,
						'id_anggota' => $this->input->post('id_anggota'),
						'kategori' => 'Pemasukan',
						'tgl_rekap' => $tgl,
						'nominal' => '50000',
						'ket' => 'Pembayaran Simpanan Pokok'
							);
						$this->anggota_model->input_data($data,'anggota');
						$this->anggota_model->input_data($data_simpanan,'simpanan');
						$this->anggota_model->input_data($data_rekap,'rekap');
						redirect('simpanan_pokok');
                }
	}
	public function hapus_anggota($id){
		$where = array('id_anggota' => $id);
		$this->anggota_model->hapus_data($where,'anggota'); 
		redirect('anggota');
	}
	public function edit_anggota($id){
		$where = array('id_anggota' => $id);
		$data['ambil'] = $this->anggota_model->edit_data($where,'anggota')->result();
		$this->load->view('anggota/edit_anggota',$data);
	}
	public function detail_anggota($id){
		$where =array('id_anggota' => $id);
		$data['ambil'] = $this->anggota_model->edit_data($where,'anggota')->result();
		$this->load->view('anggota/detail_anggota',$data);
	}
	public function update_anggota(){
		$data = array(
		'nama' => $this->input->post('nama'),
		'alamat' => $this->input->post('alamat'),
		'no_tlp' => $this->input->post('no_tlp'),
		'tempat_lahir' => $this->input->post('tempat_lahir'),
		'tgl_lahir' => $this->input->post('tgl_lahir'),
		'jen_kel' => $this->input->post('jen_kel'),
		'kets' => $this->input->post('ket')
			);
		$where = array('id_anggota' => $this->input->post('id_anggota'));
		$this->anggota_model->update_data($where,$data,'anggota');
		redirect('anggota');
	}
	public function print_anggota($id){
		$where = array('id_anggota' =>$id);
		$data['ambil'] = $this->anggota_model->edit_data($where,'anggota')->result();
		$datas= $this->anggota_model->edit_data($where,'anggota')->result_array();
		$anggota = $datas[0]['nama'];
		$html=$this->load->view('anggota/print_anggota', $data, true);
 		
        //this the the PDF filename that user will get to download
        $pdfFilePath = "$anggota.pdf";
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");
	}
	public function keluar_anggota($id){
		$this->load->database();

		$sql10 = $this->db->query("SELECT * FROM simpanan WHERE kode_kategori_simpanan='KTS001' AND id_anggota='$id'");
		$query10 = $sql10->result_array();
		$data['pokok'] = $query10[0]['besar_simpanan'];

		$sql = $this->db->query("SELECT * FROM simpanan INNER JOIN anggota ON anggota.id_anggota=simpanan.id_anggota WHERE kode_kategori_simpanan='KTS003' AND simpanan.id_anggota='$id'");
		$query = $sql->result_array();
		$data['nama_anggota'] = $query[0]['nama'];
		$data['total_sukarela'] = $query[0]['besar_simpanan'];
		$data['id_anggota'] = $query[0]['id_anggota'];

		$sql2 = $this->db->query("SELECT SUM(besar_simpanan) AS total_wajib FROM simpanan WHERE kode_kategori_simpanan='KTS002' AND id_anggota='$id'");
		$query2 = $sql2->result_array();
		$data['total_wajib'] = $query2[0]['total_wajib'];

		$where = array('id_anggota' => $id);
		$update_anggota = array(
			'status_keluar' => '0'
			);
		$this->anggota_model->update_data($where,$update_anggota,'anggota');

		$nominal = $query10[0]['besar_simpanan'] + $query[0]['besar_simpanan'] + $query2[0]['total_wajib'];
		$tgl = date('Y-m-d');
		$data_rekap = array(
			'id_rekap' => NULL,
			'id_anggota' => $id,
			'kategori' => 'Pengeluaran',
			'tgl_rekap' => $tgl,
			'nominal' => $nominal,
			'ket' => 'Pengeluaran Anggota'
			);
		$this->anggota_model->input_data($data_rekap,'rekap');

		$html=$this->load->view('anggota/keluar_anggota', $data, true);
 		
        //this the the PDF filename that user will get to download
        $pdfFilePath = "blabla.pdf";
 
        //load mPDF library
        $this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->m_pdf->pdf->WriteHTML($html);
 
        //download it.
        $this->m_pdf->pdf->Output($pdfFilePath, "I");

		$sql3 = $this->db->query("DELETE FROM simpanan WHERE kode_kategori_simpanan='KTS002' AND id_anggota='$id'");
		$sql4 = $this->db->query("DELETE FROM simpanan WHERE kode_kategori_simpanan='KTS003' AND id_anggota='$id'");
		$sql8 = $this->db->query("DELETE FROM simpanan WHERE kode_kategori_simpanan='KTS001' AND id_anggota='$id'");
		$sql5 = $this->db->query("SELECT * FROM petugas where id_anggota='$id'");
		$query5 = $sql5->result_array();
		$data_petugas = $query5[0]['id_petugas'];
		$sql6 = $this->db->query("DELETE FROM user where id_petugas='$data_petugas'");
		$sql7 = $this->db->query("DELETE FROM petugas where id_petugas='$data_petugas'");


		
	}
	
}
