<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model {

    public function select_all_pegawai() {
        $sql = "SELECT * FROM tb_lp";
        $data = $this->db->query($sql);
        return $data->result();
    }
    
    public function empty_response(){
        $response['status']=502;
        $response['error']=true;
        $response['message']='Field tidak boleh kosong';
        return $response;
     }
    
    public function all_lp($no_hp){
        if($no_hp == ''){
          return $this->empty_response();
        }else{
          $where = array(
            "no_hp"=>$no_hp
            );
        }

      $this->db->where($where);
      $all = $this->db->get("tb_lp")->result();
      $response['status']=200;
        $response['error']=false;
        $response['person']=$all;
        return $response;
  }

    public function select_all() {
        $sql = " SELECT * from tb_lp where delete_is = 0";
        $data = $this->db->query($sql);
        return $data->result();
    }

    public function select_galery($no) {
        $sql = " SELECT * from tbl_galeri where id_disposisi= '{$no}'";
        $data = $this->db->query($sql);
        return $data->result();
    }

    public function select_all_for_disposisi() {
        $sql = "SELECT * FROM tb_lp left join tb_disposisi on tb_lp.id_lp = tb_disposisi.id_lp2 where tb_lp.delete_is = 0";
        $data = $this->db->query($sql);
        return $data->result();
    }

    public function select_transaksi() {///for laporan after assign to police
        $sql = "SELECT
                            tb_lp.nomor_polisi AS nomor_polisi,
                            tb_lp.id_lp AS id_lp,
                            tb_lp.nama AS pelapor,
                            tb_disposisi.kasat AS kasat,
                            m_anggota.nama AS penyidik,
                            tb_disposisi.id_disposisi as disposisi
                    FROM tb_lp
                    JOIN tb_disposisi ON tb_lp.id_lp = tb_disposisi.id_lp2
                    JOIN m_anggota ON m_anggota.NO = tb_disposisi.id_penyidik
                    WHERE tb_lp.delete_is = 0";
        $data = $this->db->query($sql);
        return $data->result();
    }

    public function select_by_id($id) {
        $sql = "SELECT * from tb_lp where id_lp = '{$id}'";
        $data = $this->db->query($sql);
        return $data->row();
    }
    
    public function select_apidoc($id) {
        $sql = "SELECT id_disposisi from tb_disposisi where id_lp2 = '{$id}'";
        $data = $this->db->query($sql);
        $sql2 = "SELECT * from tbl_galeri where id_disposisi = '".$data->row()->id_disposisi."'";
        $data2 = $this->db->query($sql2);
        return $data2->result_array();
    }

    public function update($data) {
        $sql = "UPDATE tb_lp SET 
            nomor_polisi ='" . $data['nomor_polisi'] . "',
            nama ='" . $data['nama'] . "',
            umur ='" . $data['umur'] . "',
            ttl ='" . $data['ttl'] . "',
            jenis_kelamin ='" . $data['jenis_kelamin'] . "',
            pekerjaan ='" . $data['pekerjaan'] . "',
            alamat ='" . $data['alamat'] . "',
            nomor_hp ='" . $data['nomor_hp'] . "',
            email ='" . $data['email'] . "',
            waktu_kejadian ='" . $data['waktu_kejadian'] . "',
            tempat_kejadian ='" . $data['tempat_kejadian'] . "',
            terjadi ='" . $data['terjadi'] . "',
            terlapor ='" . $data['terlapor'] . "',
            korban ='" . $data['korban'] . "',
            how ='" . $data['how'] . "',
            dilaporkan_pada ='" . $data['dilaporkan_pada'] . "',
            pasal ='" . $data['pasal'] . "',
            pelanggaran ='" . $data['pelanggaran'] . "',
            menerima_laporan ='" . $data['menerima_laporan'] . "',
            nrp_menerima_laporan	 ='" . $data['nrp_menerima_laporan'] . "',
            mengetahui	 ='" . $data['mengetahui'] . "',
            nrp_mengetahui ='" . $data['nrp_mengetahui'] . "'
            WHERE id_lp='" . $data['id_lp'] . "'";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    public function insert($data) {
//        $id = md5(DATE('ymdhms') . rand());
        $sql = "INSERT INTO tb_lp VALUES('','" . $data['nomor_polisi'] . "','" . $data['nama'] . "',
            '" . $data['umur'] . "',
            '" . $data['ttl'] . "',
            '" . $data['jenis_kelamin'] . "',
            '" . $data['pekerjaan'] . "',
            '" . $data['alamat'] . "',
            '" . $data['nomor_hp'] . "',
            '" . $data['email'] . "',
            '" . $data['waktu_kejadian'] . "',
            '" . $data['tempat_kejadian'] . "',
            '" . $data['terjadi'] . "',
            '" . $data['terlapor'] . "',
            '" . $data['korban'] . "',
            '" . $data['how'] . "',
            '" . $data['dilaporkan_pada'] . "',
            '" . $data['pasal'] . "',
            '" . $data['pelanggaran'] . "',
            '" . $data['menerima_laporan'] . "',
            '" . $data['nrp_menerima_laporan'] . "',
            '" . $data['mengetahui'] . "',
            '" . $data['nrp_mengetahui'] . "','0','',now())";
//        print_r($sql);exit;
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    public function delete($id) {
        $sql = "UPDATE tb_lp SET delete_is =1 where id_lp='" . $id . "'";
        $this->db->query($sql);
        return $this->db->affected_rows();
    }



    public function update_transaksi($data) {
        $sql = "INSERT INTO tb_disposisi VALUES('','" . $data['atensi'] . "','" . $data['lidik'] . "',
            '" . $data['gelarkan'] . "',
            '" . $data['kirim'] . "',
            '" . $data['tingkatkan'] . "',
            '" . $data['lanjut'] . "',
            '" . $data['kasat'] . "',
            '" . $data['id_lp'] . "',
            '" . $data['id_penyidik'] . "',now(),0,
            '" . $data['catatan'] . "')";
//        print_r($sql);exit;
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    ////////////FOR UNGGAH


    public function select_by_id_for_unggah($id) {
        $sql = "SELECT tb_lp.id_lp as id_lp,tb_disposisi.id_disposisi as id_disposisi FROM tb_lp join tb_disposisi on tb_lp.id_lp = tb_disposisi.id_lp2
            where tb_lp.id_lp = '{$id}'";
        $data = $this->db->query($sql);
        return $data->row();
    }

    public function unggah_dokumen($data) {
        $sql = "INSERT INTO tb_document VALUES('','" . $data['nama_document'] . "','" . $data['id_disposisi'] . "',
            '" . $data['catatan'] . "','0')";
//        print_r($sql);exit;
        $this->db->query($sql);
        return $this->db->affected_rows();
    }

    function simpan_upload($nama_document, $catatan, $file_upload,$id_disposisi) {
        $data = array(
            'nama_document' => $nama_document,
            'file_upload' => $file_upload,
            'id_disposisi' => $id_disposisi,
            'catatan' => $catatan,
            'delete_is' => 0
        );
        $result = $this->db->insert('tb_document', $data);
        return $result;
    }


    // count value on graphic in dahsboard
    public function total_rows() {
        $this->db->where('delete_is', 0);
        $data = $this->db->get('tb_lp');
        return $data->num_rows();
    }

}
