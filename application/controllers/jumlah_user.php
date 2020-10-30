<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class jumlah_user extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Read 
    function index_get() {

        $this->db->select('nip');
        $jumlah = $this->db->get('t_user')->num_rows();
        $this->response($jumlah, 200);
    
    }

}
?>