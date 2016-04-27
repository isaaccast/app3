<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trip extends CI_Model {

	public function register($post)
	{  
		$this->form_validation->set_rules("name", "Name","required|min_length[3]");
		$this->form_validation->set_rules("username", "Username","required|min_length[3]");
		$this->form_validation->set_rules("password", "Password","required|min_length[8]|matches[cpassword]");
		$this->form_validation->set_rules("cpassword", "Confirm Password","required|min_length[8]");
		if($this->form_validation->run() == FALSE)
		{
			$this->session->set_flashdata("register_error", validation_errors());
			redirect('/'); 
		} 
		else
		{
			$query = "INSERT INTO users (name, username, password, created_at, updated_at) VALUES (?,?,?, NOW(), NOW())";
			$password = md5($post['password']);
			$vals = array($post['name'], $post['username'], $password);
			if($this->db->query($query, $vals))
			{
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

	public function get_user($username)
	{
		return $this->db->query("SELECT * FROM users WHERE username = ?", array($username))->row_array();
	}

	public function users_trips()
	{
		$user = $this->session->userdata['id']; 
		return $this->db->query("SELECT des.place, des.start, des.end, des.plan, trips.user_id, trips.des_id FROM des LEFT JOIN trips ON des.id = trips.des_id WHERE trips.user_id = $user")->result_array();
	}

	public function others()
	{
		$user = $this->session->userdata['id'];
		// $query = "SELECT trips.user_id, trips.des_id, des.place, des.planned_by, des.start, des.end, des.id FROM trips LEFT JOIN des ON trips.des_id = des.id WHERE trips.user_id != $user"; 
		 
		return $this->db->query("SELECT des.place, des.start, des.end, des.plan, des.planned_by, trips.user_id, trips.des_id FROM des LEFT JOIN trips ON des.id = trips.des_id WHERE trips.user_id != $user GROUP BY des.place")->result_array();
		// return $this->db->query($query)->result_array();
	}
	public function last_des()
	{
		$query = "SELECT id FROM des ORDER BY id DESC LIMIT 1";
		$id = $this->db->query($query)->row_array();
		return $id; 
	}

	public function add_trip($post)
	{
		$today = date('Y-m-d');
		if($post['start'] < $today){

		$this->session->set_flashdata("trip_error", 'Start Date cannot be today or in the past');
				redirect('/trips/add_page');
		
		}
		elseif($post['start'] >= $post['end'])
		{
			$this->session->set_flashdata("trip_error", 'End Date cannot be before Start Date');
				redirect('/trips/add_page'); 
		}
		else
		{
			$this->form_validation->set_rules("place", "Destination","required|min_length[3]");
			$this->form_validation->set_rules("plan", "Description","required|min_length[3]");
			$user = $this->session->userdata['name']; 
			if($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata("trip_error", validation_errors());
				redirect('/trips/add_page'); 
			}
			else{ 
				$query = "INSERT INTO des (place, start, end, plan, planned_by, created_at, updated_at) VALUES(?,?,?,?,?,NOW(),NOW())";
				$vals = array($post['place'], $post['start'], $post['end'], $post['plan'],$user);
				if($this->db->query($query, $vals))
				{
					$query = "INSERT INTO trips (user_id, des_id) VALUES(?,?)";
					$vals = array($this->session->userdata['id'], $this->last_des()['id']);
					if($this->db->query($query, $vals))
					{
						redirect('/trips/user_dashboard'); 

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
		}
	}

	public function find_trip($trip_id)
	{
		$query = "SELECT des.place, des.plan, des.start, des.end, users.name FROM des LEFT JOIN trips ON des.id = trips.des_id LEFT JOIN users ON trips.user_id = users.id WHERE des.id = $trip_id";
		if($this->db->query($query)){
			return $this->db->query($query)->row_array();
		}else{
			echo "Couldn't find trip info";
			die(); 
		}
	}

	public function add_des($des_id)
	{
		$query = "INSERT INTO trips (user_id, des_id) VALUES(?,?)";
		$vals = array($this->session->userdata['id'], $des_id);
		if($this->db->query($query, $vals)){
			redirect('/trips/user_dashboard'); 
		}
	}

	public function find_companions($des_id)
	{
		$user = $this->session->userdata['id']; 
		$query = "SELECT users.name FROM users LEFT JOIN trips ON users.id = trips.user_id LEFT JOIN des ON trips.des_id = des.id WHERE des.id = $des_id AND trips.user_id != $user AND des.planned_by != users.name";
		if($this->db->query($query)){
			return $this->db->query($query)->result_array();
		}else{
			echo "Couldn't find companions info";
			die(); 
		}
	}

}