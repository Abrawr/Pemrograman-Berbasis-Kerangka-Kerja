<?php

namespace App\Controllers;

use App\Models\BerkasModel;

class UploadController extends BaseController
{
    public function index(): string
    {
        return view('pages/upload', [
            'title'      => 'Upload Berkas & Gambar',
            'activeMenu' => 'upload',
            'files'      => (new BerkasModel())->orderBy('id', 'DESC')->findAll(),
        ]);
    }

    public function store()
    {
        $rules = [
            'judul'  => 'required|min_length[3]|max_length[120]',
            'berkas' => [
                'label' => 'Berkas',
                'rules' => 'uploaded[berkas]|max_size[berkas,2048]|ext_in[berkas,png,jpg,jpeg,webp,pdf,txt]',
            ],
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('berkas');
        if (! $file || ! $file->isValid() || $file->hasMoved()) {
            return redirect()->back()->with('error', 'Berkas tidak valid atau gagal diproses.');
        }

        $targetDir = FCPATH . 'uploads';
        if (! is_dir($targetDir)) {
            mkdir($targetDir, 0775, true);
        }

        $originalName = $file->getClientName();
        $mimeType     = $file->getMimeType();
        $sizeKb       = max(1, (int) ceil($file->getSize() / 1024));
        $newName      = $file->getRandomName();
        $file->move($targetDir, $newName);

        (new BerkasModel())->insert([
            'judul'      => trim((string) $this->request->getPost('judul')),
            'nama_file'  => $newName,
            'nama_asli'  => $originalName,
            'mime_type'  => $mimeType,
            'ukuran_kb'  => $sizeKb,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to(site_url('upload'))->with('success', "Berkas \"{$originalName}\" berhasil diunggah.");
    }

    public function delete(int $id)
    {
        $model = new BerkasModel();
        $item  = $model->find($id);
        if (! $item) {
            return redirect()->to(site_url('upload'))->with('error', 'Data berkas tidak ditemukan.');
        }

        $path = FCPATH . 'uploads' . DIRECTORY_SEPARATOR . $item['nama_file'];
        if (is_file($path)) {
            @unlink($path);
        }
        $model->delete($id);

        return redirect()->to(site_url('upload'))->with('success', 'Berkas berhasil dihapus dari server.');
    }
}
