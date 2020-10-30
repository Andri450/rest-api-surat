<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class users_login extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Read 
    function index_post() {
        $username = $this->post('username',true);
        $password = $this->post('password',true);
        if ($username == '') {
            $this->response('s',404);
        } else {
            $this->db->where('username', $username);
            $this->db->select('password');
            $users = $this->db->get('t_user');
            $data = $users->result();

            if($users->num_rows() == 1){
            
                $this->db->where('username', $username);
                $this->db->select('nip,nama,jabatan,golongan,username');
                $users_dat = $this->db->get('t_user');
                $dat = $users_dat->result();
            
                foreach ($data as $isi) {};
                if (password_verify($password,$isi->password)) {
                    $this->response(array(
                        'isi'    => $users_dat->result(),
                        'status' => 'success'
                    ), 200);
                }else{
                    $this->response(array('status' => 'password_not_found'),404);
                }
            }else{
                $this->response(array('status' => 'username_not_found'),404);
            }
        }
    }

}
?>