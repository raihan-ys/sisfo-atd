<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model 
{
	// Define table.
	private $table = 'user';

	// Define that session key is the user's id attribute.
	const SESSION_KEY = 'user_id';

	// Set rules for login form.
	public function rules() 
	{
		return [
			[// username
				'field' => 'username',
				'label' => 'Email or Username',
				'rules' => 'trim|required|max_length[64]',
				'errors' => array(
					'required' => 'Email atau username belum di-input!',
					'max_length' => 'Maks karakter adalah 64!'
				)
			],
			[// password
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required|max_length[255]',
				'errors' => array(
					'required' => '%s belum di-input!',
					'max_length' => '%s\'s max characthers reached!(255)'
				)
			]
		];
	}

	// User authentication.
	public function login($username, $password) 
	{
		if (!$username || !$password) return;

		// Get user's attribute from 'user' table.
		$user = $this->db
			->where('email', $username)
			->or_where('username', $username)
			->get($this->table)
			->row();

		// User's data verification.
		if (!$user) return false;
		if (!password_verify($password, $user->password)) return false; 

		// Get user's id.
		$id = $user->id;

		// Create a new session, with the user's id attribute from the database.
		$this->session->set_userdata([self::SESSION_KEY => $id]);

		// Updates 'last_login' attribute, with current device's timestamp.
		$this->db->update(
				$this->table,
				['last_login' => date("Y-m-d H:i:s")], 
				['id' => $id]
		);

		// Return boolean: is the current user has access?
		return $this->session->has_userdata(self::SESSION_KEY);
	}

	// Get user's data (if the user has an access).
	public function current_user()
	{
		// Select the database first, because this function will be called by Controllers which selected database is 'atd_payroll'.
		$this->db->db_select('atd_akademik');
		
		// If there's no user's data.
		if (!$this->session->has_userdata(self::SESSION_KEY)) return null;

		// Define the user's id.
		$user_id = $this->session->userdata(self::SESSION_KEY);

		// Get the user's data from the database.
		return $this->db->get_where($this->table, ['id' => $user_id])->row();
	}

	// Delete session/logout.
	public function logout()
	{
		$this->session->unset_userdata(self::SESSION_KEY);
		return !$this->session->has_userdata(self::SESSION_KEY);
	}
}
