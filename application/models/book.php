<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book extends CI_Model {

	public function register_user($post)
	{  
		$this->form_validation->set_rules("first_name", "First Name","required");
		$this->form_validation->set_rules("last_name", "Last Name","required");
		$this->form_validation->set_rules("email", "Email","required|is_unique[users.email]|valid_email");
		$this->form_validation->set_rules("password", "Password","required|min_length[8]|matches[cpassword]");
		$this->form_validation->set_rules("cpassword", "Confirm Password","required|min_length[8]");
		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata("register_error", validation_errors());
			redirect('/'); 
		} 
		else
		{
			$query = "INSERT INTO users (first_name, last_name, email, password, created_at, updated_at) VALUES (?,?,?,?,NOW(), NOW())";
			$vals = array($post['first_name'], $post['last_name'], $post['email'], $post['password']);
			if($this->db->query($query, $vals))
			{
				$this->session->set_flashdata('register_success', 'You have successfully registered!');
				redirect('/'); 
			}
			else
			{
				echo "Bad Query";
				exit(); 
			}
		}
		$this->load->view('user_dashboard'); 
	}

	public function add_book($post)
	{
		$query = "INSERT INTO books (title, author, created_at, updated_at) VALUES(?,?,NOW(),NOW())";
		$vals = array($post['title'], $post['author']);
		if($this->db->query($query, $vals))
		{
			$query = "INSERT INTO reviews(comment, rating, user_id, book_id, created_at, updated_at) VALUES(?,?,?,?, NOW(),NOW())";
			$vals = array($post['comment'], $post['rating'], $this->session->userdata['id'], $this->book_id()['id']);
			if($this->db->query($query, $vals))
			{
				$this->load->view('user_dashboard',array('books' => $this->all_books())); 

			}
			else
			{
				echo "Bad Query";
				die(); 
			} 
		}
		else
		{
			echo "Bad Query";
			die(); 
		}
	}
	public function book_id()
	{
		$query = "SELECT id FROM books ORDER BY id DESC LIMIT 1";
		$id = $this->db->query($query)->row_array();
		return $id; 
	}

	public function select_user($id)
	{
		$query = "SELECT users.first_name, users.last_name, users.email, reviews.comment, books.title, books.id FROM users LEFT JOIN reviews ON users.id = reviews.user_id LEFT JOIN books ON reviews.book_id = books.id WHERE users.id = ?";
		$vals = $id; 
		$user = $this->db->query($query, $vals)->result_array(); 
		$this->load->view('user', array('user' => $user));
	}

	public function single_book($id)
	{
		$query = "SELECT books.title, books.author, books.id as book_id, reviews.rating, reviews.comment, reviews.created_at, reviews.id, users.first_name, users.id as user_id FROM books 
		LEFT JOIN reviews ON books.id = reviews.book_id LEFT JOIN users ON reviews.user_id = users.id
		WHERE books.id = $id";
		$book = $this->db->query($query)->row_array();
		$reviews = $this->db->query($query)->result_array(); 
		$this->load->view('reviews', array('book' => $book, 'reviews' => $reviews)); 
	}

	public function all_books()
	{
		$query = "SELECT books.title, books.author, reviews.comment, reviews.rating, reviews.book_id, reviews.created_at, users.first_name, users.email, users.id  FROM books
LEFT JOIN reviews ON books.id = reviews.book_id LEFT JOIN users ON reviews.user_id = users.id ";
		$all_books = $this->db->query($query)->result_array(); 
		return $all_books; 
	}
	public function FunctionName($value='')
	{
		# code...
	}

	public function add_review ($post, $book_id)
	{
		$query = "INSERT INTO reviews(comment, rating, user_id, book_id, created_at, updated_at) VALUES(?,?,?,?, NOW(),NOW())";
		$vals = array($post['comment'], $post['rating'], $this->session->userdata['id'], $book_id);
		if($this->db->query($query, $vals))
		{
			$this->single_book($book_id); 

		}
		else
		{
			echo "Bad Query";
			die(); 
		}
	}

	public function get_user($email)
	{
		return $this->db->query("SELECT * FROM users WHERE email = ?", array($email))->row_array();
	}
	public function remove_review($id, $book_id)
	{
		$query = "DELETE FROM reviews WHERE id= ?";
		$val = $id;
		$this->db->query($query, $val); 
		$this->single_book($book_id); 
	}
}