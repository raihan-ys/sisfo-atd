<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]
class Mahasiswa extends CI_Controller 
{
	public function __construct() 
	{
		parent::__construct();

		$this->load->model(['akademik/AuthModel', 'akademik/MahasiswaModel']);
		if (!$this->AuthModel->current_user()) redirect('auth/login');

		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	// show all mahasiswa.
	public function index() 
	{
		// pagination config.
		$this->load->library('pagination');
		$paging = [
			'base_url' => site_url('admin/akademik/mahasiswa'),
			'page_query_string' => true,
			'total_rows' => $this->MahasiswaModel->count(),
			'per_page' => 5,	
			'full_tag_open' => '<div class="pagination-mahasiswa">',
			'full_tag_close' => '</div>'
		];
		$this->pagination->initialize($paging);

		// rentang dan batasan menampilkan data.
		$limit = $paging['per_page'];
		$offset = html_escape($this->input->get('per_page', true));

		// get user data.
		$data['current_user'] = $this->AuthModel->current_user();

		// get mahasiswa data.
		$data['mahasiswa'] = $this->MahasiswaModel->get($limit, $offset);

		$keyword = $this->input->get('keyword', true) == null ? null : trim($this->input->get('keyword', true));
		$data['keyword'] = $keyword;	
		$data['kelamin'] = $this->input->get('kelamin', true);
		$data['program_studi'] = $this->input->get('program_studi');

		// set title.
		$data['meta'] = ['title' => 'Mahasiswa'];

		// set options to select in <select> element.
		$data['kelaminx'] = ['Laki-laki', 'Perempuan'];
		$data['program_studix'] = ['Manajemen Informatika', 'Sistem Informasi', 'Teknik Komputer'];

		// search mahasiswa, if the user submitted the search form.
		if (!empty($data['keyword']) || !empty($data['kelamin']) || !empty($data['program_studi'])) {
			$data['mahasiswa'] = $this->MahasiswaModel->search($data['keyword'], $data['kelamin'], $data['program_studi']);
		}

		// show the UI.
		$this->load->view(count($data['mahasiswa']) <= 0 ?
			'admin/akademik/mahasiswa/empty' :
			'admin/akademik/mahasiswa/list', $data
		);
	}

	// insert mahasiwa.
	public function add() 
	{
		// set data to be viewed.
		$data['current_user'] = $this->AuthModel->current_user();
		$data['meta'] = ['title' => 'Mahasiswa'];

		// set options for <select>.
		$data['program_studi'] = ['Manajemen Informatika', 'Sistem Informasi', 'Teknik Komputer'];

		// if the form is submitted.
		if ($this->input->method() === 'post') {

			// set validation rules, then validate the submitted form.
			$this->form_validation->set_rules($this->MahasiswaModel->rules('add'));
			if ($this->form_validation->run() === FALSE) return $this->load->view('admin/akademik/mahasiswa/add', $data);
			
			// submitted data.
			$mahasiswa = [
				'nim' => $this->input->post('nim', true),
				'nama' => $this->input->post('nama', true),
				'tpt_lahir' => $this->input->post('tpt_lahir', true),
				'tgl_lahir' => $this->input->post('tgl_lahir', true),
				'kelamin' => $this->input->post('kelamin', true),
				'alamat' => $this->input->post('alamat', true),
				'no_telepon' => $this->input->post('no_telepon', true),
				'program_studi' => $this->input->post('program_studi', true)
			];

			// insert mahasiswa to database.
			if (!$this->MahasiswaModel->insert($mahasiswa)) redirect('errors/something_wrong');
			$this->session->set_flashdata('mahasiswa_saved', 'Data disimpan!');
		}
		$this->load->view('admin/akademik/mahasiswa/add', $data);
	}

	// update mahasiswa.
	public function edit($id = NULL) 
	{
		// find mahasiswa by id.
		$data['mahasiswa'] = $this->MahasiswaModel->find($id);
		if (!$id || !$data['mahasiswa']) redirect('errors/page_not_found');

		// set data to be used in the view page.
		$data['current_user'] = $this->AuthModel->current_user();
		$data['meta'] = ['title' => 'Mahasiswa'];
		$data['program_studi'] = ['Manajemen Informatika', 'Sistem Informasi', 'Teknik Komputer'];

		// if the form is submitted.
		if ($this->input->method() === 'post') {
			// submitted form validation.
			$this->form_validation->set_rules($this->MahasiswaModel->rules('edit'));
			if($this->form_validation->run() === FALSE) return $this->load->view('admin/akademik/mahasiswa/edit', $data);

			// submitted data.
			$mahasiswa = [
				'id' => $id,
				'nim' => $this->input->post('nim', true),
				'nama' => $this->input->post('nama', true),
				'tpt_lahir' => $this->input->post('tpt_lahir', true),
				'tgl_lahir' => $this->input->post('tgl_lahir', true),
				'kelamin' => $this->input->post('kelamin', true),
				'alamat' => $this->input->post('alamat', true),
				'no_telepon' => $this->input->post('no_telepon', true),
				'program_studi' => $this->input->post('program_studi', true)
			];

			// update mahasiswa.
			$updated = $this->MahasiswaModel->update($mahasiswa);

			if ($updated === true) :
				$this->session->set_flashdata('mahasiswa_updated', 'Data diubah!');

			elseif ($updated === 'nim_duplicated') :
				$this->session->set_flashdata('nim_duplicated', 'NIM ini sudah tersimpan!');

			else :	
				redirect('errors/something_wrong');

			endif;
		}
		$this->load->view('admin/akademik/mahasiswa/edit', $data);
	}

	// delete mahasiswa.
	public function delete($id = null) 
	{
		if (!$id) redirect('errors/page_not_found');

		$deleted = $this->MahasiswaModel->delete($id);
		if ($deleted) {
			$this->session->set_flashdata('mahasiswa_deleted', 'Data dihapus!');
			redirect('admin/akademik/mahasiswa');
		} else {
			redirect('errors/something_wrong');
		}
	}
	
	// reset mahasiswa table.
	public function truncate() 
	{
		if (!$this->MahasiswaModel->truncate()) redirect('errors/something_wrong');

		$this->session->set_flashdata('mahasiswa_truncated', 'Seluruh data dihapus!');
	 	redirect('admin/akademik/mahasiswa');
	}
}
