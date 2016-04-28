<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poke extends CI_Model {

	public function register($post)
	{  
		$this->form_validation->set_rules("name", "Name","required|min_length[3]");
		$this->form_validation->set_rules("alias", "Alias","required|min_length[3]");
		$this->form_validation->set_rules("email", "Email","required|valid_email");
		$this->form_validation->set_rules("password", "Password","required|min_length[8]|matches[cpassword]");
		$this->form_validation->set_rules("cpassword", "Confirm Password","required|min_length[8]");
		$this->form_validation->set_rules("dob", "Date of Birth","required");
		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata("register_error", validation_errors());
			redirect('/'); 
		} 
		else
		{
			$query = "INSERT INTO users (name, alias, email, password, dob, created_at, updated_at) VALUES (?,?,?,?,?, NOW(), NOW())";

			$password = md5($post['password']);
			$vals = array($post['name'], $post['alias'], $post['email'], $password, $post['dob']);
			if($this->db->query($query, $vals))
			{
				$query2 = "INSERT INTO pokes(user_id, poked, created_at, updated_at) VALUES(?,?, NOW(), NOW())"; 
				$vals2 = array($this->get_id()['id'],$this->get_id()['id'] ); 
				$this->db->query($query2, $vals2);  
				$this->session->set_flashdata('register_success', 'You have successfully registered, please login right above!');
				redirect('/'); 
			}
			else
			{
				echo "Bad Query";
				exit(); 
			}
		}
	}

	public function get_user($email)
	{
		return $this->db->query("SELECT * FROM users WHERE email = ?", array($email))->row_array();
	}

	public function get_id()
	{
		$query = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
		$id = $this->db->query($query)->row_array();
		return $id;
	}

	public function users_pokes()
	{
		$user = $this->session->userdata['id']; 
		return $this->db->query("SELECT pokes.poked as user, pokes.user_id as poked_by, COUNT(pokes.poked) as count, users.name  FROM pokes LEFT JOIN users ON pokes.user_id = users.id  WHERE pokes.poked = $user GROUP BY poked_by")->result_array();
	}

	public function poke_history($id)
	{
		$query = "SELECT pokes.poked as user_id, SUM(pokes.poked) FROM pokes WHERE pokes.poked = $id GROUP BY ";
	}

	public function others()
	{
		$user = $this->session->userdata['id'];
		$query = "SELECT pokes.poked as user_id, COUNT(pokes.poked) as count, pokes.user_id as poked_by, users.name, users.alias, users.email FROM pokes LEFT JOIN users ON pokes.poked = users.id AND pokes.poked != $user AND users.id != $user GROUP BY poked HAVING poked > 0"; 
		// $query = "SELECT users.name, users.alias, users.email, SUM(pokes.poked) as count, pokes.user_id, FROM users LEFT JOIN pokes ON users.id = pokes.user_id WHERE pokes.user_id != $user GROUP BY pokes.user_id"; 
		return $this->db->query($query)->result_array();
	}

	public function add_poke($poked)
	{
		$user = $this->session->userdata['id']; 
		$query = "INSERT INTO pokes (user_id, poked, created_at, updated_at) VALUES (?,?, NOW(), NOW())";
		$vals = array($user, $poked);
		if($this->db->query($query, $vals)){
			redirect('/pokes/user_dashboard');
		}
		else
		{
			echo "Bad query";
			die();
		}
	}
	
}