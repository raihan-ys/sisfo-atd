<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]
class Setting extends CI_Controller
{
	public function __construct() 
	{
		parent::__construct();

		$this->load->model('akademik/auth_model');
		if (!$this->auth_model->current_user()) {
			redirect('auth/login');
		}
	}
 
	// Show setting.
	public function index()
	{
		$data['current_user'] = $this->auth_model->current_user();
		$data['meta'] = ['title' => 'Settings'];
		$this->load->view('admin/setting', $data);
	}

	// crop the image file.
	public function _crop($image_data)
	{
		// if there's no image data, then stop this function.
		if (!$image_data['full_path']) redirect('errors/page-not-found');

		// crop config.
		$image_path = $image_data['full_path'];

		$config = [
			'image_library' => 'gd2',
			'source_image' => $image_path,
			'maintain_ratio' => false,
			'quality' => '100%',
			'x_axis' => $this->input->post('x_axis', true),
			'y_axis' => $this->input->post('y_axis', true),
			'new_image' => $image_path
		];

		// initialize the image manipulation library with the configuration.
		$this->load->library('image_lib');

		$this->image_lib->initialize($config);
		
		$this->image_lib->clear();

		// crop the image.
		return $this->image_lib->crop();
	}

	// resize the image file.
	public function _resize($image_data)
	{
		// if there's no image data, then stop this function.
		if (!$image_data['full_path']) redirect('errors/page-not-found');

		// resize config.
		$image_path = $image_data['full_path'];

		$config = [
			'image_library' => 'gd2',
			'source_image' => $image_path,
			'maintain_ratio' => TRUE,
			'quality' => '100%',
			'height' => $this->input->post('height'),
			'width' => $this->input->post('width'),
			'new_image' => $image_path
		];

		// initialize the image manipulation library with the configuration.
		$this->load->library('image_lib');

		$this->image_lib->initialize($config);
		
		$this->image_lib->clear();

		// resize the image.
		return $this->image_lib->resize();
	}

	// rotate the image file.
	public function _rotate($image_data)
	{
		// if there's no image data, then stop this function.
		if (!$image_data['full_path']) redirect('errors/something_wrong');
		
		// rotate config.
		$image_path = $image_data['full_path'];
		$config = [
			'image_library' => 'gd2',
			'source_image' => $image_path,
			'maintain_ratio' => TRUE,
			'quality' => '100%',
			'rotation_angle' => $this->input->post('rotation_angle', true),
			'new_image' => $image_path
		];

		// initialize the image manipulation library with the configuration.
		$this->load->library('image_lib');

		$this->image_lib->initialize($config);
		
		$this->image_lib->clear();

		// rotate the image.
		return $this->image_lib->rotate();
	}

	// watermark the image.
	public function _watermark($image_data)
	{
		// if there's no image data, then stop this function.
		if (!$image_data['full_path']) redirect('errors/something_wrong');

		// watermark config.
		$image_path = $image_data['full_path'];
		$config = [
			'image_library' => 'gd2',
			'source_image' => $image_path,
			'wm_type' => 'text',
			'wm_text' => $this->input->post('wm_text'),
			'wm_font_size' => $this->input->post('wm_font_size'),
			'wm_font_color' => '808080',
			'wm_font_path' => FCPATH.'/system/fonts/texb.ttf',
			'wm_hor_alignment' => 'bottom',
			'wm_vrt_alignment' => 'right',
			'wm_padding' => 1,
			'wm_shadow_color' => '000000',
			'wm_shadow_distance' => 1,
			'quality' => '100%',
			'new_image' => $image_path
		];

		// initialize the image manipulation library with the configuration.
		$this->load->library('image_lib');

		$this->image_lib->initialize($config);
		
		$this->image_lib->clear();

		// watermark the image.
		return $this->image_lib->watermark();
	}

