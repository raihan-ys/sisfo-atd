<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function index()
	{
		$this->load->model('akademik/AuthModel');

		$data['current_user'] = $this->AuthModel->current_user();
		if (!$data['current_user']) redirect('auth/login');

		$this->load->model([
			'akademik/MahasiswaModel', 
			'akademik/ArticleModel', 
			'akademik/FeedbackModel',
			'payroll/JabatanModel',
			'payroll/KaryawanModel',
			'payroll/GajiModel',
		]);

		$data['mahasiswa_count'] = [
			'mi_count' => $this->MahasiswaModel->count('Manajemen Informatika'),
			'si_count' => $this->MahasiswaModel->count('Sistem Informasi'),
			'tk_count' => $this->MahasiswaModel->count('Teknik Komputer')
		];

		$data['article_count'] = [
			'draft_count' => $this->ArticleModel->count('draft'),
			'published_count' => $this->ArticleModel->count('published')
		];

		$data['feedback_count'] = $this->FeedbackModel->count();
		$data['jabatan_count'] = $this->JabatanModel->count();
		$data['karyawan_count'] = $this->KaryawanModel->count();

		$data['gaji_count'] = $this->GajiModel->count();


		$data['meta'] = ['title' => 'Dashboard'];
		$this->load->view('admin/dashboard', $data);
	}
}
