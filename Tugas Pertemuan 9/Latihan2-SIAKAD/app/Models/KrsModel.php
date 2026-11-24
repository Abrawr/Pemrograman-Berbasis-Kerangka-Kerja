<?php

namespace App\Models;

use CodeIgniter\Model;

class KrsModel extends Model
{
    public const GRADE_SCALE = [
        'A'  => 4.00,
        'AB' => 3.50,
        'B'  => 3.00,
        'BC' => 2.50,
        'C'  => 2.00,
        'D'  => 1.00,
        'E'  => 0.00,
    ];

    protected $table         = 'krs';
    protected $primaryKey    = 'id';
    protected $returnType    = 'array';
    protected $useTimestamps = true;
    protected $allowedFields = ['mahasiswa_id', 'mata_kuliah_id', 'tahun_ajaran', 'nilai_huruf', 'nilai_angka'];

    public static function gradeToPoint(?string $huruf): ?float
    {
        if ($huruf === null || $huruf === '') {
            return null;
        }
        $key = strtoupper(trim($huruf));

        return self::GRADE_SCALE[$key] ?? null;
    }

    public function getWithDetails(?int $mahasiswaId = null): array
    {
        $builder = $this->db->table('krs k')
            ->select('k.*, m.nrp, m.nama AS nama_mahasiswa, mk.kode AS kode_mk, mk.nama AS nama_mk, mk.sks')
            ->join('mahasiswa m', 'm.id = k.mahasiswa_id')
            ->join('mata_kuliah mk', 'mk.id = k.mata_kuliah_id')
            ->orderBy('m.nrp', 'ASC')
            ->orderBy('mk.kode', 'ASC');

        if ($mahasiswaId !== null && $mahasiswaId > 0) {
            $builder->where('k.mahasiswa_id', $mahasiswaId);
        }

        return $builder->get()->getResultArray();
    }

    public function getIpkSummary(): array
    {
        $rows = $this->db->table('mahasiswa m')
            ->select('m.id, m.nrp, m.nama, m.status, COALESCE(SUM(mk.sks), 0) AS total_sks, COALESCE(SUM(CASE WHEN k.nilai_angka IS NOT NULL THEN mk.sks ELSE 0 END), 0) AS sks_dinilai, COALESCE(SUM(CASE WHEN k.nilai_angka IS NOT NULL THEN mk.sks * k.nilai_angka ELSE 0 END), 0) AS total_bobot')
            ->join('krs k', 'k.mahasiswa_id = m.id', 'left')
            ->join('mata_kuliah mk', 'mk.id = k.mata_kuliah_id', 'left')
            ->groupBy('m.id, m.nrp, m.nama, m.status')
            ->orderBy('m.nrp', 'ASC')
            ->get()
            ->getResultArray();

        foreach ($rows as &$r) {
            $sksDinilai = (int) $r['sks_dinilai'];
            $r['ipk']   = $sksDinilai > 0 ? round(((float) $r['total_bobot']) / $sksDinilai, 2) : 0.00;
        }

        return $rows;
    }
}
