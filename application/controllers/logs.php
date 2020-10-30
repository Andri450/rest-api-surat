<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class logs extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Read 
    function index_get() {
        $id = $this->get('id_log',true);
        if ($id == '') {
            $users = $this->db->get('t_log')->result();
        } else {
            $this->db->where('id_log', $id);
            $users = $this->db->get('t_log')->result();
        }
        $this->response($users, 200);
    }

    //Create
    function index_post() {

        $data = array(
                    'id_log'        => $this->post('id_log',true),
                    'tgl_aktivitas' => $this->post('nama',true),
                    'nama_pengirim' => $this->post('nama_pengirim',true),
                    'nama_penerima' => $this->post('nama_penerima',true)
                );

        $insert = $this->db->insert('t_log', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }

    }

    //Update
    function index_put() {
        $id = $this->put('id_log',true);

        $data = array(
                    'tgl_aktivitas' => $this->put('tgl_aktivitas',true),
                    'nama_pengirim' => $this->put('nama_pengirim',true),
                    'nama_penerima' => $this->put('nama_penerima',true)
                );
        
        $this->db->where('id_log', $id);
        $update = $this->db->update('t_log', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }

    }

    //Delete 
    function index_delete() {
        $id = $this->delete('id_log',true);
        
        $this->db->where('id_log', $id);
        $delete = $this->db->delete('t_log');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }

    }
}
?>