<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FeedbackModel extends CI_Model
{
	// Define table
	private $table = 'feedback';

	// Set rules for feedback form validation.
	public function rules() 
	{
		return [
			[// name
			 	'field' => 'name',
			 	'label' => 'Nama',
			 	'rules' => 'trim|required|alpha_numeric_spaces|max_length[32]',
			 	'errors' => array(
			 		'required' => '%s wajib di-input!',
			 		'alpha_numeric_spaces' => 'Mohon input nama dengan benar!',
			 		'max_length' => 'Maks. karakter adalah 32!'
			 	)
			],
			[// email
			 	'field' => 'email',
			 	'label' => 'Email',
			 	'rules' => 'trim|required|valid_email|max_length[64]',
			 	'errors' => array(
			 		'required' => '%s wajib di-input!' ,
			 		'valid_email' => 'Mohon input email yang valid!',
			 		'max_length' => 'Maks. karakter adalah 64!'
			 	)
			],
			[// message
				'field' => 'message',
				'label' => 'Message',
				'rules' => 'trim|required|max_length[255]',
				'errors' => array(
					'required' => 'Mohon input pesan Anda!',
					'max_length' => 'Maks. karakter adalah 255!'
				)
			]
		];
	}
	
	// Save feedback.
	public function insert($feedback)
	{
		if (!$feedback) return;
		return $this->db->insert($this->table, $feedback);
	}

	// Get all feedbacks.
	public function get()
	{
		return $this->db
			->get($this->table)
			->result();
	}

	// Get feedbacks count.
	public function count() {
		return $this->db->count_all($this->table);
	}

	// Delete feedback.
	public function delete($id)
	{
		if (!$id) return;
		return $this->db->delete($this->table, ['id' => $id]);
 	}

 	// Reset feedback table.
 	public function truncate()
 	{
 		return $this->db->truncate($this->table);
 	}
}
