<?php
	Class Kategori_simpanan_model Extends CI_Model{
		function buat_kode()   {    
	  $this->db->select('RIGHT(kategori_simpanan.kode_kategori_simpanan,2) as kode', FALSE);
	  $this->db->order_by('kode_kategori_simpanan','DESC');    
	  $this->db->limit(1);     
	  $query = $this->db->get('kategori_simpanan');      //cek dulu apakah ada sudah ada kode di tabel.    
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
	  $kodejadi = "KTS".$kodemax;     
	  return $kodejadi;  
	 }
		public function tampil_data(){
			return $this->db->get('kategori_simpanan');
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