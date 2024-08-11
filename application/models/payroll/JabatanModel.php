<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JabatanModel extends CI_Model 
{
	// Define table name
	private $table = 'jabatan';

	// Set rules for add and edit form validation.
	public function rules($intent) 
	{
		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		if ($intent === 'add') {
			$kode_rules = [
				'field' => 'kode_jabatan',
				'label' => 'Kode Jabatan',
				'rules' => 'trim|required|is_unique[jabatan.kode_jabatan]|max_length[10]',
				'errors' => array(
					'required' => 'Kode jabatan wajib di-input!',
					'is_unique' => 'Kode ini sudah tersimpan!',
					'max_length' => 'Maks. karakter adalah 10!'
				)
			];
		} else {
			$kode_rules = [
				'field' => 'kode_jabatan',
				'label' => 'Kode Jabatan',
				'rules' => 'trim|required|max_length[10]',
				'errors' => array(
					'required' => 'Kode jabatan wajib di-input!',
					'max_length' => 'Maks. karakter adalah 10!'
				)
			];
		}
		return [
			// kode_jabatan
				$kode_rules,
			[// nama_jabatan
				'field' => 'nama_jabatan',
				'label' => 'Nama Jabatan',
				'rules' => 'trim|required|max_length[32]',
				'errors' => array(
					'required' => 'Nama jabatan harus di-input!',
					'max_length' => 'Maks. karakter adalah 32!'
				)
			],
			[// gaji_pokok
				'field' => 'gaji_pokok',
				'label' => 'Gaji Pokok',
				'rules' => 'trim|required|integer|greater_than[0]|max_length[10]',
				'errors' => array(
					'required' => 'Gaji pokok harus di-input!',
					'integer' => 'Gaji hanya terdiri dari digit!',
					'greater_than' => 'Nilai gaji tidak boleh 0!',
					'max_length' => 'Maks. 10 digit!'
				)	
			],
			[// tunjangan_beras
				'field' => 'tunjangan_beras',
				'label' => 'Tunjangan Beras',
				'rules' => 'trim|integer|max_length[10]',
				'errors' => array(
					'integer' => 'Tunjangan hanya terdiri dari digit!',
					'max_length' => 'Maks. 10 digit!'
				)
			]
		];
	}
	
	// Get all jabatan.
	public function get($limit = null, $offset = null)
	{
		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		if (!$limit && $offset) 
			return $this->db
				->order_by('kode_jabatan', 'ASC')
				->get($this->table)
				->result();
		return $this->db
			->order_by('kode_jabatan', 'ASC')
			->get($this->table, $limit, $offset)
			->result();
	}

	// Search jabatan.
	public function search($keyword) 
	{
		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		return $this->db
			->like('kode_jabatan', $keyword)
			->or_like('nama_jabatan', $keyword)
			->order_by('kode_jabatan', 'ASC')
			->get($this->table)
			->result();
	}

	// Get jabatan count.
	public function count() 
	{
		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		return $this->db->count_all($this->table);
	}
 
	// Save jabatan.
	public function insert($jabatan) 
	{ 
		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		if (!$jabatan) return;
		return $this->db->insert($this->table, $jabatan);
	}

	// Get jabatan by id.
	public function find($id) 
	{
		if (!$id) return;

		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		return $this->db
			->get_where($this->table, ['id' => $id])
			->row();
	}

	// Edit jabatan.
	public function update($jabatan) 
	{
		if (!$jabatan) return;

		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		// Get the orginal kode and nama jabatan attribute.
		$original_kode = $this->find($jabatan['id'])->kode_jabatan;
		$original_nama = $this->find($jabatan['id'])->nama_jabatan;

		// If the submitted kode and nama are the same as the submitted data, then continue updating.
		if ( ($jabatan['kode_jabatan'] === $original_kode || $jabatan['nama_jabatan'] === $original_nama) 
			|| ($jabatan['kode_jabatan'] === $original_kode && $jabatan['nama_jabatan'] === $original_nama) )
			return $this->db->update($this->table, $jabatan, ['id' => $jabatan['id']]);

		// Find out if there's other jabatan with the same kode.
		$kode_duplicated = $this->db
			->where('kode_jabatan', $jabatan['kode_jabatan'])
			->get($this->table)
			->row();
		if ($kode_duplicated) return 'kode_duplicated';

		// Find out if there's other jabatan with the same nama.
		$nama_duplicated = $this->db
			->where('nama_jabatan', $jabatan['nama_jabatan'])
			->get($this->table)
			->row();
		if ($nama_duplicated) return 'nama_duplicated';

		return $this->db->update($this->table, $jabatan, ['id' => $jabatan['id']]);
	}

	// Delete jabatan.
	public function delete($id) 
	{
		if (!$id) return;

		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		return $this->db
			->where('id', $id) 
			->delete($this->table);
	}

	// Reset jabatan table.
	public function truncate() 
	{
		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		return $this->db->truncate($this->table);
	}
}