	// Upload avatar.
	public function avatar_upload()
	{
		// Models.
		$this->load->model('akademik/profile_model');
		// Services.
		$this->load->library('form_validation');

		$data['current_user'] = $this->auth_model->current_user();

		// Get post.
		if ($this->input->method() === 'post') {
			$upload = [
				'upload_path' => FCPATH.'/uploads/user_avatar/',
				'upload_url' => base_url('uploads/user_avatar/'),
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
			if (!$this->profile_model->update($new_data)) {
				redirect('errors/something_wrong');
			}
			$this->session->set_flashdata('message', 'Avatar Updated!');

			
			switch ($this->input->post('action', TRUE)) {
				case 'crop':
					if (!$this->_crop($uploaded_data)) {
						$data['action_error'] =  $this->image_lib->display_errors('<p class="text-danger font-weight-bold">', '</p>');
						return $this->load->view('admin/avatar_upload', $data);
					}
					break;
				case 'resize':
					if (!$this->_resize($uploaded_data)) {
						$data['action_error'] = $this->image_lib->display_errors('<p class="text-danger font-weight-bold">', '</p>');
						return $this->load->view('admin/avatar_upload', $data);
					}
					break;
				case 'rotate':
					if (!$this->_rotate($uploaded_data)) {
						$data['action_error'] = $this->image_lib->display_errors('<p class="text-danger font-weight-bold">', '</p>');
						return $this->load->view('admin/avatar_upload', $data);
					}
					break;
				case 'watermark':
					if (!$this->_watermark($uploaded_data)) {
						$data['action_error'] = $this->image_lib->display_errors('<p class="text-danger font-weight-bold">', '</p>');
						return $this->load->view('admin/avatar_upload', $data);
					}
					break;
				default :
					redirect('admin/setting');
				break;
			}
			redirect('admin/setting');
		}
		$data['meta'] = ['title' => 'Upload Avatar'];
		$this->load->view('admin/avatar_upload', $data);
	}

	// remove user's avatar.
	public function avatar_remove()
	{
		$this->load->model('akademik/profile_model');
		/* *
		 * because we won't load a view/interface to show, 
		 * then we can make the user's data not to be 
		 * keeped in an array like '$data[]'.
		 * */
		$current_user = $this->auth_model->current_user();

		// delete file.
		// php unlink(): menghapus file, sesuai directory/path yang diisi pada argumen/param.
		$file_name = str_replace('.', '', $current_user->id);
		array_map('unlink', glob(FCPATH."/uploads/user_avatar/$file_name.*"));

		// set data avatar pada database menjadi null.
		$new_data = [
			'id' => $current_user->id,
			'avatar' => null
		];

		// remove avatar.
		if (!$this->profile_model->update($new_data)) redirect('errors/something_wrong');
		$this->session->set_flashdata('avatar_deleted', 'Avatar removed!');
		redirect('admin/setting');
	}

	// edit user's profile.
	public function profile_edit() 
	{
		$this->load->library('form_validation');
	
		$data['current_user'] = $this->auth_model->current_user();
		$data['meta'] = ['title' => 'Edit Profile'];

		// if the form is submitted.
		if ($this->input->method() === 'post') {
			$this->load->model('akademik/profile_model');

			// validate the submitted form.
			$this->form_validation->set_rules($this->profile_model->profile_rules());
			if ($this->form_validation->run() == false) return $this->load->view('admin/profile_edit', $data);

			// submitted data.
			$profile = [
				'id' => $data['current_user']->id,
				'name' => $this->input->post('name', true),
				'email' => $this->input->post('email', true)
			];

			// update user's profile.
			if (!$this->profile_model->update($profile)) redirect('errors/something_wrong');

			$this->session->set_flashdata('message', 'Profile updated!');
			redirect('admin/setting');
		}
		$this->load->view('admin/profile_edit', $data);
	}

	// verify user's original password, before changing it.
	public function password_verify()
	{
		$this->load->library('form_validation');

		$data['current_user'] = $this->auth_model->current_user();
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

		$data['current_user'] = $this->auth_model->current_user();
		$data['meta'] = ['title' => 'Change Password'];

		if ($this->input->method() === 'post') {

			// submitted form validation.
			$this->load->model('akademik/profile_model');
			$this->form_validation->set_rules($this->profile_model->password_rules());
			if ($this->form_validation->run() === false) return $this->load->view('admin/password_edit', $data);

			// submitted data.
			$password = [
				'id' => $data['current_user']->id,
				'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
				'password_updated_at' => date("Y-m-d H:i:s")
	    	];

			// updates user's password.
			if (!$this->profile_model->update($password)) redirect('errors/something_wrong'); //<- terjadi kesalahan

			$this->session->set_flashdata('message', 'Password changed!');
			redirect('admin/setting');
		}
		$this->load->view('admin/password_edit', $data);
	}
}
