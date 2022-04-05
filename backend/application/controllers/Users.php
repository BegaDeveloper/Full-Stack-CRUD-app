<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_data');
    }

    //GET all users
    public function getAllUsers(){
        $query = $this->db->get('userdetails');
        $data['data'] = $query->result();
        //var_dump($data);
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode(array(
            'status' => true,
            'data' => $data
        )));
    }

    //GET single user
    public function getUser($id){
        $data = [];
        $this->load->database();
        $data = $this->db->get_where('userdetails', array('id =' => $id))->result()[0];
       
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode(array(
            'status' => true,
            'data' => $data
        )));
    }

    //POST user
    public function postUser(){
        $this->load->database();
        $_POST = json_decode(file_get_contents('php://input'), true);

        $insert = $this->input->post();

        $this->db->insert('userdetails', $insert);
        $id = $this->db->insert_id();

        $q = $this->db->get_where('userdetails', array('id' => $id));
        echo json_encode($q->row());
    
    }
    //
    //UPDATE user
    public function updateUser($id){  
        $this->load->database();
        $_POST = json_decode(file_get_contents('php://input'), true);
        $insert = $this->input->post();
        $this->db->where('id', $id);
        $this->db->update('userdetails', $insert);
        $q = $this->db->get_where('userdetails', array('id' => $id));
        echo json_encode($q->row());

    }
}