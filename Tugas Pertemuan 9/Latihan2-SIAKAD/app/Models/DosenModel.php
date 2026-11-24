<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table         = 'dosen';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['nidn', 'nama', 'email', 'keahlian'];

    protected $validationRules = [
        'nidn'     => 'required|min_length[5]|max_length[20]',
        'nama'     => 'required|min_length[3]|max_length[120]',
        'email'    => 'required|valid_email|max_length[120]',
        'keahlian' => 'required|min_length[3]|max_length[120]',
    ];
}
