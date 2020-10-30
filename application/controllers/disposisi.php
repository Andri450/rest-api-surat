<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class disposisi extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Read 
    function index_get() {
        $id = $this->get('id_disposisi',true);
        if ($id == '') {
            $users = $this->db->get('t_disposisi')->result();
        } else {
            $this->db->where('id_disposisi', $id);
            $users = $this->db->get('t_disposisi')->result();
        }
        $this->response($users, 200);
    }

    //Create
    function index_post() {

        $data = array(
                        'id_disposisi' => $this->post('id_disposisi',true),
                        'id_surat'     => $this->post('id_surat',true),
                        'penerima'     => $this->post('penerima',true),
                        'deskripsi'    => $this->post('deskripsi',true),
                        'pengirim'     => $this->post('pengirim',true),
                        'status'       => $this->post('status',true)
                    );

        $insert = $this->db->insert('t_disposisi', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }

    }

    //Update
    function index_put() {
        $id = $this->put('id_disposisi',true);

        $data = array(
                    'id_disposisi' => $this->post('id_disposisi',true),
                    'id_surat'     => $this->post('id_surat',true),
                    'penerima'     => $this->post('penerima',true),
                    'deskripsi'    => $this->post('deskripsi',true),
                    'pengirim'     => $this->post('pengirim',true),
                    'status'       => $this->post('status',true),
                    'updated_at'   => date('Y-m-d h:i:s')
                );
        
        $this->db->where('id_disposisi', $id);
        $update = $this->db->update('t_disposisi', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }

    }

    //Delete 
    function index_delete() {
        $id = $this->delete('id_disposisi',true);
        
        $this->db->where('id_disposisi', $id);
        $delete = $this->db->delete('t_disposisi');
        if ($delete) {
            $this->response(array('status' => 'success'), 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }

    }
}
?>