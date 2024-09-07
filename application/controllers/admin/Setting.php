<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]
class Setting extends CI_Controller
{
	public function __construct() 
	{
		parent::__construct();

		$this->load->model('akademik/AuthModel');
		if (!$this->AuthModel->current_user()) {
			redirect('auth/login');
		}
	}
 
	// Show setting.
	public function index()
	{
		$data['current_user'] = $this->AuthModel->current_user();
		$data['meta'] = ['title' => 'Settings'];
		$this->load->view('admin/setting', $data);
	}

	// Upload avatar.
	public function avatar_upload()
	{
		// Models.
		$this->load->model('akademik/ProfileModel');
		// Services.
		$this->load->library('form_validation');

		$data['current_user'] = $this->AuthModel->current_user();
		$data['meta'] = ['title' => 'Upload Avatar'];

		// Get post.
		if ($this->input->method() === 'post') {
			$upload = [
				'upload_path' => FCPATH.'/uploads/user-avatar/',
				'upload_url' => base_url('uploads/user-avatar/'),
				'allowed_types' => 'gif|jpg|jpeg|png',
				'file_name' => str_replace('.', '', $data['current_user']->id),
				'overwrite' => true,
				'max_size' => 1024,
				'max_height' => 1580,
				'max_width' => 1580
			];
			$this->load->library('upload', $upload);

			// Upload file.
			if (!$this->upload->do_upload('avatar')) {
				$data['upload_error'] = $this->upload->display_errors('<p class="text-danger font-weight-bold">', '</p>');
				return $this->load->view('admin/avatar_upload', $data);
			}
			$uploaded_data = $this->upload->data();
			$new_data = [
				'id' => $data['current_user']->id,
				'avatar' => $uploaded_data['file_name']
			];

			// Update avatar in database.
			if (!$this->ProfileModel->update($new_data)) {
				redirect('errors/something_wrong');
			}
			$this->session->set_flashdata('message', 'Avatar Updated!');

			redirect('admin/setting');
		}
		$this->load->view('admin/avatar_upload', $data);
	}

	// remove user's avatar.
	public function avatar_remove()
	{
		$this->load->model('akademik/ProfileModel');
		$current_user = $this->AuthModel->current_user();

		$file_name = str_replace('.', '', $current_user->id);
		array_map('unlink', glob(FCPATH."/uploads/user_avatar/$file_name.*"));

		// set data avatar pada database menjadi null.
		$new_data = [
			'id' => $current_user->id,
			'avatar' => null
		];

		// remove avatar.
		if (!$this->ProfileModel->update($new_data)) redirect('errors/something_wrong');
		$this->session->set_flashdata('avatar_deleted', 'Avatar removed!');
		redirect('admin/setting');
	}

	// edit user's profile.
	public function profile_edit() 
	{
		$this->load->library('form_validation');
	
		$data['current_user'] = $this->AuthModel->current_user();
		$data['meta'] = ['title' => 'Edit Profile'];

		// if the form is submitted.
		if ($this->input->method() === 'post') {
			$this->load->model('akademik/ProfileModel');

			// validate the submitted form.
			$this->form_validation->set_rules($this->ProfileModel->profile_rules());
			if ($this->form_validation->run() == false) return $this->load->view('admin/profile_edit', $data);

			// submitted data.
			$profile = [
				'id' => $data['current_user']->id,
				'name' => $this->input->post('name', true),
				'email' => $this->input->post('email', true)
			];

			// update user's profile.
			if (!$this->ProfileModel->update($profile)) redirect('errors/something_wrong');

			$this->session->set_flashdata('message', 'Profile updated!');
			redirect('admin/setting');
		}
		$this->load->view('admin/profile_edit', $data);
	}

	// verify user's original password, before changing it.
	public function password_verify()
	{
		$this->load->library('form_validation');

		$data['current_user'] = $this->AuthModel->current_user();
		$data['meta'] = ['title' => 'Verifikasi Password'];

		if ($this->input->method() === 'post') {
			$this->form_validation->set_rules(
				'password', 
				'Password', 
				'trim|required', 
				array('required' => 'Password belum di-input!')
			);
			if ($this->form_validation->run() == false) return $this->load->view('admin/password_verify', $data);
			
			$password = $this->input->post('password');
			if (password_verify($password, $data['current_user']->password)) redirect('admin/setting/password_edit');
			
			$this->session->set_flashdata('verify_failed', 'Password tidak cocok!');
		}
		$this->load->view('admin/password_verify', $data);
	}

	// change user's password.
	public function password_edit() 
	{
		$this->load->library('form_validation');

		$data['current_user'] = $this->AuthModel->current_user();
		$data['meta'] = ['title' => 'Change Password'];

		if ($this->input->method() === 'post') {

			// submitted form validation.
			$this->load->model('akademik/ProfileModel');
			$this->form_validation->set_rules($this->ProfileModel->password_rules());
			if ($this->form_validation->run() === false) return $this->load->view('admin/password_edit', $data);

			// submitted data.
			$password = [
				'id' => $data['current_user']->id,
				'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
				'password_updated_at' => date("Y-m-d H:i:s")
	    	];

			// updates user's password.
			if (!$this->ProfileModel->update($password)) redirect('errors/something_wrong'); //<- terjadi kesalahan

			$this->session->set_flashdata('message', 'Password changed!');
			redirect('admin/setting');
		}
		$this->load->view('admin/password_edit', $data);
	}
}
