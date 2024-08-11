<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->model(['akademik/AuthModel', 'akademik/FeedbackModel']);
		if (!$this->AuthModel->current_user()) redirect('auth/login');
	}

	// show feedbacks
	public function index()
	{
		$data['feedbacks'] = $this->FeedbackModel->get();
		$data['current_user'] = $this->AuthModel->current_user();
		$data['meta'] = ['title' => 'Feedback'];
		
		$this->load->view(count($data['feedbacks']) > 0 ? 
			'admin/akademik/feedback/list' :
			'admin/akademik/feedback/empty', $data
		);
	}

	// delete feedback.
	public function delete($id = null) 
	{
		if (!$id) redirect('errors/page_not_found');

		if (!$this->FeedbackModel->delete($id)) redirect('errors/something_wrong');

		$this->session->set_flashdata('feedback_deleted', 'Feedback deleted!');
		redirect('admin/akademik/feedback');
	}

	// delete all feedbacks
	public function truncate()
	{
		if (!$this->FeedbackModel->truncate()) redirect('admin/akademik/feedback');
		
		$this->session->set_flashdata('feedback_truncated', 'All feedbacks deleted!');
		redirect('admin/akademik/feedback');
	}
}
