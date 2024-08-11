<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileModel extends CI_Model
{
	// Set rules for profile edit form validation.
	public function profile_rules()
	{
		return [
			[// name
				'field' => 'name',
				'label' => 'Nama',
				'rules' => 'trim|required|alpha_numeric_spaces|max_length[32]',
				'errors' => array(
					'required' => '%s wajib di-input!',
					'alpha_numeric_spaces' => 'Mohon isi nama dengan benar!',
					'max_length' => 'Maks. karakter adalah 32!'
				)
			],
			[// email
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email|max_length[64]',
				'errors' => array(
					'required' => '%s wajib di-input!',
					'valid_email' => 'Mohon masukkan email yang yang valid!',
					'max_length' => 'Maks. karakter adalah 64!'
				)
			]
		];
	}

	// Set rules form password edit form validation.
	public function password_rules()
	{
		return [
			[
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required|max_length[255]',
				'errors' => array (
					'required' => 'Mohon input password yang baru!',
					'max_length' => '%s\'s maximum characthers reached!(255)'
				)
			],
			[
				'field' => 'password_confirm',
				'label' => 'Konfirmasi Password',
				'rules' => 'trim|required|matches[password]',
				'errors' => array (
					'required' => 'Input password kembali untuk konfirmasi!',
					'matches' => 'Password tidak cocok!'
				)
			]
		];
	}

	// Update profile or password.
	public function update ($data)
	{
		if (!$data['id']) return;
		return $this->db->update('user', $data, ['id' => $data['id']]);
	}
}
