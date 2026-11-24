<?php

namespace App\Controllers;

use App\Models\DosenModel;

class DosenController extends BaseController
{
    public function index(): string
    {
        return view('dosen/index', [
            'title'      => 'Data Dosen',
            'activeMenu' => 'dosen',
            'items'      => (new DosenModel())->orderBy('nidn', 'ASC')->findAll(),
        ]);
    }

    public function create(): string
    {
        return view('dosen/form', [
            'title'      => 'Tambah Dosen',
            'activeMenu' => 'dosen',
            'item'       => null,
            'action'     => site_url('dosen/store'),
        ]);
    }

    public function store()
    {
        $model = new DosenModel();
        $nidn  = trim((string) $this->request->getPost('nidn'));

        if ($model->where('nidn', $nidn)->countAllResults() > 0) {
            return redirect()->back()->withInput()->with('error', "NIDN {$nidn} sudah terdaftar.");
        }

        $data = [
            'nidn'     => $nidn,
            'nama'     => trim((string) $this->request->getPost('nama')),
            'email'    => trim((string) $this->request->getPost('email')),
            'keahlian' => trim((string) $this->request->getPost('keahlian')),
        ];

        if (! $model->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to(site_url('dosen'))->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $item = (new DosenModel())->find($id);
        if (! $item) {
            return redirect()->to(site_url('dosen'))->with('error', 'Dosen tidak ditemukan.');
        }

        return view('dosen/form', [
            'title'      => 'Edit Dosen',
            'activeMenu' => 'dosen',
            'item'       => $item,
            'action'     => site_url('dosen/update/' . $id),
        ]);
    }

    public function update(int $id)
    {
        $model = new DosenModel();
        if (! $model->find($id)) {
            return redirect()->to(site_url('dosen'))->with('error', 'Dosen tidak ditemukan.');
        }

        $nidn = trim((string) $this->request->getPost('nidn'));
        if ($model->where('nidn', $nidn)->where('id !=', $id)->countAllResults() > 0) {
            return redirect()->back()->withInput()->with('error', "NIDN {$nidn} sudah digunakan dosen lain.");
        }

        $data = [
            'nidn'     => $nidn,
            'nama'     => trim((string) $this->request->getPost('nama')),
            'email'    => trim((string) $this->request->getPost('email')),
            'keahlian' => trim((string) $this->request->getPost('keahlian')),
        ];

        if (! $model->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to(site_url('dosen'))->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $model = new DosenModel();
        if (! $model->find($id)) {
            return redirect()->to(site_url('dosen'))->with('error', 'Dosen tidak ditemukan.');
        }

        $model->delete($id);

        return redirect()->to(site_url('dosen'))->with('success', 'Data dosen berhasil dihapus.');
    }
}
