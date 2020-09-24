<?php
	class Welcome_model extends CI_Model{
		public function tampil_data(){
		return $this->db->get('kategori_simpanan');
	}
}
