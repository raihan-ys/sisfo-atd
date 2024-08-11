<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswamodel extends CI_Model 
{
	// Define table.
	private $table = 'mahasiswa';

	// Set rules for add and edit form validation.
	public function rules($intent) 
	{
		if ($intent === 'add') {
			$nim_rules = [
				'field' => 'nim',
				'label' => 'NIM',
				'rules' => 'trim|required|integer|greater_than[0]|is_unique[mahasiswa.nim]|max_length[10]',
				'errors' => array(
					'required' => '%s wajib di-input!',
					'integer' => '%s hanya terdiri dari digit!',
					'greater_than' => 'Nilai %s tidak boleh 0!',
					'is_unique' => '%s ini sudah tersimpan!',
					'max_length' => 'Maks. 10 digit!'
				)
			];
		} else {
			$nim_rules = [
				'field' => 'nim',
				'label' => 'NIM',
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
			// nim
				$nim_rules,
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
					'integer' => 'No. telepon hanya terdiri dari digit!',
					'max_length' => 'Maks. 12 digit!'
				)
			],
			[// program_studi
				'field' => 'program_studi',
				'label' => 'Program Studi',
				'rules' => 'trim|required',
				'errors' => array('required' => 'Program studi wajib dipilih!')
			]
		];
	}
	
	// Get all mahasiswa.
	public function get($limit = null, $offset = null)
	{
		if (!$limit && $offset) 
			return $this->db
				->order_by('nim', 'ASC')
				->get($this->table)
				->result();
		return $this->db
			->order_by('nim', 'ASC')
			->get($this->table, $limit, $offset)
			->result();
	}

	// Search mahasiswa.
	public function search($keyword, $kelamin, $program_studi) 
	{
		// keyword = value, kelamin = empty, program_studi = empty
		if (!empty($keyword) && empty($kelamin) && empty($program_studi)) {
			$this->db
				->like('nim', $keyword)
				->or_like('nama', $keyword);
		}
		// keyword = value, kelamin = value, program_studi = empty
		elseif (!empty($keyword) && !empty($kelamin) && empty($program_studi)) {
			$this->db
				->like('nim', $keyword)
				->or_like('nama', $keyword)
				->where('kelamin', $kelamin);
		}
		// keyword = value, kelamin = value, program_studi = value
		elseif (!empty($keyword) && !empty($kelamin) && !empty($program_studi)) {
			$this->db
				->like('nim', $keyword)
				->or_like('nama', $keyword)
				->where(['kelamin' => $kelamin, 'program_studi' => $program_studi]);
		}
		// keyword = empty, kelamin = value, program_studi = value
		elseif (empty($keyword) && !empty($kelamin) && !empty($program_studi)) {
			$this->db
				->where(['kelamin' => $kelamin, 'program_studi' => $program_studi]);
		}
		// keyword = value, kelamin = empty, program_studi = value
		elseif (!empty($keyword) && empty($kelamin) && !empty($program_studi)) {
			$this->db
				->like('nim', $keyword)
				->or_like('nama', $keyword)
				->where('program_studi', $program_studi);
		}
		// keyword = empty, kelamin = value, program_studi = empty
		elseif (empty($keyword) && !empty($kelamin) && empty($program_studi)) {
			$this->db	
				->where('kelamin', $kelamin);
		}
		// keyword = empty, kelamin = empty, program_studi = value
		elseif (empty($keyword) && empty($kelamin) && !empty($program_studi)) {
			$this->db
				->where('program_studi', $program_studi);
		} 
		// keyword = empty, kelamin = empty, program_studi = empty
		return $this->db
			->order_by('nim', 'ASC')
			->get($this->table)
			// and runs the query.
			->result();
	}

	// Get mahasiswa count.
	public function count($program_studi = null) 
	{
		if(!$program_studi) return $this->db->count_all($this->table);
		return $this->db
			->get_where($this->table, ['program_studi' => $program_studi])
			->num_rows();
	}

	// Find mahasiswa by id.
	public function find($id) 
	{
		if (!$id) return;
		return $this->db
			->get_where($this->table, ['id' => $id])
			->row();
	}
 
	// Insert mahasiswa.
	public function insert($mahasiswa) 
	{
		if (!$mahasiswa) return;
		return $this->db->insert($this->table, $mahasiswa);
	}

	// Edit mahasiswa.
	public function update($mahasiswa) 
	{
		if (!$mahasiswa['id']) return;

		// Get original nim.
		$original_nim = $this->find($mahasiswa['id'])->nim;
		if (!$original_nim) return;

		// If the submitted nim is the same as the original nim.
		if ($mahasiswa['nim'] == $original_nim) 
			return $this->db->update($this->table, $mahasiswa, ['id' => $mahasiswa['id']]);

		// Find out if there's other mahasiswa with the same name.
		$nim_duplicated = $this->db
			->where('nim', $mahasiswa['nim'])
			->get($this->table)
			->row();
		if ($nim_duplicated) return 'nim_duplicated';

		return $this->db->update($this->table, $mahasiswa, ['id' => $mahasiswa['id']]);
	}

	// Delete mahasiswa.
	public function delete($id) 
	{
		if (!$id) return;
		return $this->db
			->where('id', $id)
			->delete($this->table);
	}

	// Reset mahasiswa table.
	public function truncate() 
	{
		return $this->db->truncate($this->table);
	}	
}
