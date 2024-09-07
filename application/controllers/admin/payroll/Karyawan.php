<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends CI_Controller 
{
	public function __construct() 
	{
		parent:: __construct();
		$this->load->model(['akademik/AuthModel', 'payroll/KaryawanModel']);

		// does the user has access?
		if (!$this->AuthModel->current_user())
			redirect('auth/login');

		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	// Display all employees.
	public function index() 
	{
		// Pagination config.
		$this->load->library('pagination');
		$paging = [
			'base_url' => site_url('admin/payroll/karyawan'),
			'page_query_string' => TRUE,
			'total_rows' => $this->KaryawanModel->count(),
			'per_page' => 5,
			'full_tag_open' => '<div class="pagination-mahasiswa">',
			'full_tag_close' => '</div>'
		];
		$this->pagination->initialize($paging);

		// Set limit.
		$limit = $paging['per_page'];
		$offset = html_escape($this->input->get('per_page', true));

		// Get current user data.
		$data['current_user'] = $this->AuthModel->current_user();

		// Get submitted keyword
		$keyword = $this->input->get('keyword', true) == null ? null : trim($this->input->get('keyword', true));
		$data['keyword'] = $keyword;
		$data['kelamin'] = $this->input->get('kelamin', true);

		// Set options to select in <select> element.
		$data['kelaminx'] = ['Laki-laki', 'Perempuan'];

		// Get all employees.
		if (!empty($data['keyword'] || !empty($data['kelamin']))) {
			$data['karyawan'] = $this->KaryawanModel->search($data['keyword'], $data['kelamin']);
		} else {
			$data['karyawan'] = $this->KaryawanModel->get($limit, $offset);
		}

		// Set title.
		$data['meta'] = ['title' => 'Karyawan'];

		$this->load->view(count($data['karyawan']) <= 0 ?
			'admin/payroll/karyawan/empty' :
			'admin/payroll/karyawan/list', $data
		);
	}

	// insert karyawan.
	public function add() 
	{
		$data['current_user'] = $this->AuthModel->current_user();
		$data['meta'] = ['title' => 'Karyawan'];

		// if the form is submitted.
		if ($this->input->method() === 'post') {

			// set the form rules and validation
			$this->form_validation->set_rules($this->KaryawanModel->rules('add'));
			if ($this->form_validation->run() === FALSE) return $this->load->view('admin/payroll/karyawan/add', $data);

			// Submitted data.
			$karyawan = [
				'nik' => $this->input->post('nik', true),
				'nama' => $this->input->post('nama', true),
				'tpt_lahir' => $this->input->post('tpt_lahir', true),
				'tgl_lahir' => $this->input->post('tgl_lahir', true),
				'kelamin' => $this->input->post('kelamin', true),
				'alamat' => $this->input->post('alamat', true),
				'no_telepon' => $this->input->post('no_telepon', true)
			];

			// Insert data.
			if (!$this->KaryawanModel->insert($karyawan)) redirect('errors/something_wrong');
			$this->session->set_flashdata('karyawan_saved', 'Data disimpan!');
		}
		$this->load->view('admin/payroll/karyawan/add.php', $data);
	}

	// Update the specified employee.
	public function edit($id) 
	{
		$data['karyawan'] = $this->KaryawanModel->find($id);
		if (!$id || !$data['karyawan']) {
			redirect('errors/page_not_found');
		}

		// Get current user data.
		$data['current_user'] = $this->AuthModel->current_user();
		$data['meta'] = ['title' => 'Karyawan'];

		if ($this->input->method() === 'post') {

			// Validate the submitted form.
			$this->form_validation->set_rules($this->KaryawanModel->rules('edit'));
			if($this->form_validation->run() === FALSE) {
				return $this->load->view('admin/payroll/karyawan/edit', $data);
			}

			$karyawan = [
				'id' => $id,
				'nik' => $this->input->post('nik', true),
				'nama' =>	 $this->input->post('nama', true),
				'tpt_lahir' => $this->input->post('tpt_lahir', true),
				'tgl_lahir' => $this->input->post('tgl_lahir', true),
				'kelamin' => $this->input->post('kelamin', true),
				'alamat' => $this->input->post('alamat', true),
				'no_telepon' => $this->input->post('no_telepon', true)
			];

			// is the record updated.
			$updated = $this->KaryawanModel->update($karyawan);

			if ($updated === true) {
				$this->session->set_flashdata('karyawan_updated', 'Data diubah!');
			}
			elseif ($updated === 'nik_duplicated') {
				$this->session->set_flashdata('nik_duplicated', 'NIK Karyawan ini sudah tersimpan!');
			}
			elseif ($updated == false) {
				redirect('errors/something_wrong');
			}
		}
		$this->load->view('admin/payroll/karyawan/edit', $data);
	}

	// function untuk menghapus record.
	public function delete($id) 
	{
		if (!$id) redirect('errors/page_not_found');

		$deleted = $this->KaryawanModel->delete($id);
		if ($deleted) {
			$this->session->set_flashdata('karyawan_deleted', 'Data dihapus!');
			redirect('admin/payroll/karyawan');
		} else {
			redirect('errors/something_wrong');
		}
	}
	
	// reset karyawan table.
	public function truncate() 
	{
		$trucated = $this->KaryawanModel->truncate();
		if ($trucated) {
			$this->session->set_flashdata('karyawan_truncated', 'Seluruh data dihapus!');
			redirect('admin/payroll/karyawan');
		} else {
			redirect('errors/something_wrong');
		}
	}
}
