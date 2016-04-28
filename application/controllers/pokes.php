<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pokes extends CI_Controller {
	
    //loads the login view
    public function index()
    {
        $this->load->view('login_page');
    }

    public function user_dashboard()
    {
        $this->load->view('user_dashboard', array('pokes'=>$this->poke->users_pokes(), 'others'=>$this->poke->others())); 
    }

    public function register()
    {
        $this->poke->register($this->input->post()); 
    }
    //processes the student login
    public function login()
    {
        $email = $this->input->post('email');
        $password = md5($this->input->post('password'));
        $user = $this->poke->get_user($email);
        if($user && $user['password'] == $password)
        {
            $user = array(
               'id' => $user['id'],
               'name' => $user['name'],
               'alias' => $user['alias'],
               'is_logged_in' => TRUE
            );
            $this->session->set_userdata($user);
            if($this->session->userdata['is_logged_in'] === TRUE){
            redirect('/pokes/user_dashboard'); 
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

    public function add_poke($user_id)
    {
        $this->poke->add_poke($user_id); 
    }

}
