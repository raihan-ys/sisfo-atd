<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller 
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->model(['akademik/AuthModel', 'akademik/MahasiswaModel']);
	}

	// Show homepage.
	public function index() 
	{
		$data = [
			'current_user' => $this->AuthModel->current_user(),
			'meta' => ['title' => 'Home']
		];
		$this->load->view('home', $data);
	}

	// Show calculator page.
	public function calculator() 
	{
		$data = [
			'current_user' => $this->AuthModel->current_user(),
			'meta' => ['title' => 'Calculator']
		];
		$this->load->view('calculator', $data);
	}

	// Show contact page.
	public function contact() 
	{
		$this->load->library('form_validation');

		$data = [
			'current_user' => $this->AuthModel->current_user(),
			'meta' => ['title' => 'Contact']
		];

		// If the form is submitted.
		if ($this->input->method() === 'post') {

			$this->load->model('akademik/FeedbackModel');

			// Validate the submitted form.
			$this->form_validation->set_rules($this->FeedbackModel->rules());
			if ($this->form_validation->run() === false) return $this->load->view('contact', $data);

			// Submitted data.
			$feedback = [
				'id' => uniqid('', true),
				'name' => $this->input->post('name', true),
				'email' => $this->input->post('email', true),
				'message' => $this->input->post('message', true)
			];

			// Insert the data.
			if (!$this->FeedbackModel->insert($feedback)) redirect('errors/something_wrong');
			
			$this->session->set_flashdata(
				'message_sent', 
				'Terimakasih telah menghubungi kami!<br> Pesan Anda telah terkirim.'
			);
		}
		$this->load->view('contact', $data);
	}
}
