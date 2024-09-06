<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KaryawanModel extends CI_Model 
{
	// Define table.
	private $table = 'karyawan';

	// Set rules for add and edit form validation.
	public function rules($intent) 
	{
		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');
 
		if ($intent === 'add') {
			$nik_rules = [
				'field' => 'nik',
				'label' => 'NIK',
				'rules' => 'trim|required|integer|greater_than[0]|is_unique[karyawan.nik]|max_length[10]',
				'errors' => array(
					'required' => '%s wajib di-input!',
					'integer' => '%s hanya terdiri dari digit!',
					'greater_than' => 'Nilai %s tidak boleh 0!',
					'is_unique' => '%s ini sudah tersimpan!',
					'max_length' => 'Maks. 10 digit!'
				)
			];
		} else {
			$nik_rules = [
				'field' => 'nik',
				'label' => 'NIK',
				'rules' => 'trim|required|integer|greater_than[0]|max_length[10]',
				'errors' => array(
					'required' => '%s wajib di-input!',
					'integer' => '%s hanya terdiri dari digit!',
					'greater_than' => 'Nilai %s tidak boleh 0!',
					'max_length' => 'Maks. 10 digit!'
				)
			];
		}
		return [
			// niK
				$nik_rules,
			[// nama
				'field' => 'nama',
				'label' => 'Nama',
				'rules' => 'trim|required|alpha_numeric_spaces|max_length[32]',
				'errors' => array(
					'required' => '%s wajib di-input!',
					'alpha_numeric_spaces' => 'Mohon input nama dengan benar!',
					'max_length' => 'Maks. 32 karakter!'
				)
			],
			[// tpt_lahir
				'field' => 'tpt_lahir',
				'label' => 'Tempat Lahir',
				'rules' => 'trim|required|alpha_numeric_spaces|max_length[32]',
				'errors' => array(
					'required' => '%s wajib di-input!',
					'alpha_numeric_spaces' => 'Mohon input tempat lahir dengan benar!',
					'max_length' => 'Maks. 32 karakter!'
				)
			],
			[// tgl_lahir
				'field' => 'tgl_lahir',
				'label' => 'Tanggal Lahir',
				'rules' => 'trim|required',
				'errors' => array('required' => '%s wajib di-input!')
			],
			[// kelamin
				'field' => 'kelamin',
				'label' => 'Jenis Kelamin',
				'rules' => 'trim|required',
				'errors' => array('required' => '%s wajib dipilih!')
			],
			[// alamat
				'field' => 'alamat',
				'label' => 'Alamat',
				'rules' => 'trim|required|max_length[97]',
				'errors' => array(
					'required' => '%s wajib di-input!',
					'max_length' => 'Maks 97 karakter!'
				)
			],
			[// no_telepon
				'field' => 'no_telepon',
				'label' => 'No. Telepon',
				'rules' => 'trim|required|integer|max_length[12]',
				'errors' => array(
					'required' => 'No. telepon wajib di-input!',
					'integer' => ']No. telepon hanya terdiri dari digit!',
					'max_length' => 'Maks. 15 digit!'
				)
			],
		];
	}
	
	// Get all karyawan.
	public function get($limit = null, $offset = null)
	{
		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		if (!$limit && $offset) 
			return $this->db
				->order_by('nik', 'ASC')
				->get($this->table)
				->result();
		return $this->db
			->order_by('nik', 'ASC')
			->get($this->table, $limit, $offset)
			->result();
	}

	// Search karyawan.
	public function search($keyword, $kelamin) 
	{
		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		// keyword = value, kelamin = empty
		if (!empty($keyword) && empty($kelamin)) {
			$this->db
				->like('nik', $keyword)
				->or_like('nama', $keyword);
		}
		// keyword = value, kelamin = value
		elseif (!empty($keyword) && !empty($kelamin)) {
			$this->db
				->group_start()
					->like('nik', $keyword)
					->or_like('nama', $keyword)
				->group_end()
				->where('kelamin', $kelamin);
		}
		// keyword = empty, kelamin = value
		elseif (empty($keyword) && !empty($kelamin)) {
			$this->db
				->where('kelamin', $kelamin);
		}

		return $this->db
			->order_by('nik', 'ASC')
			->get($this->table)
			->result();
	}

	// Get karyawan count.
	public function count() 
	{
		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		return $this->db->count_all($this->table);
	}

	// Get karyawan by id.
	public function find($id) 
	{
		if (!$id) return;

		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		return $this->db
			->get_where($this->table, ['id' => $id])
			->row();
	}

	// Save karyawan.
	public function insert($karyawan) 
	{
		if (!$karyawan) return;

		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		return $this->db->insert($this->table, $karyawan);
	}

	// Update the specified employee.
	public function update($karyawan) 
	{
		if (!$karyawan['id']) {
			return;
		}

		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		// Get the original nik of this karyawan.
		$original_nik = $this->find($karyawan['id'])->nik;
		if(!$original_nik) return;

		// Check if the submitted nik is the same as the original nik.
		if ($karyawan['nik'] == $original_nik) {
			return $this->db->update($this->table, $karyawan, ['id' => $karyawan['id']]);
		}
		
		// Find out if there's other karyawan with the same nik.
		$nik_duplicated = $this->db
			->where('nik', $karyawan['nik'])
			->get($this->table)
			->row();
		if ($nik_duplicated) return 'nik_duplicated';

		return $this->db->update($this->table, $karyawan, ['id' => $karyawan['id']]);
	}

	// Delete karyawan.
	public function delete($id) 
	{
		if (!$id) return;

		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		return $this->db
			->where('id', $id)
			->delete($this->table);
	}

	// Reset karyawan table.
	public function truncate() 
	{
		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		return $this->db->truncate($this->table);
	}	
}
