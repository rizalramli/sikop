<?php 
	Class User_model extends CI_Model{
		function buat_kode_user()   {    
	  $this->db->select('RIGHT(user.id_user,2) as kode', FALSE);
	  $this->db->order_by('id_user','DESC');    
	  $this->db->limit(1);     
	  $query = $this->db->get('user');      //cek dulu apakah ada sudah ada kode di tabel.    
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
	  $kodejadi = "USR".$kodemax;     
	  return $kodejadi;  
	 }
	 function buat_kode_petugas()   {    
	  $this->db->select('RIGHT(petugas.id_petugas,2) as kode', FALSE);
	  $this->db->order_by('id_petugas','DESC');    
	  $this->db->limit(1);     
	  $query = $this->db->get('petugas');      //cek dulu apakah ada sudah ada kode di tabel.    
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
	  $kodejadi = "PTG".$kodemax;     
	  return $kodejadi;  
	 }
		public function tampil_data(){
			return $this->db->get('user');
		}
		public function tampil_anggota(){
			$query = $this->db->query("SELECT * FROM anggota WHERE status_keluar='1' AND id_anggota NOT IN (SELECT id_anggota FROM petugas)");
			return $query;
		}
		public function input_data($data,$table){
			$this->db->insert($table,$data);
		}
		public function hapus_data($where,$table){
		$this->db->where($where);
		$this->db->delete($table);
		}
		public function edit_data($where,$table){
			return $this->db->get_where($table,$where);
		}
		public function update_data($where,$data,$table){
			$this->db->where($where);
			$this->db->update($table,$data);
		}
	}