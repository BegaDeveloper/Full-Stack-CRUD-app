<?php 
defined('BASEPATH') OR exit ('No direct script access allowed');

class Login extends CI_Controller {

    //Constructor
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth');
        
    }

    //Login
    public function login_proccess(){
       
        $this->load->database();
		$_POST = json_decode(file_get_contents('php://input'), true);

        $username = isset($_POST['username']) ? $_POST['username'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;

        if($username && $password){
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $login_data = array (
                'username' => $username,
                'password' => $password
            );

            $check = $this->db->get_where('theusers', array('username' => $login_data['username'])) ;
            
            foreach($check->result() as $user){
                //var_dump($user);
                //var_dump($login_data);
               
                    if($login_data['username'] == $user->username && $login_data['password'] == $user->password ){
                        
                    $_SESSION['username'] = $login_data['username'];
                    return true;
                    
                } else {
                    echo "Nothing 1";
                }
            }
        } else { 
            echo "Nohing 2";
         }
    return false;
         
    }

    //Logout
    public function logout(){
        session_unset();
        session_destroy();
    }


}