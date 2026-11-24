<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session()->get('is_logged_in')) {
            return redirect()->to(site_url('login'))
                ->with('error', 'Silakan login terlebih dahulu untuk mengakses halaman tersebut.');
        }

        if (! empty($arguments)) {
            $role = (string) session()->get('user_role');
            if (! in_array($role, $arguments, true)) {
                $fallback = match ($role) {
                    'admin'    => site_url('admin/dashboard'),
                    'operator' => site_url('operator/dashboard'),
                    default    => site_url('account'),
                };

                return redirect()->to($fallback)
                    ->with('error', 'Akses ditolak: peran akun Anda tidak memiliki izin membuka halaman tersebut.');
            }
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        return null;
    }
}
