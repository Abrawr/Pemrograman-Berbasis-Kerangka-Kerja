<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table         = 'mahasiswa';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['nrp', 'nama', 'email', 'angkatan', 'prodi', 'dosen_wali_id', 'status'];

    protected $validationRules = [
        'nrp'      => 'required|min_length[5]|max_length[20]',
        'nama'     => 'required|min_length[3]|max_length[120]',
        'email'    => 'required|valid_email|max_length[120]',
        'angkatan' => 'required|integer',
        'prodi'    => 'required|max_length[100]',
        'status'   => 'required|in_list[Aktif,Cuti,Lulus]',
    ];

    public function getWithDosenWali(string $search = ''): array
    {
        $builder = $this->db->table('mahasiswa m')
            ->select('m.*, d.nama AS nama_dosen_wali')
            ->join('dosen d', 'd.id = m.dosen_wali_id', 'left')
            ->orderBy('m.nrp', 'ASC');

        if ($search !== '') {
            $builder->groupStart()
                ->like('m.nrp', $search)
                ->orLike('m.nama', $search)
                ->orLike('m.prodi', $search)
                ->groupEnd();
        }

        return $builder->get()->getResultArray();
    }
}
