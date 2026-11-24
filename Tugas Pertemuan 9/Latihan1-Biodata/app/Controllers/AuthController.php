<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('is_logged_in')) {
            return redirect()->to(site_url('/'));
        }

        return view('pages/login', [
            'title'      => 'Login Akses Admin',
            'activeMenu' => 'login',
        ]);
    }

    public function attemptLogin()
    {
        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');

        if ($username === '' || $password === '') {
            return redirect()->back()->withInput()->with('error', 'Username dan password wajib diisi.');
        }

        $user = (new UserModel())->where('username', $username)->first();
        if (! $user || ! password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Username atau password tidak sesuai.');
        }

        session()->regenerate(true);
        session()->set([
            'is_logged_in' => true,
            'user_id'      => $user['id'],
            'username'     => $user['username'],
            'user_name'    => $user['name'],
            'user_role'    => $user['role'],
        ]);

        return redirect()->to(site_url('catatan'))
            ->with('success', 'Berhasil masuk sebagai ' . $user['name'] . '. Akses CRUD dan Upload kini aktif.');
    }

    public function logout()
    {
        session()->remove(['is_logged_in', 'user_id', 'username', 'user_name', 'user_role']);
        session()->regenerate(true);

        return redirect()->to(site_url('/'))->with('success', 'Anda telah keluar dari sesi admin.');
    }
}
