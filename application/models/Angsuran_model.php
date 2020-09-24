<?php 
	Class Angsuran_model Extends CI_Model{
		function buat_kode()   {    
	  $this->db->select('RIGHT(angsuran.id_angsuran,2) as kode', FALSE);
	  $this->db->order_by('id_angsuran','DESC');    
	  $this->db->limit(1);     
	  $query = $this->db->get('angsuran');      //cek dulu apakah ada sudah ada kode di tabel.    
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
	  $kodejadi = "AGS".$kodemax;     
	  return $kodejadi;  
	 }
		public function tampil_data(){
			return $this->db->get('angsuran');
		}
		public function tampil_pinjaman(){
			$query = $this->db->query("SELECT id_pinjaman,pinjaman.status_pinjaman,anggota.nama FROM pinjaman INNER JOIN anggota ON anggota.id_anggota=pinjaman.id_anggota WHERE status_pinjaman='Belum Lunas'");
			return $query;
		}
		public function input_data($data,$table){
			$this->db->insert($table,$data);
		}
		public function tampil_id_pinjaman(){
			$id_pinjaman = $this->input->post('id_pinjaman');
			$query = $this->db->query("SELECT * FROM pinjaman where id_pinjaman='$id_pinjaman'");
			return $query;
		}
		public function update_data_pinjaman($where,$data,$table){
		$this->db->where($where);
		$this->db->update($table,$data);
		}
	}


	