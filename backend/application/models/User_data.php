<?php
defined('BASEPATH') OR exit ('No direct script access allowed');

class User_data extends CI_Model {
    public function user_details($data){
        $this->db->insert('userdetails', $data);
    }
}