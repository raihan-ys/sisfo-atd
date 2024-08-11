<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('akademik/AuthModel');
	}

	// redirect.
	public function index() 
	{
		redirect('errors/page_not_found');
	}

	// login function.
	public function login()
	{
		$this->load->library('form_validation');

		// if the user already login, then redirect.
		$data['current_user'] = $this->AuthModel->current_user();
		if ($data['current_user']) redirect('admin/dashboard');

		$data['meta'] = ['title' => 'Login'];

		// if the login form is submitted.
		if ($this->input->method() === 'post') {

			// validate the submitted data.
			$this->form_validation->set_rules($this->AuthModel->rules());
			if ($this->form_validation->run() === false) return $this->load->view('login', $data);

			// is the user has access?
			$username = $this->input->post('username', true);
			$password = $this->input->post('password', true);
			if ( $this->AuthModel->login($username, $password) ) 
				redirect('admin/dashboard');

			$this->session->set_flashdata('login_failed', 'Login gagal, pastikan username dan password benar!');
		} 
		$this->load->view('login', $data);
	}

	// Logout.
	public function logout() 
	{
		if ($this->AuthModel->current_user()) $this->AuthModel->logout();
		redirect('auth/login');
	}
}
