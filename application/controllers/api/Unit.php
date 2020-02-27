<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Unit extends REST_Controller{

	public function index_get(){
		$data = $this->db->get('m_unit')->result();
    	$bantu = apistandart('Success','false',$data);
		$this->output
			->set_content_type('application/json')
		    ->set_output($bantu);
    }

    public function index_post(){
		$id = $this->post('id');
		if($id != null && is_numeric($id)){
			$this->db->where('id', $id);
			$data = $this->db->get('m_unit')->result();
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