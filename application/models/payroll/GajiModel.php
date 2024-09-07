<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GajiModel extends CI_Model 
{
	// Define table.
	private $table = 'gaji';

	// Set rules for add end edit form validation.
	public function rules($intent)
	{
		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		if ($intent === 'add') {
			$no_rules = [
				'field' => 'no_gaji',
				'label' => 'No. Gaji',
				'rules' => 'trim|required|is_unique[gaji.no_gaji]|max_length[10]',
				'errors' => array(
					'required' => '%s wajib di-input!',
					'is_unique' => 'Nomor gaji ini sudah tersimpan!',
					'max_length' => 'Maks. karakter adalah 10!'
				)
			];
		} else {
			$no_rules = [
				'field' => 'no_gaji',
				'label' => 'No. Gaji',
				'rules' => 'trim|required|max_length[10]',
				'errors' => array(
					'required' => '%s wajib di-input!',
					'max_length' => 'Maks. karakter adalah 10!'
				)
			];
		}
		return [
			// no_gaji
				$no_rules,
			[// tgl_gaji
				'field' => 'tgl_gaji',
				'label' => 'Tanggal Gaji',
				'rules' => 'trim|required',
				'errors' => array(
					'required' => 'Tanggal harus di-input!',
				)
			],
			[// nik
				'field' => 'nik',
				'label' => 'NIK',
				'rules' => 'trim|required|integer|greater_than[0]|max_length[10]',
				'errors' => array(
					'required' => '%s harus di-input!',
					'integer' => '%s hanya terdiri dari digit!',
					'greater_than' => 'Nilai tidak boleh 0!',
					'max_length' => 'Maks. 10 digit!'
				)	
			],
			[// kode_jabatan
				'field' => 'kode_jabatan',
				'label' => 'Kode Jabatan',
				'rules' => 'trim|required|max_length[10]',
				'errors' => array(
					'required' => 'Kode Jabatan harus di-input!',
					'max_length' => 'Maks. 10 karakter!'
				)
			],
			[// gaji_pokok
				'field' => 'gaji_pokok',
				'label' => 'Gaji Pokok',
				'rules' => 'trim|required|integer|greater_than[0]|max_length[10]',
				'errors' => array(
					'required' => 'Gaji pokok harus di-input!',
					'integer' => 'Gaji pokok hanya terdiri dari digit!',
					'greater_than' => 'Nilai gaji pokok tidak boleh 0!',
					'max_length' => 'Maks. 10 digit!'
				)
			],
			[// tunjangan_beras
				'field' => 'tunjangan_beras',
				'label' => 'Tunjangan Beras',
				'rules' => 'trim|integer|max_length[10]',
				'errors' => array(
					'integer' => 'Tunjangan beras hanya terdiri dari digit!',
					'max_length' => 'Maks. 10 digit!'
				)
			],
			[// potongan_telat
				'field' => 'potongan_telat',
				'label' => 'Potongan Telat',
				'rules' => 'trim|integer|max_length[10]',
				'errors' => array(
					'integer' => 'Potongan telat hanya terdiri dari digit!',
					'max_length' => 'Maks. 10 digit!'
				)
			],
			[// potongan_absen
				'field' => 'potongan absen',
				'label' => 'Potongan Absen',
				'rules' => 'trim|integer|max_length[10]',
				'errors' => array(
					'integer' => 'Potongan absen hanya terdiri dari digit!',
					'max_length' => 'Maks. 10 digit!'
				)
			],
			[// bonus
				'field' => 'bonus',
				'label' => 'Bonus',
				'rules' => 'trim|integer|max_length[10]',
				'errors' => array(
					'integer' => 'Bonus hanya terdiri dari digit!',
					'max_length' => 'Maks. 10 digit!'
				)
				],
				[// gaji_bersih
				'field' => 'gaji_bersih',
				'label' => 'Gaji Bersih',
				'rules' => 'trim|required|integer|max_length[10]',
				'errors' => array(
					'required' => 'Gaji bersih harus di-input!',
					'integer' => 'Gaji bersih hanya terdiri dari digit!',
					'max_length' => 'Maks. 10 digit!'
				)
			]
		];
	}
	
	// Get all gaji.
	public function get($limit = null, $offset = null)
	{
		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		if (!$limit && $offset) 
			return $this->db
				->order_by('no_gaji', 'ASC')
				->get($this->table)
				->result();
		return $this->db
			->order_by('no_gaji', 'ASC')
			->get($this->table, $limit, $offset)
			->result();
	}

	// Search gaji.
	public function search($keyword) 
	{
		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		return $this->db
			->where('no_gaji', $keyword)
			->order_by('no_gaji', 'ASC')
			->get($this->table)
			->result();
	}

	// Get gaji count.
	public function count() 
	{
		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		return $this->db->count_all($this->table);
	}
 
	// Save gaji.
	public function insert($gaji)
	{
		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		if (!$gaji) return;
		return $this->db->insert($this->table, $gaji);
	}
	
	// Get gaji by id.
	public function find($id) 
	{
		if (!$id) return;

		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');
		
		return $this->db
			->get_where($this->table, ['id' => $id])
			->row();
	}

	// Edit gaji.
	public function update($gaji) 
	{
		if (!$gaji['id']) return;

		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		// Get the original no_gaji of this gaji.
		$original_no = $this->find($gaji['id'])->no_gaji;

		// If the submitted no_gaji are the same as the submitted data, then continue updating.
		if ($gaji['no_gaji'] == $original_no) return $this->db->update($this->table, $gaji, ['id' => $gaji['id']]);
	
		// Find out if there's other gaji with the same no_gaji.	
		$no_duplicated = $this->db
			->where('no_gaji', $gaji['no_gaji'])
			->get($this->table)
			->row();
		if ($no_duplicated) return 'no_duplicated';

		return $this->db->update($this->table, $gaji, ['id' => $gaji['id']]);
	}

	// Delete gaji.
	public function delete($id) 
	{
		if (!$id) return;

		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');

		return $this->db
			->where('id', $id)
			->delete($this->table);
	}

	// Reset gaji table.
	public function truncate() 
	{
		// Select other database in the same connection.
		$this->db->db_select('atd_payroll');
		
		return $this->db->truncate($this->table);
	}	
}
