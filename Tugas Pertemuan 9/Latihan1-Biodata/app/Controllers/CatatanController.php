<?php

namespace App\Controllers;

use App\Models\CatatanModel;

class CatatanController extends BaseController
{
    public function index(): string
    {
        $keyword = trim((string) $this->request->getGet('q'));
        $model   = new CatatanModel();

        if ($keyword !== '') {
            $model->groupStart()
                ->like('judul', $keyword)
                ->orLike('modul_pbkk', $keyword)
                ->orLike('kategori', $keyword)
                ->groupEnd();
        }

        return view('pages/catatan_index', [
            'title'      => 'CRUD Catatan Praktikum',
            'activeMenu' => 'catatan',
            'keyword'    => $keyword,
            'items'      => $model->orderBy('id', 'ASC')->findAll(),
        ]);
    }

    public function create(): string
    {
        return view('pages/catatan_form', [
            'title'      => 'Tambah Catatan Baru',
            'activeMenu' => 'catatan',
            'item'       => null,
            'action'     => site_url('catatan/store'),
        ]);
    }

    public function store()
    {
        $model = new CatatanModel();
        $data  = [
            'judul'      => trim((string) $this->request->getPost('judul')),
            'kategori'   => trim((string) $this->request->getPost('kategori')),
            'modul_pbkk' => trim((string) $this->request->getPost('modul_pbkk')),
            'isi'        => trim((string) $this->request->getPost('isi')),
            'status'     => (string) $this->request->getPost('status'),
        ];

        if (! $model->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to(site_url('catatan'))->with('success', 'Catatan praktikum berhasil ditambahkan.');
    }

    public function edit(int $id)
    {
        $model = new CatatanModel();
        $item  = $model->find($id);
        if (! $item) {
            return redirect()->to(site_url('catatan'))->with('error', 'Catatan tidak ditemukan.');
        }

        return view('pages/catatan_form', [
            'title'      => 'Ubah Catatan Praktikum',
            'activeMenu' => 'catatan',
            'item'       => $item,
            'action'     => site_url('catatan/update/' . $id),
        ]);
    }

    public function update(int $id)
    {
        $model = new CatatanModel();
        if (! $model->find($id)) {
            return redirect()->to(site_url('catatan'))->with('error', 'Catatan tidak ditemukan.');
        }

        $data = [
            'judul'      => trim((string) $this->request->getPost('judul')),
            'kategori'   => trim((string) $this->request->getPost('kategori')),
            'modul_pbkk' => trim((string) $this->request->getPost('modul_pbkk')),
            'isi'        => trim((string) $this->request->getPost('isi')),
            'status'     => (string) $this->request->getPost('status'),
        ];

        if (! $model->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        return redirect()->to(site_url('catatan'))->with('success', 'Catatan praktikum berhasil diperbarui.');
    }

    public function delete(int $id)
    {
        $model = new CatatanModel();
        if (! $model->find($id)) {
            return redirect()->to(site_url('catatan'))->with('error', 'Catatan tidak ditemukan.');
        }

        $model->delete($id);

        return redirect()->to(site_url('catatan'))->with('success', 'Catatan berhasil dihapus.');
    }
}
