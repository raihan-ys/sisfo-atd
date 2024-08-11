<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['akademik/AuthModel', 'akademik/ArticleModel']);
	}

	// Show list of published articles.
	public function index() 
	{
		// Pagination config.
		$this->load->library('pagination');
		$paging = [
			'base_url' => site_url('article'),
			'page_query_string' => TRUE,
			'total_rows' => $this->ArticleModel->count('published'),
			'per_page' => 10,
			'full_tag_open' => '<div class="pagination-article">',
			'full_tag_close' => '</div>'
		];
		$this->pagination->initialize($paging);

		// rentang dan batasan menampilkan data.
		$limit = $paging['per_page'];
		$offset = html_escape($this->input->get('per_page', true));

		// get user data.
		$data['current_user'] = $this->AuthModel->current_user();

		// get articles.
		$data['articles'] = $this->ArticleModel->get_published($limit, $offset);

		// get submitted keyword.
		$keyword = $this->input->get('keyword', true) == null ? null : trim($this->input->get('keyword', true));
		$data['keyword'] = $keyword;

		// set page title.
		$data['meta'] = ['title' => 'List Artikel'];

		// search article, if the user submitted the search form.
		if (!empty($data['keyword']))
			$data['articles'] = $this->ArticleModel->search($data['keyword'] );

		// show UI. 
		$this->load->view(count($data['articles']) <= 0 ? 
			'article/empty' : 'article/list', $data
		);
	}

	// show the article.
	public function show($slug = null)
	{
		if (!$slug) redirect('errors/page-not-found');

		// get article by slug.
		$data['article'] = $this->ArticleModel->find_by_slug($slug);

		if(!$data['article']) redirect('errors/page-not-found');

		$data['current_user'] = $this->AuthModel->current_user();
		$data['meta'] = ['title' => $data['article']->title];
		$this->load->view('article/show', $data);
	}
}
