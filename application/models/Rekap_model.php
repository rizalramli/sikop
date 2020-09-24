<?php 
	Class Rekap_model extends CI_Model{
		public function tampil_data(){
			$query = $this->db->query("SELECT * FROM rekap INNER JOIN anggota ON anggota.id_anggota=rekap.id_anggota");
			return $query;
		}
	}