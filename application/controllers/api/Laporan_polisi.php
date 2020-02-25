<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Laporan_polisi extends REST_Controller{
    public function index_get(){
		$no_hp = $this->post('no_hp');
    	if ($no_hp == null || $no_hp == "") {
    		$data = $this->db->get('m_anggota')->result();
    		$bantu = apistandart('Success','false',$data);
    		$this->output
		        ->set_content_type('application/json')
		        ->set_output($bantu);
    	}else if(is_numeric($no_hp)) {
            $this->db->where('id_pegawai', $no_hp);
    		$data = $this->db->get('m_anggota')->result();
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
    //                 'id_pegawai'        => $this->post('id_pegawai'),
    //                 'nama_pegawai'      => $this->post('nama_pegawai'),
    //                 'alamat'            => $this->post('alamat'),
    //                 'handphone'         => $this->post('handphone'),
    //                 'status'            => $this->post('status'),
    //                 'start_date'        => $this->post('start_date'),
    //                 'end_date'          => $this->post('end_date'));

    //     $insert = $this->db->insert('m_anggota', $data);
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