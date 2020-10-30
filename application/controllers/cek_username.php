<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class cek_username extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Read 
    function index_get() {
        $username = $this->get('username',true);
        if ($username == '') {
            $this->response(array(
                'status' => ''
            ), 200);
        } else {
            $this->db->where('username', $username);
            $users = $this->db->get('t_user')->num_rows();

            if ($users == 1) {
                $this->response(array(
                    'status' => 'ada'
                ), 200);
            }else{
                $this->response(array(
                    'status' => 'kosong'
                ), 200);
            }

        }
        
    }

}
?>