<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trips extends CI_Controller {
	
    //loads the login view
    public function index()
    {
        $this->load->view('login_page');
    }

    public function user_dashboard()
    {
        $this->load->view('user_dashboard', array('trips'=>$this->trip->users_trips(), 'others'=>$this->trip->others())); 
    }

    public function register()
    {
        $this->trip->register($this->input->post()); 
    }
    //processes the student login
    public function login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $user = $this->trip->get_user($username);
        if($user && $user['password'] == $password)
        {
            $user = array(
               'id' => $user['id'],
               'name' => $user['name'],
               'username' => $user['username'],
               'is_logged_in' => TRUE
            );
            $this->session->set_userdata($user);
            if($this->session->userdata['is_logged_in'] === TRUE){
            redirect('/trips/user_dashboard'); 
            }
        }
        else
        {
            $this->session->set_flashdata("login_error", "Invalid email or password!");
            redirect("/");
        }
    }
    //simple profile page of a student
    
    //logout the student
    public function logout()
    {
        $this->session->userdata['is_logged_in'] = FALSE; 
        $this->session->sess_destroy();
        redirect("/");   
    }

    public function add_page()
    {
        $this->load->view('add'); 
    }
    public function add_trip()
    {
        $this->trip->add_trip($this->input->post()); 
    }

    public function details($trip_id)
    {
        $this->load->view('details', array("trip"=>$this->trip->find_trip($trip_id), "companions"=>$this->trip->find_companions($trip_id)));
    }

    public function add_des($des_id)
    {
        $this->trip->add_des($des_id); 
    }

}
