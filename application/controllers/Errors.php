<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Show error pages.
class Errors extends CI_Controller 
{
	public function __construct() {
		parent::__construct();
		$this->load->model('akademik/AuthModel');
	}

	public function page_not_found()
	{
		$data = [
			'current_user' => $this->AuthModel->current_user(),
			'meta' => ['title' => '404']
		];
		$this->load->view('errors/page-not-found', $data);
	}

	public function something_wrong() 
	{
		$data = [
			'current_user' => $this->AuthModel->current_user(),
			'meta' => ['title' => 'Something wrong!']
		];
		$this->load->view('errors/something-wrong', $data);
	}
}
