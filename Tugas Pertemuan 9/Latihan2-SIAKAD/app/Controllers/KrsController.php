<?php

namespace App\Controllers;

use App\Models\KrsModel;
use App\Models\MahasiswaModel;
use App\Models\MataKuliahModel;

class KrsController extends BaseController
{
    public function index(): string
    {
        $mahasiswaId = (int) $this->request->getGet('mahasiswa_id');
        $krsModel    = new KrsModel();

        return view('krs/index', [
            'title'         => 'Kartu Rencana Studi (KRS) & Nilai',
            'activeMenu'    => 'krs',
            'selectedMhsId' => $mahasiswaId,
            'mahasiswaList' => (new MahasiswaModel())->orderBy('nrp', 'ASC')->findAll(),
            'items'         => $krsModel->getWithDetails($mahasiswaId > 0 ? $mahasiswaId : null),
            'ipkSummary'    => $krsModel->getIpkSummary(),
        ]);
    }

    public function create(): string
    {
        return view('krs/form', [
            'title'         => 'Tambah Entri KRS',
            'activeMenu'    => 'krs',
            'item'          => null,
            'mahasiswaList' => (new MahasiswaModel())->orderBy('nrp', 'ASC')->findAll(),
            'mkList'        => (new MataKuliahModel())->orderBy('kode', 'ASC')->findAll(),
            'gradeOptions'  => array_keys(KrsModel::GRADE_SCALE),
            'action'        => site_url('krs/store'),
        ]);
    }

    public function store()
    {
        $model        = new KrsModel();
        $mahasiswaId  = (int) $this->request->getPost('mahasiswa_id');
        $mkId         = (int) $this->request->getPost('mata_kuliah_id');
        $tahunAjaran  = trim((string) $this->request->getPost('tahun_ajaran'));
        $nilaiHuruf   = strtoupper(trim((string) $this->request->getPost('nilai_huruf')));

        $exists = $model->where('mahasiswa_id', $mahasiswaId)
            ->where('mata_kuliah_id', $mkId)
            ->where('tahun_ajaran', $tahunAjaran)
            ->countAllResults();

        if ($exists > 0) {
            return redirect()->back()->withInput()->with('error', 'Mahasiswa sudah mengambil mata kuliah ini pada tahun ajaran yang sama.');
        }

        $model->insert([
            'mahasiswa_id'   => $mahasiswaId,
            'mata_kuliah_id' => $mkId,
            'tahun_ajaran'   => $tahunAjaran !== '' ? $tahunAjaran : '2026/2027-Ganjil',
            'nilai_huruf'    => $nilaiHuruf !== '' ? $nilaiHuruf : null,
            'nilai_angka'    => KrsModel::gradeToPoint($nilaiHuruf),
        ]);

        return redirect()->to(site_url('krs'))->with('success', 'Data KRS & nilai berhasil disimpan.');
    }

    public function edit(int $id)
    {
        $item = (new KrsModel())->find($id);
        if (! $item) {
            return redirect()->to(site_url('krs'))->with('error', 'Entri KRS tidak ditemukan.');
        }

        return view('krs/form', [
            'title'         => 'Edit Nilai / KRS',
            'activeMenu'    => 'krs',
            'item'          => $item,
            'mahasiswaList' => (new MahasiswaModel())->orderBy('nrp', 'ASC')->findAll(),
            'mkList'        => (new MataKuliahModel())->orderBy('kode', 'ASC')->findAll(),
            'gradeOptions'  => array_keys(KrsModel::GRADE_SCALE),
            'action'        => site_url('krs/update/' . $id),
        ]);
    }

    public function update(int $id)
    {
        $model = new KrsModel();
        if (! $model->find($id)) {
            return redirect()->to(site_url('krs'))->with('error', 'Entri KRS tidak ditemukan.');
        }

        $nilaiHuruf = strtoupper(trim((string) $this->request->getPost('nilai_huruf')));

        $model->update($id, [
            'mahasiswa_id'   => (int) $this->request->getPost('mahasiswa_id'),
            'mata_kuliah_id' => (int) $this->request->getPost('mata_kuliah_id'),
            'tahun_ajaran'   => trim((string) $this->request->getPost('tahun_ajaran')),
            'nilai_huruf'    => $nilaiHuruf !== '' ? $nilaiHuruf : null,
            'nilai_angka'    => KrsModel::gradeToPoint($nilaiHuruf),
        ]);

        return redirect()->to(site_url('krs'))->with('success', 'Nilai KRS berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $model = new KrsModel();
        if (! $model->find($id)) {
            return redirect()->to(site_url('krs'))->with('error', 'Entri KRS tidak ditemukan.');
        }

        $model->delete($id);

        return redirect()->to(site_url('krs'))->with('success', 'Entri KRS berhasil dihapus.');
    }
}
