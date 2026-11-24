<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\MahasiswaModel;

class MahasiswaController extends BaseController
{
    public function index(): string
    {
        $q     = trim((string) $this->request->getGet('q'));
        $model = new MahasiswaModel();

        return view('mahasiswa/index', [
            'title'      => 'Data Mahasiswa',
            'activeMenu' => 'mahasiswa',
            'q'          => $q,
            'items'      => $model->getWithDosenWali($q),
        ]);
    }

    public function create(): string
    {
        return view('mahasiswa/form', [
            'title'      => 'Tambah Mahasiswa',
            'activeMenu' => 'mahasiswa',
            'item'       => null,
            'dosenList'  => (new DosenModel())->orderBy('nama', 'ASC')->findAll(),
            'action'     => site_url('mahasiswa/store'),
        ]);
    }

    public function store()
    {
        $model = new MahasiswaModel();
        $nrp   = trim((string) $this->request->getPost('nrp'));

        if ($model->where('nrp', $nrp)->countAllResults() > 0) {
            return redirect()->back()->withInput()->with('error', "NRP {$nrp} sudah terdaftar.");
        }

        $dosenWaliId = $this->request->getPost('dosen_wali_id');
        $data = [
            'nrp'           => $nrp,
            'nama'          => trim((string) $this->request->getPost('nama')),
            'email'         => trim((string) $this->request->getPost('email')),
            'angkatan'      => (int) $this->request->getPost('angkatan'),
            'prodi'         => trim((string) $this->request->getPost('prodi')),
            'dosen_wali_id' => $dosenWaliId !== '' ? (int) $dosenWaliId : null,
            'status'        => (string) $this->request->getPost('status'),
        ];

        if (! $model->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to(site_url('mahasiswa'))->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $item = (new MahasiswaModel())->find($id);
        if (! $item) {
            return redirect()->to(site_url('mahasiswa'))->with('error', 'Mahasiswa tidak ditemukan.');
        }

        return view('mahasiswa/form', [
            'title'      => 'Edit Mahasiswa',
            'activeMenu' => 'mahasiswa',
            'item'       => $item,
            'dosenList'  => (new DosenModel())->orderBy('nama', 'ASC')->findAll(),
            'action'     => site_url('mahasiswa/update/' . $id),
        ]);
    }

    public function update(int $id)
    {
        $model = new MahasiswaModel();
        $item  = $model->find($id);
        if (! $item) {
            return redirect()->to(site_url('mahasiswa'))->with('error', 'Mahasiswa tidak ditemukan.');
        }

        $nrp = trim((string) $this->request->getPost('nrp'));
        if ($model->where('nrp', $nrp)->where('id !=', $id)->countAllResults() > 0) {
            return redirect()->back()->withInput()->with('error', "NRP {$nrp} sudah digunakan mahasiswa lain.");
        }

        $dosenWaliId = $this->request->getPost('dosen_wali_id');
        $data = [
            'nrp'           => $nrp,
            'nama'          => trim((string) $this->request->getPost('nama')),
            'email'         => trim((string) $this->request->getPost('email')),
            'angkatan'      => (int) $this->request->getPost('angkatan'),
            'prodi'         => trim((string) $this->request->getPost('prodi')),
            'dosen_wali_id' => $dosenWaliId !== '' ? (int) $dosenWaliId : null,
            'status'        => (string) $this->request->getPost('status'),
        ];

        if (! $model->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to(site_url('mahasiswa'))->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $model = new MahasiswaModel();
        if (! $model->find($id)) {
            return redirect()->to(site_url('mahasiswa'))->with('error', 'Mahasiswa tidak ditemukan.');
        }

        $model->delete($id);

        return redirect()->to(site_url('mahasiswa'))->with('success', 'Data mahasiswa berhasil dihapus.');
    }
}
