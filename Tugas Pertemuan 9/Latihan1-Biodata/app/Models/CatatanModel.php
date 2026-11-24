<?php

namespace App\Models;

use CodeIgniter\Model;

class CatatanModel extends Model
{
    protected $table         = 'catatan';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['judul', 'kategori', 'modul_pbkk', 'isi', 'status'];

    protected $validationRules = [
        'judul'      => 'required|min_length[3]|max_length[150]',
        'kategori'   => 'required|max_length[60]',
        'modul_pbkk' => 'required|max_length[40]',
        'isi'        => 'required|min_length[5]',
        'status'     => 'required|in_list[Selesai,Proses,Direncanakan]',
    ];
}
