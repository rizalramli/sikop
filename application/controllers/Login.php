<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
		$this->load->model('login_model');

	}
	public function index()
	{
		$this->load->view('login');
	}
	public function aksi_login(){
		$where = array(
		'username' => $this->input->post('username'),
		'password' => $this->input->post('password')
			);
		$cek = $this->login_model->cek_login('user',$where);
		if($cek->num_rows() > 0){
			foreach($cek->result() as $row){
				$username = $row->username;
				$level = $row->level;
				$password = $row->password;
				$id_users = $row->id_user;

			}

			$data_session = array(
				'nama' => $this->input->post('username'),
				'level' => $level,
				'password' => $password,
				'id_user' => $id_users,
				'status' => "login"
				);

			$this->session->set_userdata($data_session);

			redirect(base_url("dashboard"));

		}else{
			$this->load->view('error_login');
		}
	}
	public function logout(){
	$this->session->sess_destroy();
	redirect(base_url('login'));
	}
	public function dashboard(){
		$this->load->view('dashboard');
	}
}
