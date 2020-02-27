<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class LP extends REST_Controller{
	public function index_get(){
		$data = $this->db->get('tb_lp')->result();
    	$bantu = apistandart('Success','false',$data);
		$this->output
			->set_content_type('application/json')
		    ->set_output($bantu);
    }

    public function index_post(){
		$nomor_hp = $this->post('nomor_hp');
		if($nomor_hp != null && is_numeric($nomor_hp)){
			$this->db->where('nomor_hp', $nomor_hp);
			$data = $this->db->get('tb_lp')->result();
			$bantu = apistandart('Success Call Data By ID','false',$data);
			$this->output
				->set_content_type('application/json')
				->set_output($bantu);
		}else{
    		$data = $this->response(array('status' => 'fail, param is not correct'), 502);
    		$bantu = apistandart('Failed','true',$data);
    		$this->output
		        ->set_content_type('application/json')
		        ->set_output($bantu);
    	}
    }
    

}