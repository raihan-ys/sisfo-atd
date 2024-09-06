<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller 
{
	public function __construct() 
	{
		parent:: __construct();
		$this->load->model(['akademik/AuthModel', 'payroll/JabatanModel']);
		
		// does the user has access?
		if (!$this->AuthModel->current_user()) redirect('auth/login');

		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	// show jabatan.
	public function index() 
	{
		// pagination config.
		$this->load->library('pagination');
		$paging = [
			'base_url' => site_url('admin/payroll/jabatan'),
			'page_query_string' => TRUE,
			'total_rows' => $this->JabatanModel->count(),
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

		// get jabatan data.
		$data['jabatan'] = $this->JabatanModel->get($limit, $offset);

		$keyword = $this->input->get('keyword', true) == null ? null : trim($this->input->get('keyword', true));
		$data['keyword'] = $keyword;

		// set title.
		$data['meta'] = ['title' => 'Jabatan'];

		// search jabatan, if the user submitted the search form.
		if (!empty($data['keyword']))
			$data['jabatan'] = $this->JabatanModel->search($data['keyword']);

		// show the UI.
		$this->load->view(count($data['jabatan']) <= 0 ?
			'admin/payroll/jabatan/empty' :
			'admin/payroll/jabatan/list', $data
		);
	}

	// function untuk melakukan proses tambah data
	public function add() 
	{
		$data['current_user'] = $this->AuthModel->current_user();
		$data['meta'] = ['title' => 'Jabatan'];

		// if the form is submitted
		if ($this->input->method() === 'post') {

			// set the form rules and validation
			$this->form_validation->set_rules($this->JabatanModel->rules('add'));
			if ($this->form_validation->run() === FALSE) return $this->load->view('admin/payroll/jabatan/add', $data);

			// data yang akan di input
			$jabatan = [
				'kode_jabatan' => $this->input->post('kode_jabatan', true),
				'nama_jabatan' => $this->input->post('nama_jabatan', true),
				'gaji_pokok' => $this->input->post('gaji_pokok', true),
				'tunjangan_beras' => $this->input->post('tunjangan_beras', true),
			];

			// is the data inserting process succesful
			if (!$this->JabatanModel->insert($jabatan)) redirect('errors/something_wrong');
			$this->session->set_flashdata('jabatan_saved', 'Data disimpan!');
		}
		$this->load->view('admin/payroll/jabatan/add.php', $data);
	}

	// update jabatan.
	public function edit($id) 
	{	
		$data['jabatan'] = $this->JabatanModel->find($id);
		if (!$id || !$data['jabatan']) redirect('errors/page_not_found');

		// set data to be viewed to the page.
		$data['current_user'] = $this->AuthModel->current_user();
		$data['meta'] = ['title' => 'Jabatan'];

		// if the form is submitted.
		if ($this->input->method() === 'post') {

			// submitted form validation.
			$this->form_validation->set_rules($this->JabatanModel->rules('edit'));
			if($this->form_validation->run() === FALSE) return $this->load->view('admin/payroll/jabatan/edit', $data);

			// submitted data
			$jabatan = [
				'id' => $id,
				'kode_jabatan' => $this->input->post('kode_jabatan', true),
				'nama_jabatan' => $this->input->post('nama_jabatan', true),
				'gaji_pokok' => $this->input->post('gaji_pokok', true),
				'tunjangan_beras' => $this->input->post('tunjangan_beras', true),
			];

			// is the record updated
			$updated = $this->JabatanModel->update($jabatan);

			if ($updated === TRUE) {
				$this->session->set_flashdata('jabatan_updated', 'Data diubah!');
			}
			elseif ($updated === 'kode_duplicated') {
				$this->session->set_flashdata('kode_duplicated', 'Kode jabatan ini sudah tersimpan!');
			} else {
				redirect('errors/something_wrong');
			}
		}
		$this->load->view('admin/payroll/jabatan/edit', $data);
	}

	// delete jabatan.
	public function delete($id) 
	{
		if (!$id) redirect('errors/page_not_found');

		$deleted = $this->JabatanModel->delete($id);
		if ($deleted) {
			$this->session->set_flashdata('jabatan_deleted', 'Data dihapus!');
			redirect('admin/payroll/jabatan');
		} else {
			redirect('errors/something_wrong');
		}
	}
	
	// reset jabatan table.
	public function truncate() 
	{
		if (!$this->JabatanModel->truncate()) redirect('errors/something_wrong');

		$this->session->set_flashdata('jabatan_truncated', 'Seluruh data dihapus!');
	 	redirect('admin/payroll/jabatan');
	}
}
