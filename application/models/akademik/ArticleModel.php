<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ArticleModel extends CI_Model 
{
	// Define table name.
	private $table = 'article';

	// set rules for add and edit form validation.
	public function rules($intent = null)
	{
		if (!$intent) return;

		if ($intent === 'add') {
			$title_rules = [
				'field' => 'title',
				'label' => 'Judul',
				'rules' => 'trim|required|is_unique[article.title]|max_length[128]',
				'errors' => array(
					'required' => '%s wajib diisi!',
					'is_unique' => '%s ini sudah terpakai!',
					'max_length' => 'Maks. karakter adalah 128!'
				)
			];
		} else {
			$title_rules = [
				'field' => 'title',
				'label' => 'Judul',
				'rules' => 'trim|required|max_length[128]',
				'errors' => array(
					'required' => '%s wajib diisi!',
					'max_length' => 'Maks. karakter adalah 128!'
				)
			];
		}

		return [
			// title
				$title_rules,
			[// content
				'field' => 'content',
				'label' => 'Konten',	
				'rules' => 'trim|required|max_length[65535]',
				'errors' => array(
					'required' => '%s wajib di-input!',
					'max_length' => 'Maks 65.535 karakter!'
				)
			],
			[// draft
				'field' => 'draft',
				'label' => 'Draft',
				'rules' => 'required|in_list[true,false]'
			]
		];
	}

	// Get all articles.
	public function get()
	{
		return $this->db
			->get($this->table)
			->result();
	}

	// Get all *published* articles.
	public function get_published($limit = null, $offset = null)
	{
		if (!$limit && $offset) 
			return $this->db
				->get_where($this->table, ['draft' => 'false'])
				->result();
		return $this->db
			->get_where($this->table, ['draft' => 'false'], $limit, $offset)
			->result();
	}

	// Get articles count.
	public function count($status = null) 
	{
		if (!$status) return $this->db->count_all($this->table);
		if ($status === 'draft') 
			return $this->db
				->get_where($this->table, ['draft' => 'true'])
				->num_rows();
		if ($status === 'published')
			return $this->db
				->get_where($this->table, ['draft' => 'false'])
				->num_rows(); 
	}

	// Get article by id.
	public function find($id = null)
	{
		if (!$id) return;
		return $this->db
			->get_where($this->table, ['id' => $id])
			->row();
	}
 
 	// Get article by slug.
	public function find_by_slug($slug = null) 
	{
		if (!$slug) return;
		return $this->db
			->get_where($this->table, ['slug' => $slug])
			->row();
	}

	// Search article by keyword and status.
	public function search($keyword, $status)
	{
		// $keyword = value, $status = value
		if (!empty($keyword) && !empty($status)) {
			$this->db
				->group_start()
					->like('title', $keyword)
					->or_like('content', $keyword)
				->group_end()
				->where('draft', $status === 'Draft' ? 'true' : 'false');
		}
		// $keyword = value, $status = empty
		elseif (!empty($keyword) && empty($status)) {
			$this->db
				->like('title', $keyword)
				->or_like('content', $keyword);
		}
		// $keyword = empty, $status = value
		elseif (empty($keyword) && !empty($status)) {
			$this->db
				->where('draft', $status === 'Draft' ? 'true' : 'false');
		}
		return $this->db
			->order_by('title', 'ASC')
			->get($this->table)
			->result();
	}

	// Save article.
	public function insert($article = null) 
	{
		if (!$article) return;
		return $this->db->insert($this->table, $article);
	}

	// Update the specified article.
	public function update($article = null) 
	{
		if (!$article['id']) {
			return;
		}

		// Get the original article's title.
		$title = strtolower($this->find($article['id'])->title);

		// If the submitted title is the same as the original title, then continue update this article.
		if (strtolower($article['title']) === $title) {
			return $this->db->update($this->table, $article, ['id' => $article['id']]);
		}

		// Find out if there's other article with the same title.
		$title_duplicated = $this->db
			->where('title', $article['title'])
			->get($this->table)
			->row();
		if ($title_duplicated) {
			return 'title_duplicated';
		}

		return $this->db->update($this->table, $article, ['id' => $article['id']]);
	}

	// Delete article.
	public function delete($id = null)
	{
		if (!$id) return;
		return $this->db->delete($this->table, ['id' => $id]);
	}

	// Reset article table.
	public function truncate() 
	{
		return $this->db->truncate($this->table);
	}
}
