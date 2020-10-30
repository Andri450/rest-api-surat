<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class surat extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Read 
    function index_get($spesifik = null) {
        
        if ($spesifik == null) {
            $this->db->from('t_surat');
            $this->db->join('t_user','t_user.nip = t_surat.diteruskan_kepada');
            $surat = $this->db->get()->result();
        }elseif(is_numeric($spesifik) == true){
            $this->db->where('id_surat', $spesifik);
            $surat = $this->db->get('t_surat')->result();
        }else{
            $this->db->where('jenis_surat', $spesifik);
            $surat = $this->db->get('t_surat')->result();
        }
        $this->response($surat, 200);
    }

    //Create
    function index_post() {

        // echo base_url('assets/'); die;
        
        // ambil data file
        $namaFile = $_FILES['file']['name'];
        $namaSementara = $_FILES['file']['tmp_name'];

        // tentukan lokasi file akan dipindahkan
        $dirUpload = $_SERVER['DOCUMENT_ROOT'] . '/rest_surat/assets/';

        // pindahkan file
        $terupload = move_uploaded_file($namaSementara, $dirUpload.$namaFile);

        if ($terupload) {
            
            $arr_diteruskan[] = explode(",", "123,321");

            $data = array(
                'id_surat'          => $this->post('id_surat',true),
                'no_agenda'         => $this->post('no_agenda',true),
                'jenis_surat'       => $this->post('jenis_surat',true),
                'tahun'             => $this->post('tahun',true),
                'no_surat'          => $this->post('no_surat',true),
                'tgl_surat'         => date("Y-m-d", strtotime($this->post('tgl_surat',true))),
                'perihal'           => $this->post('perihal',true),
                'surat_dari'        => $this->post('surat_dari',true),
                'isi_disposisi'     => $this->post('isi_disposisi',true),
                'diteruskan_kepada' => $arr_diteruskan,
                'scan_surat'        => $namaFile,
                'id_log'            => $this->post('id_log',true),
            );

            $insert = $this->db->insert('t_surat', $data);
            if ($insert) {
                $this->response($data, 200);
            } else {
                $this->response(array('status' => 'fail', 502));
            }

        } else {
            $this->response(array('status' => 'upload gagal!', 502));
        }

    }

    //Update
    function index_put() {
        $id = $this->put('id_surat',true);

        $data = array(
                    'no_agenda'         => $this->put('no_agenda',true),
                    'jenis_surat'       => $this->put('jenis_surat',true),
                    'tahun'             => $this->put('tahun',true),
                    'no_surat'          => $this->put('no_surat',true),
                    'tgl_surat'         => $this->put('tgl_surat',true),
                    'perihal'           => $this->put('perihal',true),
                    'surat_dari'        => $this->put('surat_dari',true),
                    'isi_disposisi'     => $this->put('isi_disposisi',true),
                    'diteruskan_kepada' => $this->put('diteruskan_kepada',true),
                    'scan_surat'        => $this->put('scan_surat',true),
                    'id_log'            => $this->put('id_log',true),
                    'updated_at'        => date('Y-m-d h:i:s')
                );
        
        $this->db->where('id_surat', $id);
        $update = $this->db->update('t_surat', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }

    }

    //Delete 
    function index_delete() {
        $id = $this->delete('id_surat',true);
        
        $this->db->where('id_surat', $id);
        $delete = $this->db->delete('t_surat');
        if ($delete) {
            $this->response(array('status' => 'success'), 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }

    }
}
?>