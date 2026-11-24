<?php

namespace App\Models;

use CodeIgniter\Model;

class MataKuliahModel extends Model
{
    protected $table         = 'mata_kuliah';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['kode', 'nama', 'sks', 'semester', 'dosen_id'];

    protected $validationRules = [
        'kode'     => 'required|min_length[3]|max_length[20]',
        'nama'     => 'required|min_length[3]|max_length[120]',
        'sks'      => 'required|integer|greater_than[0]|less_than_equal_to[6]',
        'semester' => 'required|integer|greater_than[0]|less_than_equal_to[8]',
    ];

    public function getWithDosen(): array
    {
        return $this->db->table('mata_kuliah mk')
            ->select('mk.*, d.nama AS nama_dosen')
            ->join('dosen d', 'd.id = mk.dosen_id', 'left')
            ->orderBy('mk.kode', 'ASC')
            ->get()
            ->getResultArray();
    }
}
