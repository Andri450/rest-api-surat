<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class jumlah_surat_keluar extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Read 
    function index_get() {

        $this->db->select('id_surat');
        $jumlah = $this->db->get('t_surat')->num_rows();
        $this->response($jumlah, 200);
    
    }

}
?>