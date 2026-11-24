<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\MataKuliahModel;

class MataKuliahController extends BaseController
{
    public function index(): string
    {
        return view('matakuliah/index', [
            'title'      => 'Data Mata Kuliah',
            'activeMenu' => 'matakuliah',
            'items'      => (new MataKuliahModel())->getWithDosen(),
        ]);
    }

    public function create(): string
    {
        return view('matakuliah/form', [
            'title'      => 'Tambah Mata Kuliah',
            'activeMenu' => 'matakuliah',
            'item'       => null,
            'dosenList'  => (new DosenModel())->orderBy('nama', 'ASC')->findAll(),
            'action'     => site_url('matakuliah/store'),
        ]);
    }

    public function store()
    {
        $model = new MataKuliahModel();
        $kode  = strtoupper(trim((string) $this->request->getPost('kode')));

        if ($model->where('kode', $kode)->countAllResults() > 0) {
            return redirect()->back()->withInput()->with('error', "Kode mata kuliah {$kode} sudah ada.");
        }

        $dosenId = $this->request->getPost('dosen_id');
        $data = [
            'kode'     => $kode,
            'nama'     => trim((string) $this->request->getPost('nama')),
            'sks'      => (int) $this->request->getPost('sks'),
            'semester' => (int) $this->request->getPost('semester'),
            'dosen_id' => $dosenId !== '' ? (int) $dosenId : null,
        ];

        if (! $model->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to(site_url('matakuliah'))->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $item = (new MataKuliahModel())->find($id);
        if (! $item) {
            return redirect()->to(site_url('matakuliah'))->with('error', 'Mata kuliah tidak ditemukan.');
        }

        return view('matakuliah/form', [
            'title'      => 'Edit Mata Kuliah',
            'activeMenu' => 'matakuliah',
            'item'       => $item,
            'dosenList'  => (new DosenModel())->orderBy('nama', 'ASC')->findAll(),
            'action'     => site_url('matakuliah/update/' . $id),
        ]);
    }

    public function update(int $id)
    {
        $model = new MataKuliahModel();
        if (! $model->find($id)) {
            return redirect()->to(site_url('matakuliah'))->with('error', 'Mata kuliah tidak ditemukan.');
        }

        $kode = strtoupper(trim((string) $this->request->getPost('kode')));
        if ($model->where('kode', $kode)->where('id !=', $id)->countAllResults() > 0) {
            return redirect()->back()->withInput()->with('error', "Kode {$kode} sudah dipakai mata kuliah lain.");
        }

        $dosenId = $this->request->getPost('dosen_id');
        $data = [
            'kode'     => $kode,
            'nama'     => trim((string) $this->request->getPost('nama')),
            'sks'      => (int) $this->request->getPost('sks'),
            'semester' => (int) $this->request->getPost('semester'),
            'dosen_id' => $dosenId !== '' ? (int) $dosenId : null,
        ];

        if (! $model->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to(site_url('matakuliah'))->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $model = new MataKuliahModel();
        if (! $model->find($id)) {
            return redirect()->to(site_url('matakuliah'))->with('error', 'Mata kuliah tidak ditemukan.');
        }

        $model->delete($id);

        return redirect()->to(site_url('matakuliah'))->with('success', 'Mata kuliah berhasil dihapus.');
    }
}
