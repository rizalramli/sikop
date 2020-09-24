<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Welcome extends CI_Controller {
	public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->model('anggota_model');
        }

        public function index()
        {
                $this->load->view('welcome_message', array('error' => ' ' ));
        }

        public function do_upload()
        {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;
                $config['file_name'] = $_FILES['gambar']['name'];

                $this->load->library('upload', $config);
                $this->upload->initialize($config);

                if ( ! $this->upload->do_upload('gambar'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('welcome_message', $error);
                }
                else
                {
                		$uploadData = $this->upload->data();
                		$picture = $uploadData['file_name'];

                		$data = array(
                		'gambar' => $picture
                			);
		$this->anggota_model->input_data($data,'user');
		redirect('anggota');

                }
        }
}
 