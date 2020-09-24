<?php
	 Class Simpanan_model extends CI_Model{
	 	function buat_kode()   {    
	  $this->db->select('RIGHT(simpanan.id_simpanan,2) as kode', FALSE);
	  $this->db->order_by('id_simpanan','DESC');    
	  $this->db->limit(1);     
	  $query = $this->db->get('simpanan');      //cek dulu apakah ada sudah ada kode di tabel.    
	  if($query->num_rows() <> 0){       
	   //jika kode ternyata sudah ada.      
	   $data = $query->row();      
	   $kode = intval($data->kode) + 1;     
	  }
	  else{       
	   //jika kode belum ada      
	   $kode = 1;     
	  }
	  $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);    
	  $kodejadi = "SPM".$kodemax;     
	  return $kodejadi;  
	 }
	 public function hapus_data($where,$table){
			$this->db->where($where);
			$this->db->delete($table);
		}
	 	public function tampil_simpanan_pokok(){
	 		$query = $this->db->query("SELECT anggota.nama,kategori_simpanan.nama_simpanan,id_simpanan,tgl_simpanan,besar_simpanan,ket_simpanan FROM simpanan INNER JOIN anggota ON anggota.id_anggota=simpanan.id_anggota INNER JOIN kategori_simpanan ON kategori_simpanan.kode_kategori_simpanan=simpanan.kode_kategori_simpanan WHERE simpanan.kode_kategori_simpanan='KTS001'");
	 		return $query;
	 	}
	 	public function tampil_simpanan_wajib(){
	 		$query = $this->db->query("SELECT anggota.nama,kategori_simpanan.nama_simpanan,id_simpanan,tgl_simpanan,besar_simpanan,ket_simpanan FROM simpanan INNER JOIN anggota ON anggota.id_anggota=simpanan.id_anggota INNER JOIN kategori_simpanan ON kategori_simpanan.kode_kategori_simpanan=simpanan.kode_kategori_simpanan WHERE simpanan.kode_kategori_simpanan='KTS002'");
	 		return $query;
	 	}
	 	public function tampil_simpanan_sukarela(){
	 		$query = $this->db->query("SELECT anggota.nama,kategori_simpanan.nama_simpanan,id_simpanan,tgl_simpanan,besar_simpanan,ket_simpanan FROM simpanan INNER JOIN anggota ON anggota.id_anggota=simpanan.id_anggota INNER JOIN kategori_simpanan ON kategori_simpanan.kode_kategori_simpanan=simpanan.kode_kategori_simpanan WHERE simpanan.kode_kategori_simpanan='KTS003'");
	 		return $query;
	 	}

	 	public function tampil_anggota(){
	 		return $this->db->get('anggota');
	 	}
	 	public function input_data($data,$table){
	 		$this->db->insert($table,$data);
	 	}
	 	public function edit_data($where,$table){
	 		return $this->db->get_where($table,$where);
	 	}
	 	public function update_data($where,$data,$table){
	 		$this->db->where($where);
	 		$this->db->update($table,$data);
	 	}
	 	public function print_sukarela(){
	 		$where = $this->input->post('id_simpanan');
	 		$query = $this->db->query("SELECT * FROM simpanan INNER JOIN anggota ON anggota.id_anggota=simpanan.id_anggota INNER JOIN kategori_simpanan ON kategori_simpanan.kode_kategori_simpanan=simpanan.kode_kategori_simpanan WHERE id_simpanan='$where'");
	 		return $query;
	 	}
	 	public function tampil_anggota_sukarela(){
	 		$query = $this->db->query("SELECT * FROM anggota WHERE status_keluar='1' AND id_anggota NOT IN (SELECT id_anggota FROM simpanan WHERE kode_kategori_simpanan ='KTS003')");
	 		return $query;
	 	}
	 	public function tampil_anggota_wajib(){
	 		$tgl_awal = date('Y-m-01');
		$tgl_akhir = date('Y-m-t');
	 		$query = $this->db->query("SELECT * FROM anggota WHERE status_keluar='1' AND id_anggota NOT IN (SELECT id_anggota FROM simpanan WHERE kode_kategori_simpanan ='KTS002' AND tgl_simpanan BETWEEN '$tgl_awal' AND '$tgl_akhir')");
	 		return $query;
	 	}
	 }