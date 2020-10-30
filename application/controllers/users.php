<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class users extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Read 
    function index_get() {
        $id = $this->get('nip',true);
        if ($id == '') {
            $users = $this->db->get('t_user')->result();
        } else {
            $this->db->where('nip', $id);
            $users = $this->db->get('t_user')->result();
        }
        $this->response($users, 200);
    }

    //Create
    function index_post() {

        $pass = password_hash($this->post('nip',true), PASSWORD_BCRYPT);

        $data = array(
                    'nip'      => $this->post('nip',true),
                    'nama'     => $this->post('nama',true),
                    'jabatan'  => $this->post('jabatan',true),
                    'golongan' => $this->post('golongan',true),
                    'username' => $this->post('username',true),
                    'password' => $pass
                );

        $insert = $this->db->insert('t_user', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }

    }

    //Update
    function index_put() {
        $id = $this->put('nip',true);

        $data = array(
                    'nama'     => $this->put('nama',true),
                    'jabatan'  => $this->put('jabatan',true),
                    'golongan' => $this->put('golongan',true),
                    'username' => $this->put('username',true)
                );
        
        $this->db->where('nip', $id);
        $update = $this->db->update('t_user', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }

    }

    //Delete 
    function index_delete() {
        $id = $this->delete('nip',true);
        
        $this->db->where('nip', $id);
        $delete = $this->db->delete('t_user');
        if ($delete) {
            $this->response(array('status' => 'success'), 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }

    }
}
?>