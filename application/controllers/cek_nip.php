<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class cek_nip extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Read 
    function index_get() {
        $nip = $this->get('nip',true);
        if ($nip == '') {
            $this->response(array(
                'status' => ''
            ), 200);
        } else {
            $this->db->where('nip', $nip);
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