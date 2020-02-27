<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_auth');
    }

    public function index() {
        $session = $this->session->userdata('status');
        if ($session == '') {
            $this->load->view('login');
        } else {
            redirect('Home');
        }
    }

    public function login() {
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[15]');
        $this->form_validation->set_rules('password', 'Password', 'required');
        if ($this->form_validation->run() == TRUE) {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            // var_dump($username);
            // var_dump($password);
            // exit;
            $data = $this->M_auth->login($username, $password);
            // var_dump($data);
            // exit;
            if ($data == false) {
                $this->session->set_flashdata('error_msg', 'Username / Password Anda Salah.');
                redirect('Auth');
            } else {
                $session = [
                    'userdata' => $data,
                    'status' => "Loged in"
                ];
                $this->session->set_userdata($session);
                // print_r($session);exit;
                redirect('Home');
            }
        } else {
            $this->session->set_flashdata('error_msg', validation_errors());
            redirect('Auth');
        }
    }

    

    public function logout() {
        $this->session->sess_destroy();
        redirect('Auth');
    }

}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */