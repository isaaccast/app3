<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Books extends CI_Controller {
	
    //loads the login view
    public function index()
    {
        $this->load->view('login_page');
    }

    public function user_dashboard()
    {
        $this->load->view('user_dashboard', array('books'=>$this->book->all_books())); 
    }

    public function add_page()
    {
        $this->load->view('add'); 
    }
    //processes the student login
    public function login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $user = $this->book->get_user($email);
        if($user && $user['password'] == $password)
        {
            $user = array(
               'id' => $user['id'],
               'email' => $user['email'],
               'first_name' => $user['first_name'],
               'last_name' => $user['last_name'],
               'is_logged_in' => TRUE
            );
            $this->session->set_userdata($user);
            if($this->session->userdata['is_logged_in'] === TRUE){
            $this->load->view('user_dashboard',array('books'=>$this->book->all_books())); 
        	}
        }
        else
        {
            $this->session->set_flashdata("login_error", "Invalid email or password!");
            redirect("/");
        }
    }
    //simple profile page of a student
    public function profile()
    {
        if($this->session->userdata('is_logged_in') === TRUE)
            echo "Your are now logged in! Click <a href='/students/logout'>Here</a> to Logout.";
        else
            redirect("/");
    }
    //logout the student
    public function logout()
    {
        $this->session->userdata['is_logged_in'] = FALSE; 
        $this->session->sess_destroy();
        redirect("/");   
    }
    public function register()
    {
    	$this->book->register_user($this->input->post()); 
    }

    public function add_book_review()
    {
        $this->book->add_book($this->input->post()); 
    }
    public function add_review($book_id)
    {
        $this->book->add_review($this->input->post(), $book_id); 
    }

    public function show_user($id)
    {
        $this->book->select_user($id); 
    } 

    public function get_book($id)
    {
        $this->book->single_book($id); 
    }
    public function remove_review($id,$book_id)
    {
        $this->book->remove_review($id, $book_id); 
    }
}
