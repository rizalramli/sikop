<?php
	Class Pinjaman_model extends CI_Model{
		function buat_kode()   {    
	  $this->db->select('RIGHT(pinjaman.id_pinjaman,2) as kode', FALSE);
	  $this->db->order_by('id_pinjaman','DESC');    
	  $this->db->limit(1);     
	  $query = $this->db->get('pinjaman');      //cek dulu apakah ada sudah ada kode di tabel.    
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
	  $kodejadi = "PJM".$kodemax;     
	  return $kodejadi;  
	 }
	 function buat_kodes()   {    
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
			$query = $this->db->query("SELECT anggota.nama,kategori_pinjaman.nama_pinjaman,pinjaman.id_pinjaman,besar_pinjaman,total_pinjaman,tgl_pinjaman,tgl_pelunasan,tenor,sisa,status_pinjaman FROM pinjaman INNER JOIN anggota ON anggota.id_anggota=pinjaman.id_anggota INNER JOIN kategori_pinjaman ON kategori_pinjaman.kode_kategori_pinjaman=pinjaman.kode_kategori_pinjaman");
			return $query;
		}
		public function tampil_anggota(){
			$query = $this->db->query("SELECT * FROM anggota WHERE status_anggota='Belum Pinjam' AND status_keluar='1'");
			return $query;
		}
		public function tampil_kategori_pinjaman(){
			return $this->db->get('kategori_pinjaman');
		}
		public function tampil_persentase(){
			$kode = $this->input->post('kode_kategori_pinjaman');
			$query = $this->db->query("SELECT * FROM kategori_pinjaman WHERE kode_kategori_pinjaman='$kode'");
			return $query;
		}
		public function input_data($data,$table){
			$this->db->insert($table,$data);
		}
		public function detail_data($where,$table){
			return $this->db->get_where($table,$where);
		}
		public function hapus_data($where,$table){
			$this->db->where($where);
			$this->db->delete($table);
		}
		public function update_data($where,$data,$table){
			$this->db->where($where);
			$this->db->update($table,$data);
		}
		public function tampil_angsuran(){
			$id_angsuran = $this->input->post('angsuran');
			$query = $this->db->query("SELECT * FROM angsuran INNER JOIN pinjaman ON angsuran.id_pinjaman=pinjaman.id_pinjaman INNER JOIN anggota ON anggota.id_anggota=pinjaman.id_anggota WHERE id_angsuran='$id_angsuran'");
			return $query;
		}
		public function tampil_print(){
			$where_angsuran = $this->input->post('angsuran');
			$query = $this->db->query("SELECT * FROM angsuran INNER JOIN pinjaman ON pinjaman.id_pinjaman=angsuran.id_pinjaman INNER JOIN anggota ON anggota.id_anggota=pinjaman.id_anggota INNER JOIN kategori_pinjaman ON kategori_pinjaman.kode_kategori_pinjaman=pinjaman.kode_kategori_pinjaman WHERE id_angsuran='$where_angsuran'");
			return $query;
		}
	}