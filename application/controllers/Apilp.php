<?php

require APPPATH . 'libraries/REST_Controller.php';

class Apilp extends REST_Controller{

  // construct
  public function __construct(){
    parent::__construct();
    $this->load->model('M_laporan');
  }

  public function index_get(){
    $no_hp = $this->post('no_hp');
    $response = $this->M_laporan->all_lp($no_hp);
    $this->response($response);
  }


}

?>
