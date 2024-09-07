<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gaji extends CI_Controller 
{
	public function __construct() 
	{
		parent:: __construct();
		$this->load->model(['akademik/AuthModel', 'payroll/GajiModel', 'payroll/KaryawanModel', 'payroll/JabatanModel']);
		
		if (!$this->AuthModel->current_user()) redirect('auth/login');

		$this->load->helper('form');
		$this->load->library('form_validation');
	}

	// show gaji.
	public function index() 
	{
		
		// pagination config.
		$this->load->library('pagination');
		$paging = [
			'base_url' => site_url('admin/payroll/gaji'),
			'page_query_string' => TRUE,
			'total_rows' => $this->GajiModel->count(),
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

		// get gaji data.
		$data['gaji'] = $this->GajiModel->get($limit, $offset);

		$keyword = $this->input->get('keyword', true) == null ? null : trim($this->input->get('keyword', true));
		$data['keyword'] = $keyword;

		// set title.
		$data['meta'] = ['title' => 'Penggajian'];

		// search gaji, if the user submitted the search form.
		if (!empty($data['keyword']))
			$data['gaji'] = $this->GajiModel->search($data['keyword']);

		// show the UI.
		$this->load->view(count($data['gaji']) <= 0 ?
			'admin/payroll/gaji/empty' :
			'admin/payroll/gaji/list', $data
		);
	}

	// Save gaji.
	public function add() 
	{
		$data['current_user'] = $this->AuthModel->current_user();
		$data['meta'] = ['title' => 'Penggajian'];

		// Get all karyawan and jabatan.
		$data['karyawan'] = $this->KaryawanModel->get();
		$data['jabatan'] = $this->JabatanModel->get();

		// if the form is submitted
		if ($this->input->method() === 'post') {

			// set the form rules and validation
			$this->form_validation->set_rules($this->GajiModel->rules('add'));
			if ($this->form_validation->run() === FALSE) return $this->load->view('admin/payroll/gaji/add', $data);

			// data yang akan di input
			$gaji = [
				'no_gaji' => $this->input->post('no_gaji', true),
				'tgl_gaji' => $this->input->post('tgl_gaji', true),
				'nik' => $this->input->post('nik', true),
				'kode_jabatan' => $this->input->post('kode_jabatan', true),
				'gaji_pokok' => $this->input->post('gaji_pokok', true),
				'tunjangan_beras' => $this->input->post('tunjangan_beras', true),
				'potongan_telat' => $this->input->post('potongan_telat', true),
				'potongan_absen' => $this->input->post('potongan_absen', true),
				'bonus' => $this->input->post('bonus', true),
				'gaji_bersih' => $this->input->post('gaji_bersih', true),
			];

			// Is the data inserting process succesful.
			if (!$this->GajiModel->insert($gaji)) redirect('errors/something_wrong');
			$this->session->set_flashdata('gaji_saved', 'Data disimpan!');
		}
		$this->load->view('admin/payroll/gaji/add.php', $data);
	}

	// update gaji.
	public function edit($id) 
	{	
		$data['gaji'] = $this->GajiModel->find($id);
		if (!$id || !$data['gaji']) redirect('errors/page_not_found');

		// set data to be viewed to the page.
		$data['current_user'] = $this->AuthModel->current_user();
		$data['meta'] = ['title' => 'Penggajian'];

		// if the form is submitted.
		if ($this->input->method() === 'post') {

			// submitted form validation.
			$this->form_validation->set_rules($this->GajiModel->rules('edit'));
			if($this->form_validation->run() === FALSE) return $this->load->view('admin/payroll/gaji/edit', $data);

			// submitted data
			$gaji = [
				'id' => $id,
				'no_gaji' => $this->input->post('no_gaji', true),
				'tgl_gaji' => $this->input->post('tgl_gaji', true),
				'nik' => $this->input->post('nik', true),
				'kode_jabatan' => $this->input->post('kode_jabatan', true),
				'gaji_pokok' => $this->input->post('gaji_pokok', true),
				'tunjangan_beras' => $this->input->post('tunjangan_beras', true),
				'potongan_telat' => $this->input->post('potongan_telat', true),
				'potongan_absen' => $this->input->post('potongan_absen', true),
				'bonus' => $this->input->post('bonus', true),
				'gaji_bersih' => $this->input->post('gaji_bersih', true),
			];

			// Is the updating proccess succesful?
			$updated = $this->GajiModel->update($gaji);

			if ($updated === true) {
				$this->session->set_flashdata('gaji_updated', 'Data diubah!');
			}
			elseif ($updated === 'no_duplicated') {
				$this->session->set_flashdata('no_duplicated', 'No. gaji ini sudah tersimpan!');
			}
			else {
				redirect('errors/something_wrong');
			}
		}
		$this->load->view('admin/payroll/gaji/edit', $data);
	}

	// Delete gaji.
	public function delete($id) 
	{
		if (!$id) redirect('errors/page_not_found');

		$deleted = $this->GajiModel->delete($id);
		if ($deleted) {
			$this->session->set_flashdata('gaji_deleted', 'Data dihapus!');
			redirect('admin/payroll/gaji');
		} else {
			redirect('errors/something_wrong');
		}
	}
	
	// Reset gaji table.
	public function truncate() 
	{
		if (!$this->GajiModel->truncate()) redirect('errors/something_wrong');

		$this->session->set_flashdata('gaji_truncated', 'Seluruh data dihapus!');
	 	redirect('admin/payroll/gaji');
	}
}
