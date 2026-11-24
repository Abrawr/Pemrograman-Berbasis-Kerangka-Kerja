<?php

namespace App\Models;

use CodeIgniter\Model;

class BerkasModel extends Model
{
    protected $table         = 'berkas_upload';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $allowedFields = ['judul', 'nama_file', 'nama_asli', 'mime_type', 'ukuran_kb', 'created_at'];
}
