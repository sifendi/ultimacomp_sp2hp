<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Laporan_polisi extends REST_Controller{
    public function index_get(){
		$nomor_hp = $this->post('nomor_hpx');
		print_r(" Nomor HP ");
		print_r($nomor_hp);
		exit;
    	if ($nomor_hp == null || $nomor_hp == "") {
    		$data = $this->db->get('tb_lp')->result();
    		$bantu = apistandart('Success','false',$data);
    		$this->output
		        ->set_content_type('application/json')
		        ->set_output($bantu);
    	}else if($nomor_hp != null) {
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

    // public function index_post(){
    // 	$data = array(
    //                 'nomor_hp'        => $this->post('nomor_hp'),
    //                 'nama_pegawai'      => $this->post('nama_pegawai'),
    //                 'alamat'            => $this->post('alamat'),
    //                 'handphone'         => $this->post('handphone'),
    //                 'status'            => $this->post('status'),
    //                 'start_date'        => $this->post('start_date'),
    //                 'end_date'          => $this->post('end_date'));

    //     $insert = $this->db->insert('tb_lp', $data);
    //     if ($insert) {
    //     	$bantu = apistandart('Success','false','');
    //     	$this->output
    //     	->set_content_type('application/json')
    //     	->set_output($bantu);
    //     } else {
    //         $x = $this->response(array('status' => 'fail', 502));
	//   		$bantu = apistandart('Failed','true',$x);
	//     		$this->output
	// 		        ->set_content_type('application/json')
	// 		        ->set_output($bantu);
	// 	}
    // }
    

}