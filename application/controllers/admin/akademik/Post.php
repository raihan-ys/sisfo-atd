<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller
{
	public function __construct() 
	{
		parent::__construct();

		$this->load->model(['akademik/AuthModel', 'akademik/ArticleModel']);
		if (!$this->AuthModel->current_user()) redirect('auth/login');

		$this->load->library('form_validation');
	}

	// Show all posts.
	public function index()
	{
		// Pagination config.
		$this->load->library('pagination');
		$paging = [
			'base_url' => site_url('admin/akademik/post'),
			'page_query_string' => true,
			'total_rows' => $this->ArticleModel->count(),
			'per_page' => 5,
			'full_tag_open' => '<div class="pagination-article">',
			'full_tag_close' => '</div>'
		];
		$this->pagination->initialize($paging);

		// Set limits to view data.
		$limit = $paging['per_page'];
		$offset = html_escape($this->input->get('per_page', true));

		// Get user data.
		$data['current_user'] = $this->AuthModel->current_user();

		// Get all articles.
		$data['articles'] = $this->ArticleModel->get($limit, $offset);

		// Get keyword and status.
		$keyword = $this->input->get('keyword', true) === null ? null : trim($this->input->get('keyword', true));
		$data['keyword'] = $keyword;
		$data['status'] = $this->input->get('status', true);

		// Set title.
		$data['meta'] = ['title' => 'Posts'];

		// Set options to select in <select> element.
		$data['statusx'] = ['Draft', 'Published'];

		// Search article, if the user submitted the search form.
		if (!empty($data['keyword']) || !empty($data['status'])) {
			$data['articles'] = $this->ArticleModel->search($data['keyword'], $data['status']);
		}

		// Show view.
		$this->load->view(count($data['articles']) <= 0 ?
			'admin/akademik/post/empty' :
			'admin/akademik/post/list', $data
		);
	}

	// Insert new post.
	public function add()
	{
		// set data to be used in the view.
		$data['current_user'] = $this->AuthModel->current_user();
		$data['meta'] = ['title' => 'Posts'];

		// if form is submitted.
		if ($this->input->method() === 'post') {
			// validation prep.
			$image = $_FILES['image'];
			$this->form_validation->set_rules($this->ArticleModel->rules('add'));

			// submitted form validation.
			if (!$image || $this->form_validation->run() === false) {
				if (!$image) $this->session->set_flashdata('file_not_set', 'You did not select a file to upload!');
				return $this->load->view('admin/akademik/post/add', $data);
			}

			// image upload config.
			$upload_config = [
				'upload_path' => FCPATH.'/uploads/article-image/',
				'allowed_types' => 'gif|jpg|jpeg|png',
				'file_name' => str_replace('.', '', $this->input->post('title', true)),
				'overwrite' => true,
				'max_size' => 1024, //<- in KB(Kilo bytes)
				'max_height' => 1480,
				'max_width' => 1480,
			];
			$this->load->library('upload', $upload_config);

			// Upload the image.
			if (!$this->upload->do_upload('image')) {
				$data['image_error'] = $this->upload->display_errors('<p class="text-danger font-weight-bold">', '</p>');
				return $this->load->view('admin/akademik/post/add', $data);
			}

			// Uploaded image data.
			$uploaded_data = $this->upload->data();

			// Create an unique value for the id field.
			$id = uniqid('', true);

			// Submitted data.
			$article = [
				'id' => $id,
				'title' => $this->input->post('title', true),
				'slug' => url_title($this->input->post('title'), 'dash', TRUE).'-'.$id,
				'content' => $this->input->post('content', true),
				'image' => $uploaded_data['file_name'],
				'draft' => $this->input->post('draft', true),
				'user' => $data['current_user']->name,
				'user_avatar' => $data['current_user']->avatar
			];

			// Insert data to database.
			if (!$this->ArticleModel->insert($article)) redirect('errors/something_wrong');

			$this->session->set_flashdata('post_saved', 'Artikel disimpan!');
			redirect('admin/akademik/post');
		}
		$this->load->view('admin/akademik/post/add', $data);
	}

	// update post.
	public function edit($id = null)
	{
		// get article by id.
		$data['article'] = $this->ArticleModel->find($id);
		if(!$data['article'] || !$id) redirect('errors/page_not_found');

		// set data to be used in view.
		$data['current_user'] = $this->AuthModel->current_user();
		$data['meta'] = ['title' => 'Posts'];

		// if form is submitted.
		if ($this->input->method() === 'post') {

			// set the validation rules, then validate the submitted form and the submitted image.
			$image = $_FILES['image'];
			$this->form_validation->set_rules($this->ArticleModel->rules('edit'));
			if (!$image || $this->form_validation->run() === false) {
				if (!$image) $this->session->set_flashdata('file_not_set', 'You did not select a file to upload!');
				return $this->load->view('admin/akademik/post/edit', $data);
			}

			// image uploading config.
			$upload_config = [
				'upload_path' => FCPATH.'/uploads/article-image/',
				'allowed_types' => 'gif|jpg|jpeg|png',
				'file_name' => str_replace('.', '', $this->input->post('title', true)),
				'overwrite' => true,
				'max_size' => 1024, //<- in KB(Kilo bytes)
				'max_height' => 1480,
				'max_width' => 1480
			];
			$this->load->library('upload', $upload_config);

			// upload the image.
			if (!$this->upload->do_upload('image')) {
				$data['image_error'] = $this->upload->display_errors('<p class="text-danger font-weight-bold">', '</p>');
				return $this->load->view('admin/akademik/post/edit', $data);
			}
			
			$uploaded_data = $this->upload->data();
			
			// Submitted data and the uploaded image data.
			$article = [
				'id' => $id,
				'title' => $this->input->post('title', true),
				'slug' => url_title($this->input->post('title'), 'dash', TRUE).'-'.$id,
				'image' => $uploaded_data['file_name'],
				'content' => $this->input->post('content', true),
				'draft' => $this->input->post('draft', true),
				'updated_at' => date("Y-m-d H:i:s")
			];

			// Update data.
			$updated = $this->ArticleModel->update($article);
			
			if ($updated === true) :
				$this->session->set_flashdata('post_updated', 'Article updated!');
				redirect('admin/akademik/post');
			elseif ($updated === 'title_duplicated') :	
				$this->session->set_flashdata('title_duplicated', 'Judul ini sudah terpakai!');
			else :
				redirect('errors/something_wrong');
			endif;
		}
		// if form is not submitted yet
		$this->load->view('admin/akademik/post/edit', $data);
	}

	// delete post.
	public function delete($id = null)
	{
		// if id is not supplied.
		if(!$id) redirect('errors/page_not_found');

		// delete data.
		if (!$this->ArticleModel->delete($id)) redirect('errors/something_wrong');

		$this->session->set_flashdata('post_deleted', 'Artikel dihapus!');
		redirect('admin/akademik/post');
	}

	// reset post table.
	public function truncate()
	{
		if (!$this->ArticleModel->truncate()) redirect('errors/something_wrong');

		$this->session->set_flashdata('post_truncated', 'Semua artikel dihapus!');
		redirect('admin/akademik/post');
	}
}
