<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login(): string
    {
        return view('auth/login', [
            'title'      => 'Masuk ke ShopEase',
            'activeMenu' => 'login',
        ]);
    }

    public function attemptLogin()
    {
        $rules = [
            'email'    => 'required|valid_email',
            'password' => 'required|min_length[6]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email    = strtolower(trim((string) $this->request->getPost('email')));
        $password = (string) $this->request->getPost('password');

        $userModel = new UserModel();
        $user      = $userModel->findByEmail($email);

        if (! $user) {
            return redirect()->back()->withInput()->with('error', 'Email atau password tidak sesuai.');
        }

        if ((int) $user['is_active'] !== 1) {
            return redirect()->back()->withInput()->with('error', 'Akun Anda sedang dinonaktifkan.');
        }

        if ($userModel->isLocked($user)) {
            $sisaDetik = max(1, strtotime((string) $user['locked_until']) - time());

            return redirect()->back()->withInput()
                ->with('error', "Terlalu banyak percobaan login gagal. Coba lagi dalam {$sisaDetik} detik.");
        }

        if (! password_verify($password, $user['password'])) {
            $attempts = $userModel->recordFailedAttempt($user);
            if ($attempts >= UserModel::MAX_FAILED_ATTEMPTS) {
                return redirect()->back()->withInput()
                    ->with('error', 'Batas percobaan tercapai. Akun dikunci sementara selama 1 menit.');
            }

            return redirect()->back()->withInput()
                ->with('error', 'Email atau password tidak sesuai. Sisa percobaan: ' . (UserModel::MAX_FAILED_ATTEMPTS - $attempts) . '.');
        }

        $userModel->resetFailedAttempts((int) $user['id']);

        session()->regenerate(true);
        session()->set([
            'is_logged_in' => true,
            'user_id'      => (int) $user['id'],
            'user_name'    => $user['name'],
            'user_email'   => $user['email'],
            'user_phone'   => $user['phone'],
            'user_role'    => $user['role'],
            'login_at'     => date('Y-m-d H:i:s'),
        ]);

        $dest = match ($user['role']) {
            'admin'    => site_url('admin/dashboard'),
            'operator' => site_url('operator/dashboard'),
            default    => site_url('account'),
        };

        return redirect()->to($dest)
            ->with('success', 'Selamat datang kembali, ' . $user['name'] . '.');
    }

    public function register(): string
    {
        return view('auth/register', [
            'title'      => 'Daftar Akun Pelanggan — ShopEase',
            'activeMenu' => 'register',
        ]);
    }

    public function attemptRegister()
    {
        $rules = [
            'name'             => 'required|min_length[3]|max_length[100]',
            'email'            => 'required|valid_email|max_length[150]',
            'phone'            => 'permit_empty|max_length[25]',
            'password'         => 'required|min_length[8]',
            'password_confirm' => 'required|matches[password]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $email     = strtolower(trim((string) $this->request->getPost('email')));
        $userModel = new UserModel();

        if ($userModel->findByEmail($email)) {
            return redirect()->back()->withInput()->with('error', "Email {$email} sudah terdaftar. Silakan login.");
        }

        $userModel->insert([
            'name'            => trim((string) $this->request->getPost('name')),
            'email'           => $email,
            'phone'           => trim((string) $this->request->getPost('phone')) ?: null,
            'password'        => password_hash((string) $this->request->getPost('password'), PASSWORD_BCRYPT),
            'role'            => 'customer',
            'is_active'       => 1,
            'failed_attempts' => 0,
            'locked_until'    => null,
        ]);

        return redirect()->to(site_url('login'))
            ->with('success', 'Registrasi berhasil! Silakan masuk menggunakan email dan password Anda.');
    }

    public function logout()
    {
        session()->remove(['is_logged_in', 'user_id', 'user_name', 'user_email', 'user_phone', 'user_role', 'login_at']);
        session()->regenerate(true);

        return redirect()->to(site_url('/'))->with('success', 'Anda telah keluar dari sesi ShopEase.');
    }
}
